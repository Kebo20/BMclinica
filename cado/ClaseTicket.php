<?php
   require_once('conexion.php');
   
   class Tickets{
	
// INSERTAR TICKET DE COLAS (ESCENARIO 1)
    function GenerarTicket(){
		try{
		  $ocado=new cado();
		  $cn=$ocado->conectar();
		  $cn->beginTransaction();
		  $sql_ultimo="select isnull(max(nro_ticket),0)+1 from cola_ticket where fecha=cast(getdate() as date)";
		  $cmd=$cn->prepare($sql_ultimo);
		  $cmd->execute();
		  $generar=$cmd->fetch();
		  $nro=$generar[0];
		  $nro_ceros=$this->TicketCeros($nro);
		  $sql="insert into cola_ticket (fecha,nro_ticket,llamado,pantalla,parpadeo) values (getdate(),$nro,0,0,0)"; 
		  $cn->prepare($sql)->execute();
		  $cn->commit();
		  $cn=null;
		  $return=$nro_ceros;
		  }catch (PDOException $ex){
              $cn->rollBack();
			  $cn=null;
			  $return=0;
          }
		 return $return;  
	 } 
	function TicketCeros($nro){
		$num='A'.$nro;
	    //$len=strlen($nro);
		/*switch ($len) {
          case 1:
            $num="C-".$nro;
            break;
          case 2:
            $num="C-".$nro;
            break;
          case 3:
            $num="C-".$nro;
            break;
		  case 4:
            $num=$nro;
            break;
        }*/
		return $num;
	}
	   
	// FECHA EN LETRAS PARA EL TICKET DE COLAS (ESCENARIO 1)
     function FechaCastellano ($fecha) {
         $fecha = substr($fecha, 0, 10);
         $numeroDia = date('d', strtotime($fecha));
         $dia = date('l', strtotime($fecha));
         $mes = date('F', strtotime($fecha));
         $anio = date('Y', strtotime($fecha));
         $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
         $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
         $nombredia = str_replace($dias_EN, $dias_ES, $dia);
         $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
         $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
         $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
       return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
  
	   
	function ActualizarTurnosAdm(){
		  $ocado=new cado();
		  $sql="declare @tot int,@aten int,@pen int,@por_aten int,@por_pen int
                select @tot=count (nro_ticket) from cola_ticket 
                where fecha=cast(getdate() as date)

                select @aten=count (nro_ticket) from cola_ticket 
                where fecha=cast(getdate() as date) and llamado=1

                set @pen=@tot-@aten
                set @por_aten= @aten*100/(case when @tot=0 then 1 else @tot end )
                set @por_pen= 100-@por_aten

                select @tot t,@aten a,@pen p,@por_aten pa,@por_pen pp";
		  $ejecutar=$ocado->ejecutar($sql);
		  return $ejecutar;
	}
	
	function LeerVentanilla($ArchivoLeer){
		
		if (file_exists($ArchivoLeer)) {
            $archivoID = fopen($ArchivoLeer, "r"); 
		    while( !feof($archivoID)){
		      $linea = intval(fgets($archivoID));
		    }
		    if(strlen($linea)==0 or strlen($linea)>1){$linea=0;}
	        fclose($archivoID);
         } else {
             $linea='NO';
         }
		
	    
       return $linea;
	}
    
	function ListarTurno($ventanilla){
		  $ocado=new cado();
		  $sql="select id,nro_ticket from cola_ticket where nro_ticket=
 (select max(nro_ticket) from cola_ticket where fecha=cast(getdate() as date) and ventanilla=$ventanilla)";
		  $ejecutar=$ocado->ejecutar($sql);
		  return $ejecutar;
	}
	function Siguiente($user,$ventanilla){
		try{
		  $ocado=new cado();
		  $cn=$ocado->conectar();
		  $cn->beginTransaction();
		  $sql="select id,nro_ticket from cola_ticket 
             where id=( select id from  cola_ticket
           where fecha=cast(getdate() as date)  and  nro_ticket =(select isnull(max(nro_ticket),0)+1 from cola_ticket where fecha=cast(getdate() as date) and llamado=1) )";
		  $cmd=$cn->prepare($sql);
		  $cmd->execute();
		  $datos=$cmd->fetch();
		  $idticket=$datos[0];$nro_ticket='A'.$datos[1];
		  $sql_pantalla="update cola_ticket set pantalla=0 where ventanilla=$ventanilla";
		  $cn->prepare($sql_pantalla)->execute();
		  $sql_update="update cola_ticket set ventanilla='$ventanilla', user_atiende='$user',llamado=1,pantalla=1,parpadeo=1
		  where id=$idticket";
		  $cn->prepare($sql_update)->execute();
		  $cn->commit();
		  $cn=null;
		  $return=$nro_ticket.'*'.$idticket;
		  }catch (PDOException $ex){
              $cn->rollBack();
			  $cn=null;
			  $return='error';
              //return $ex->getMessage();
          }
		  return $return;  
	 }
	 
	function ListarTelevisor(){
		  $ocado=new cado();
		  $sql="declare @nro_1 int,@nro_2 int, @nro_3 int,@par_1 int,@par_2 int,@par_3 int

select @nro_1=nro_ticket,@par_1=parpadeo from cola_ticket where fecha=cast(getdate() as date) and pantalla=1 and ventanilla=1
select @nro_2=nro_ticket,@par_2=parpadeo from cola_ticket where fecha=cast(getdate() as date) and pantalla=1 and ventanilla=2
select @nro_3=nro_ticket,@par_3=parpadeo from cola_ticket where fecha=cast(getdate() as date) and pantalla=1 and ventanilla=3

select @nro_1 nro_1,@nro_2 nro_2,@nro_3 nro_3,@par_1 par_1,@par_2 par_2,@par_3 par_3";
		  $ejecutar=$ocado->ejecutar($sql);
		  return $ejecutar;
	}
	function FinParpadeo(){
		try{
		  $ocado=new cado();
		  $cn=$ocado->conectar();
		  $cn->beginTransaction();
		  $sql="update cola_ticket set parpadeo=0 ";
		  $cn->prepare($sql)->execute();
		  $cn->commit();
		  $cn=null;
		  $return=1;
		  }catch (PDOException $ex){
              $cn->rollBack();
			  $cn=null;
			  $return=0;
              //return $ex->getMessage();
          }
		  return $return;  
	 }
	 function Rellamar($idtcket){
		try{
		  $ocado=new cado();
		  $cn=$ocado->conectar();
		  $cn->beginTransaction();
		  $sql="update cola_ticket set parpadeo=1 where id=$idtcket ";
		  $cn->prepare($sql)->execute();
		  $cn->commit();
		  $cn=null;
		  $return=1;
		  }catch (PDOException $ex){
              $cn->rollBack();
			  $cn=null;
			  $return=0;
              //return $ex->getMessage();
          }
		  return $return;  
	 }
  
 }
	
?>