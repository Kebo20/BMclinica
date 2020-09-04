<?php   require_once('../cado/ClaseTicket.php'); 
	    date_default_timezone_set('America/Lima');
	    session_start();
	
	

   controlador($_POST['accion']);
   
    function controlador($accion){
	
	   $oticket=new Tickets();
	  
		
		
	 if($accion=='ADM_TURNOS'){
		$listar=$oticket->ActualizarTurnosAdm()->fetch();
	$total=$listar[0];$atendidos=$listar[1];$pendientes=$listar[2];$por_atendidos=$listar[3].'%';$por_pendientes=$listar[4].'%';
	    echo $total.'*'.$atendidos.'*'.$pendientes.'*'.$por_atendidos.'*'.$por_pendientes;	
	 }
	 if($accion=='NUM_TURNO'){
		$ArchivoLeer = "C:/ventanilla/ventanilla.txt";
	    $ventanilla=$oticket->LeerVentanilla($ArchivoLeer);
		if($ventanilla==0 or $ventanilla=='NO'){echo $ventanilla;exit;}
		$listar=$oticket->ListarTurno($ventanilla)->fetch();
		$nro_ticket=$listar[1];$id=$listar[0];
		if($nro_ticket==''){$nro_ticket='-';}else{$nro_ticket='A'.$nro_ticket;}
		echo $ventanilla."*".$nro_ticket."*".$id;
	 }
	 if($accion=='SIGUIENTE'){
		$ArchivoLeer = "C:/ventanilla/ventanilla.txt";
		$user=$_SESSION['S_user'];
	    $ventanilla=$oticket->LeerVentanilla($ArchivoLeer);
		if($ventanilla==0 or $ventanilla=='NO'){echo $ventanilla.'*0';exit;}
		$dato=$oticket->Siguiente($user,$ventanilla);
		echo $dato;
	 }
	 if($accion=='TELE_TURNOS'){
		$listar=$oticket->ListarTelevisor()->fetch();
		if($listar[0]==0){$nro_1='-';}else{$nro_1='A'.$listar[0];}
		if($listar[1]==0){$nro_2='-';}else{$nro_2='A'.$listar[1];}
		if($listar[2]==0){$nro_3='-';}else{$nro_3='A'.$listar[2];}
		echo $nro_1.'*'.$nro_2.'*'.$nro_3.'*'.$listar[3].'*'.$listar[4].'*'.$litar[5];
	 }
     if($accion=='FIN_PARPADEO'){
		$update=$oticket->FinParpadeo();	
	 }
	 if($accion=='RELLAMAR'){
		$id=$_POST['id'];
		$update=$oticket->Rellamar($id);	
	 }
		 		
}
?>