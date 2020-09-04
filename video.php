<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-ar">
<head>
<meta charset="utf-8" />
<title>cambio de video source</title>
</head>
<body>
    <div>
		<video width="100%" height="600px" poster="ACDC.jpg"  id="videouno" preload="auto"  autoplay="autoplay" controls>
		<source src="videos/con_calma.mp4" type="video/webm" id="webm">
		</video>
	</div>

		<script type="text/javascript">
		//<![CDATA[
		var v = document.getElementById("videouno");
		var wbm = document.getElementById("webm");
		var t;
		function verifica_fin(){
		if (v.ended){// cuando finaliza....
		wbm.src ='videos/No_Veo_La_Hora.mp4'; // modifica el src
		v.load(); // carga
		v.play(); // y lo reproduce
		}
		}
		t = setInterval('verifica_fin()',1000);
		//]]>
</script>
</body>
</html>