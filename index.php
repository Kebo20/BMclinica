<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<link rel="stylesheet" href="assets/css/acceso.css" type="text/css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="plugins/js/sweetalert.min.js"></script>
<script src="assets/js/password.js"></script>
<title>Acceso al Sistema BM clinica</title>
	<style>
		.clavecita {
			width: 100%;
			margin: 0 auto;
		
		}
		span {
			cursor: pointer;
		}
	</style>
  <script>
   
  function Acceder(){
	  
     $user=$("#username").val()
	 $pass=$("#password").val()
	 if($user==''){swal("Ingrese Usuario ..", "Verifique sus Datos", "error");$("#username").focus(); return false;}
	 if($pass==''){swal("Ingrese Contraseña ..", "Verifique sus Datos", "error");$("#password").focus(); return false;}
	  
	 $.post("controlador/Cacceso.php",{accion:'ACCEDER',user:$user,pass:$pass},function(data){
		 console.log(data)
		if(data==0){swal("Usuario o Contraseña Incorrecta", "Verifique sus Datos", "error");return false;}
		else{location.href='Panel.php';
			/*if($data[1]=='ADMIN'){location.href='Adm_Panel.php';}
			if($data[1]=='SIST'){location.href='Adm_Panel.php';}
			if($data[1]=='CAJA'){location.href='Adm_Cajero.php';}*/
		  }
	 })
   }
 $(document).ready(function() {  
  $("#username").focus()
  $("#password" ).keypress(function( event ) {
    if ( event.which == 13 ) {
       Acceder()
      }
   });
 })
</script>
</head>
<body class="fondo">
	<div class="contenedor">
	            
		<div class="logo"><img src="img/bm-clinica-logo.png" width="80%"></div>            
		<div class="form-group">
			<input class="form-control color-text-login" type="text" name="usuario" id="username"  placeholder="Usuario">
		</div>
		<div class="clavecita">
			<input class="form-control" type="password" id="password" name="clave"  placeholder="Contraseña" style="width:280px">
			<span id="show-hide-passwd" action="hide" class="clavecita-addon glyphicon glyphicon glyphicon-eye-open" style="border-radius: 0px;border:0px;color: #900052; left: 80%; padding:0px; position: absolute; z-index: 30;top: 300px;"></span>
		</div>
		<div style="height: 15px;">&nbsp;</div>
		<div class="form-group">
			<button class="btn btn-primary btn-block btn-iniciar" onClick="Acceder()" >INGRESAR</button></div>
		    <a href="#" class="forgot">Recuperar mi Contraseña</a>
	  
	</div>

</body>
</html>




