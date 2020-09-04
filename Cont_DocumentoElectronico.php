<?php  require_once('cado/ClaseConfiguracion.php'); 
$oconfiguracion=new Configuraciones();

date_default_timezone_set('America/Lima');
 ?>
 
 
	    
       <table width="100%">
         <tr>

            <td width="1%">&nbsp;</td>
            <td width="10%"> 
            <b>Serie</b>
       <select id="CboSerie" class="form-control" style="width:90%"></select>
         </td>
         <td width="10%" id="TdPac"> 
         <b>Acto M&eacute;dico</b>
      <input type="text" class="form-control" id="ActoMed" style="width:90%; " />
         </td>
         <td width="15%"> 
         <b>Fec. Inicio</b>
      <input type="date" class="chosen-select form-control"  id="FecInicio" max="<?=date('Y-m-d')?>" value="<?=date('Y-m-d')?>" 
      style="width:90%" >
         </td>
         <td width="15%"> 
         <b>Fec. Fin</b>
      <input type="date" class="chosen-select form-control"  id="FecFin" value="<?=date('Y-m-d')?>" max="<?=date('Y-m-d')?>"
       style="width:90%" />
         </td>
         
         <td width="8%" align="center"> <br />
         <button type="button" class="btn btn-icon bg-vino mr-1 mb-1" onclick="LisDoc();">
        <i class="la la-search">
        </i>
      </button>
         
         </td>
         </tr>
       </table>									
 
   <table id="IdTblDoc" border="1" bordercolor="#cccccc" >
               <thead>
                <tr>
                 <th align="center">Nro</th>
                 <th align="center">Serie</th>
                 <th align="center" >Correlativo</th>
                 <th align="center">Fecha</th>
                 <th >&nbsp;&nbsp;Paciente / Raz&oacute;n Social</th>
                 <th >Total</th>
                 <th align="center">PDF</th>
                 <th align="center" >XML</th>
                 <th >Estado</th></tr>
               </thead>
               <tbody id="IdCuReOrdenes" style="font-size:12px;">
               <tr>
                 <td align="center">1</td>
                 <td align="center">FA01</td>
                 <td align="center">00004813</td>
                 <td align="center">24/03/2020</td>
                 <td >&nbsp;&nbsp;XXXXX YYYYYYY WWWWWW ZZZZZZZ</td>
                 <td >&nbsp;&nbsp; S/ 120</td>
                 <td align="center"><img src="img/pdf.png" height="20" width="20" onclick="VerPdf('1')"  /></td>
                 <td align="center"><img src="img/xml.jpg" height="20" width="20" onclick="VerXml('$tipo_doc','$serie','$correlativo)'" />
                 </td>
                 <td >PENDIENTE</td></tr>
               </tbody>
    </table> 
