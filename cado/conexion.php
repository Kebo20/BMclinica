<?php 
 class cado{
	  
	  function Conectar(){
     	 $dns = "sqlsrv:Database=bd_bmclinica;Server=DESKTOP-K0FOCGI";
         $user = 'kevin';
	     $password = '200397';
		
	   try {
		   //ini_set('mssql.charset', 'UTF-8');
	    $this->db = new PDO($dns,$user,$password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) );
		 return $this->db;
		 }catch (PDOException $e) {
	       echo $e->getMessage();
          }
	  }
	  function Ejecutar($isql){
		       $conexion=$this->Conectar();
			   $ejecutar=$conexion->prepare($isql,array (PDO :: ATTR_CURSOR => PDO :: CURSOR_SCROLL));
		       $ejecutar->execute();
			   $conexion=null;
		       return  $ejecutar;
	  }
	  function EjecutarPA($isql,$array_param){
	  try{     
	           $conexion=$this->Conectar();
			   $ejecutar=$conexion->prepare($isql,array ());
			   //$ejecutar=$this->ConectarSql()->prepare($isql,array ());
		       $ejecutar->execute($array_param);
			   $conexion=null;

	  }catch(PDOException $e){
	  echo ' - '.$e->getMessage();
	  }
		return  $ejecutar;
	}
   }
?>