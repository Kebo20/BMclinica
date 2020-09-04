<?php
   require_once('conexion.php');
   
   class WebServices{
	   
   function ValidarMedico($dni){
	  $ocado=new cado();
	  $sql="select count(*) from conf_medico where dni='$dni'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	}
   function ValidarPersona($dni){
	  $ocado=new cado();
	  $sql="select nuDni,apePaterno,apeMaterno,preNombres,feNacimiento,estatura,sexo,estadoCivil,depaDireccion,
	        provDireccion,distDireccion,desDireccion,foto,firma,hizquierda,hderecha,id,
			DATEDIFF(YY,convert(datetime,feNacimiento,103),getdate())-(CASE
   WHEN DATEADD(YY,DATEDIFF(YEAR,feNacimiento,GETDATE()),feNacimiento)>GETDATE() THEN 1 ELSE 0 END) as Edad
	      from webservice_persona where nuDni='$dni'";
	  $ejecutar=$ocado->ejecutar($sql);
	  return $ejecutar;
	}
   function RegistrarPersona($nuDni,$apePaterno,$apeMaterno,$preNombres,$feNacimiento,$estatura,$sexo,$estadoCivil,
		  $depaDireccion,$provDireccion,$distDireccion,$desDireccion,$foto,$firma,$hizquierda,$hderecha,$user_crea){
	   try{
		  $ocado=new cado();
		  $cn=$ocado->conectar();
		  $cn->beginTransaction();
		  $sql="insert into webservice_persona(nuDni,apePaterno,apeMaterno,preNombres,feNacimiento,estatura,sexo,estadoCivil,
		  depaDireccion,provDireccion,distDireccion,desDireccion,foto,firma,hizquierda,hderecha,fec_crea,user_crea,sistema)
		  values('$nuDni','$apePaterno','$apeMaterno','$preNombres','$feNacimiento','$estatura','$sexo','$estadoCivil',
		  '$depaDireccion','$provDireccion','$distDireccion','$desDireccion','$foto','$firma','$hizquierda','$hderecha',
		  GETDATE(),'$user_crea','ERPSALUD')";
		  $cn->prepare($sql)->execute();
		  $idper= $cn->lastInsertId();
		  $cn->commit();
		  $cn=null;
		  $return=$idper;
		  }catch (PDOException $ex){
              $cn->rollBack();
		      $cn=null;
			  $return=0;
              //return $ex->getMessage();
          }
		  return $return;  
     } 
	 function calcular_edad($fecha){
      $dias = explode("/", $fecha, 3);
      $dias = mktime(0,0,0,$dias[1],$dias[0],$dias[2]);
      $edad = (int)((time()-$dias)/31556926 );
      return $edad;
   } 
	   
 }
?>