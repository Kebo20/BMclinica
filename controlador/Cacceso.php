<?php   require_once('../cado/ClaseAcceso.php'); 
	    date_default_timezone_set('America/Lima');
	    session_start();

        controlador($_POST['accion']);
                 

        function controlador($accion){
		   $oacceso= new Accesos();
		  if($accion=='ACCEDER'){	
	          $user=$_POST['user'];
              $pass=$_POST['pass'];
              $listar=$oacceso->Acceso($user,$pass);$i=0;
		      while($fila=$listar->fetch()){$i++; $_SESSION['S_user']=$fila[2];$tipo_user=$fila[5];$_SESSION['S_iduser']=$fila[0];
		       $_SESSION['S_idcaja']=$fila['idcaja']; $_SESSION['S_caja']=$fila['nom_caja']; 
		        $_SESSION['S_cod_ingreso']=$fila['codigo_ingreso'];$_SESSION['S_grupo_nombre']=$fila['nom_grupo'];				
		       } 
		  
		      echo $i;
		  }
			
			
	    }

	    
?>