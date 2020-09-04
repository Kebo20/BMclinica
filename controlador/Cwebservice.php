<?php   require_once('../cado/ClaseWebService.php'); 
	    date_default_timezone_set('America/Lima');
	    session_start();
	
	

   controlador($_POST['accion']);
   
    function controlador($accion){
	
	   $owebservice=new WebServices();
	  
	 if($accion=='WEBSERVICE_DNI'){
	  $dni=$_POST['dni'];
	  $validar=$owebservice->ValidarPersona($dni)->fetch();
	  
	  if($validar[0]==''){
		$data = file_get_contents("https://rest.softdatamen.com/v1/2d44b63f1e01c81f33670960e0410157/reniec?dni=".$dni);
	    $info = json_decode($data, true);
		
		
		 
		 $datos = array(
	       0 => $info['result']['nuDni'], 
	       1 => $info['result']['apePaterno'],
	       2 => $info['result']['apeMaterno'],
	       3 => $info['result']['preNombres'],
	       4 => $info['result']['feNacimiento'],
	       5 => $info['result']['estatura'],
	       6 => $info['result']['sexo'],
	       7 => $info['result']['estadoCivil'],
	       8 => $info['result']['depaDireccion'],
	       9 => $info['result']['provDireccion'],
	      10 => $info['result']['distDireccion'],
	      11 => $info['result']['desDireccion'],
	      12 => $info['images']['foto'],
	      13 => $info['images']['firma'],
	      14 => $info['images']['hizquierda'],
	      15 => $info['images']['hderecha']
          ); 
		  $edad=$owebservice->calcular_edad($datos[4]);
		 if($datos[0]==''){ echo 'NO';exit; } 
	     else{
	     $user='MELIAS';
		 $insertar=$owebservice->RegistrarPersona($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6]
		,$datos[7],$datos[8],$datos[9],$datos[10],$datos[11],$datos[12],$datos[13],$datos[14],$datos[15],$user);
		  if($insertar==0){echo 'ERROR';exit;}
	      array_push($datos,$insertar,$edad);
	    }
	   }else{
		  $datos = array(
	       0 => $validar[0], 
	       1 => $validar[1],
	       2 => $validar[2],
	       3 => $validar[3],
	       4 => $validar[4],
	       5 => $validar[5],
	       6 => $validar[6],
	       7 => $validar[7],
	       8 => $validar[8],
	       9 => $validar[9],
	      10 => $validar[10],
	      11 => $validar[11],
	      12 => $validar[12],
	      13 => $validar[13],
	      14 => $validar[14],
	      15 => $validar[15],
		  16 => $validar[16],
		  17 => $validar[17]
          ); 
	  }
	  
		echo json_encode($datos); 

	   /*$anio=date('Y');$mes=date('m');
	   $ver=$opaciente->ValidarCanConsultas($anio,$mes);
	   while($fi=$ver->fetch()){$can_con=$fi[0];}
	   if($can_con==0){$opaciente->InsertarCanConsultas($anio,$mes);}
	   if($can_con==1){$opaciente->UpdateCanConsultas($anio,$mes);}	
	   if($datos[0]==''){ echo 'NO';exit;
		}else{
	      echo json_encode($datos); 
		}*/
	 
	 }
	
}
?>