<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<link rel="stylesheet" href="assets/css/acceso.css" type="text/css">
<link rel="stylesheet" href="app-assets/css/bootstrap.min.css">
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/password.js"></script>
<script src="plugins/js/sweetalert.min.js"></script>
<title>Sistema de ticket</title>
</head>
<body class="fondo_ticket">
	<div class="contenedor">	            
		<div class="logo"><img src="img/bm-clinica-logo.png" width="100%"></div>        
		<div style="height: 5px;">&nbsp;</div>
		<div class="m-0" onClick="Imprimir()" >
			<div class="redondear_ticket">
				<a href="#" class="btn" ><img src="img/icono_ticket.png" width="50%"><br>
							<h4 class="color-texto-vino">Atenci&oacute;n General</h4>
				</a>
			</div>
		</div>	  
	</div>
<script>
 
	function Imprimir(){
		$url="http://localhost/ErpSalud/Ticket_Formato.php"	 
	 $.ajax({
		type:'POST',
		url:$url,
		//data:{iddoc:$iddoc,cod:$cod,orden:$orden},
		success: function(datos){
			swal({
				title: "Pronto Será Atendido",
                text: "   ",
                icon: "success",
                buttons: false,
				timer: 1500
			 });
		   
		 }
	    });
     }	
</script>
	
</body>
</html>