<br />
      <table width="100%">
       <tr>
          <td width="50%"> 
        <button type="button" class="btn btn-icon bg-vino mr-1 mb-1"  id="BtnAnul" onclick="javascript:AnularDocumento()">
        Anular Documento </button>
 &nbsp;&nbsp;<button type="button" id="IdDecJu" class="btn btn-icon bg-vino mr-1 mb-1" onclick="javascript:CargarReporteDoc()">
 Ver Reporte</button>
     &nbsp;&nbsp;<button type="button" id="IdDecJu" class="btn btn-icon bg-vino mr-1 mb-1" onclick="javascript:CargarReporteExcel()">
     Reporte Declaraci&oacute;n </button>
          </td>
       </tr>
     </table>            								

  
      
    

 <script>            
 $(document).ready(function() {
	$('#IdTblDoc').fixheadertable({
		//caption	: 'Lista de Areas', 
		colratio : [5,5,7,10,30,7,5,5,10], 
		height : 300, 
		width :'100%', 
		zebra : true, 
		sortable : false, 
		sortedColId : 3, 
		pager : false,
		rowsPerPage	 : 10,
		resizeCol : false,
	});
  });	
	 function PintarFila($id,$estado){
	 var $idfilaanterior=$("#IdHiRepor").val()  
	 var $par=$idfilaanterior.split('_')
	 var $par_int=parseInt($par[1])
	// alert($par_int)
		 if($par_int%2==0){
		   // alert("hola")
		  $("#"+$idfilaanterior).css({ 
			   "background-color":"#f5f5f5",
			   "color": "#000000"
			})
		}else{
		   $("#"+$idfilaanterior).css({
			   "background-color":"#FFFFFF",
			   "color": "#000000"
			})					   
		}
		$("#"+$id).css({
		   "background-color": "#438EB9",
		   "color": "#FFFFFF"
		 })
		 if($estado=='ANULADO'){$("#BtnAnul").hide()}else{$("#BtnAnul").show()}
		$("#IdHiRepor").val($id)	
  } 

    function LisSerie(){
		 var $datos='';
		 
		 $.post('controlador/Cadmision.php',{accion:"LIS_SERIE"},function(data){
		    $("#CboSerie").html(data)
		 })	   
	 }
	
	 function VerPdf($id){
		//url="http://localhost/ErpSalud/FactElect/vercomprobante/"+$id
		url="http://localhost/ErpSalud/plugins/20561370096-01-FA01-00004813.pdf"
		
		abrirEnPestana(url) 
	 }
	 
	 function VerXml($tipo_doc,$serie,$correlativo){
		 // alert($serie);exit;
		url="XmlDoc.php?t="+$tipo_doc+"&s="+$serie+"&c="+$correlativo
		abrirEnPestana(url) 
		
	 }
	 
	
	 
    function LisDoc(){
		  // alert('hola')
	       $tipo=$("#CboSerie option:selected").text();
		   $pac=$("#IdHiPac").val()
		   $nom_pac=$("#pac1").val()
		   $ini=$("#FecInicio").val()
		   $fin=$("#FecFin").val()
		   if($tipo==''){$tipo=0;}
		   if($nom_pac==''){$pac=0;}
		   if($ini=='' || $fin==''){swal("Ingrese Fechas",'Campos Obligatorios','warning');
		   $("#FecInicio").val($("#IdHiFecha").val());$("#FecFin").val($("#IdHiFecha").val()); return false;}
		   $("#IdCargando").show()
			//alert($tipo)
	       $.post("controlador/Creporte.php",{accion:'DOC',t:$tipo,pac:$pac,ini:$ini,fin:$fin},function(data){
			   
			   $("#IdCuReOrdenes").html(data);$("#IdCargando").hide()
			})    
	 } 
	 
     
	 
	 
	// function ValidarFechas(){$fin=$("#FecFin").val();$("#FecInicio").val($fin).attr("max",$fin)}
	
	function abrirEnPestana(url) {
		var a = document.createElement("a");
		a.target = "_blank";
		a.href = url;
		a.click();
	}
	
	/*function CargarOrden(){
		$ident = $("#IdHiRepor").val()
		$orden=$("#"+$ident).attr('orden');
		if($ident == ''){swal("Debe seleccionar un Registro", "Seleccione Registro", "warning");return false;}
	    url="Pdf_Orden.php?o="+$orden+"&t=P"
		abrirEnPestana(url)
	 }*/
	
	function CargarReporteDoc(){
		   $ident = $("#IdHiRepor").val()
		   $serie=$("#CboSerie").val()
		   $pac=$("#IdHiPac").val()
		   $nom_pac=$("#pac1").val()
		   $ini=$("#FecInicio").val()
		   $fin=$("#FecFin").val()
		  
		   if($nom_pac==''){$pac=0;}
		   if($ini=='' || $fin==''){swal("Ingrese Fechas",'Campos Obligatorios','warning');} 
		   url="Pdf_ReporteDocumentos.php?s="+$serie+"&p="+$pac+"&ini="+$ini+"&fin="+$fin+"&t=P"
		   abrirEnPestana(url)
	 }
    
	function CargarReporteExcel(){
		   $ini=$("#FecInicio").val()
		   $fin=$("#FecFin").val()
	       location.href="Librerias/PhpSpreadsheet/ExcelReporteDocumentos.php?ini="+$ini+"&fin="+$fin
	 }
	 
 // ValidarFechas()
  LisSerie()
 
  
   function AnularDocumento(){
		$ident = $("#IdHiRepor").val()
		$doc=$("#"+$ident).attr('doc');
		$serie=$("#"+$ident).attr('serie');
		$grupal=$("#"+$ident).attr('grupal');
		if($ident == ''){swal("Debe seleccionar un Registro", "Seleccione Registro", "warning");return false;} 
swal({
  title: "Confirmacion",
  text: "Está seguro de Anular Documento",
  icon: "warning",
  buttons: true,
  dangerMode: true}).then((willDelete) => {
  if (willDelete) {
    $.post("controlador/Creporte.php",{accion:'ANULAR_DOC',doc:$doc,serie:$serie,grupal:$grupal},function(data){
		   if(data==1){LisDoc();swal("Documento Anulado",'Anulado','success');return false;}
		   if(data==0){swal("No se pudo Anular",'Error','error');return false;}
	     })
        } 
      });
	 }
  

 </script>
  
  <input type="hidden" id="IdHiRepor"  />         
 
  <input type="hidden" id="IdHiFecha" value="<?=date('Y-m-d')?>"  />


          