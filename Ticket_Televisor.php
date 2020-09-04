<?php date_default_timezone_set("America/Lima");?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="app-assets/css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="assets/css/acceso.css" type="text/css">
<script src="assets/js/jquery-3.2.1.min.js"></script>
<title>Pantalla de Atención</title>

</head>
<body>
<div class="container-fluid">
	<div class="row align-items-center justify-content-center">
		<div class="col-8">
			<div class="row align-items-center justify-content-center">
				<div class="col-10"><img class="loguito_pantalla" src="img/bm-clinica-logo-pantalla.png"></div>
				<div class="col-2"><h4 class="text-center color-texto-vino"><?=date("d/m/y")."<br>".date("h:i:sa");?></h4></div>		
			</div>
		</div>
		<div class="col-4">
			<div class="row align-items-center justify-content-center">
				<div class="col-6 br-abajo-izquierda p-1">TURNO</div>
				<div class="col-6 br-abajo-derecha p-1">VENTANILLA</div>
			</div>			
		</div>
	</div>
	
	<div class="row cuerpo_pantalla">
		<div class="col-8 bg-dark">
			
			<video width="100%" height="600px" autoplay controls id="Player" src="videos/con_calma.mp4" onclick="this.paused ? this.play() : this.pause();"></video>

			<script>
			var nextsrc = ["videos/con_calma.mp4","videos/No_Veo_La_Hora.mp4","videos/Dejaria_Todo.mp4"];
			var elm = 0; var Player = document.getElementById('Player');
			Player.onended = function(){
				if(++elm < nextsrc.length){         
					 Player.src = nextsrc[elm]; Player.play();
				} 
			}
			</script>
			<!--<ul id="playlist">
				<li movieurl="videos/con_calma.mp4" moviesposter="videos/img_video01.jpg">Primer video</li>
				<li movieurl="videos/No_Veo_La_Hora.mp4" moviesposter="videos/img_video02.jpg">Segundo video</li>				
			</ul>-->
			
		</div>
		<div class="col-4 p-2 m-0">
			<div class="row pb-1">
				<div class="col-6"><div class="color_fondo_vino_izquierda" id="IdTurno1" >-</div></div>
				<div class="col-6"><div class="color_fondo_vino_derecha" id="Ven1" >01</div></div>
			</div>
			<div class="row pb-1">
				<div class="col-6"><div class="color_fondo_vino_izquierda" id="IdTurno2" >-</div></div>
				<div class="col-6"><div class="color_fondo_vino_derecha" id="Ven2">02</div></div>
			</div>
			<div class="row pb-1">
				<div class="col-6"><div class="color_fondo_vino_izquierda" id="IdTurno3">-</div></div>
				<div class="col-6"><div class="color_fondo_vino_derecha" id="Ven3">03</div></div>
			</div>
			<!--<div class="row pb-1">
				<div class="col-6"><div class="color_fondo_vino_izquierda">004</div></div>
				<div class="col-6"><div class="color_fondo_vino_derecha">04</div></div>
			</div>-->
			<!--<div class="row pb-1">
				<div class="col-6"><div class="color_fondo_claro_izquierda">001</div></div>
				<div class="col-6"><div class="color_fondo_claro_derecha">04</div></div>
			</div>-->
			
		</div>
	</div>
	<div class="row pie_pantalla">
		<div class="col-12"><marquee>Nuestros Horarios de Atenci&oacute;n: Lunes a Viernes de 8:00 am</marquee></div>
	</div>
</div>
	
	<script>
	function Listar(){
	 setTimeout(function(){  
	   $.post("controlador/Cticket.php",{accion:'TELE_TURNOS'},function(data){
		  $data=data.split('*')
		  $("#IdTurno1").html($data[0]);$("#IdTurno2").html($data[1]);$("#IdTurno3").html($data[2])
		    //console.log($data[3])
			if($data[3]==1){ $("#IdTurno1,#Ven1").addClass("parpadea");setTimeout(function(){FinParpadeo()  }, 1000);}
				
				
		    if($data[4]==1){$("#IdTurno2,#Ven2").addClass("parpadea");FinParpadeo();}
		    if($data[5]==1){$("#IdTurno3,#Ven3").addClass("parpadea");FinParpadeo();}  
            
		   Listar()
	   })
	 }, 1000);
	}
	function FinParpadeo(){ $.post("controlador/Cticket.php",{accion:'FIN_PARPADEO'},function(data){
	  $("#IdTurno1,#Ven1").removeClass("parpadea")
	}) } 
	     	
	
  // setInterval(Listar, 1000);

	Listar()
</script>
	
</body> 
</html>