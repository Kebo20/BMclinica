<table id="IdTblSerie" border="1" bordercolor="#cccccc" >
	<thead>
	   <tr style="font-size:14px">
		 <Th>Nro</Th>
		 <Th>Tipo de Documento</Th>
		 <Th>Abreviatura</Th>
		 <Th>Serie</Th>
	   </tr>
	</thead>
	<tbody id="IdCuerpoSerie" style="font-size:12px;"> </tbody>
		 

	  
</table>

<br>
<div class="row">
	<div class="col-lg-4 col-md-12">
		<div class="form-group">
		<!-- Simple Icon Button -->
			<button type="button" class="btn bg-vino mr-1 mb-1" onClick="AbrirModalSerie()"><i class="ft-plus"></i> Nuevo</button>
			<!--<button type="button" class="btn bg-vino mr-1 mb-1"><i class="ft-edit-1"></i> Editar</button>-->
		</div>
	</div>	
</div>


<div id="IdModalSerie" class="modal fade" role="dialog"  >
   <div class="modal-dialog modal-lg" >
      <div class="modal-content">
      <div class="modal-header">
        &nbsp; INGRESE SERIE </h4> 
      </div>
    <div class="modal-body">

    <table width="100%">
        <tr style="display:none;">
            <td>Id</td>
            <td><input type="text" id="IdSer"  readonly="readonly" class="form-control"/></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><b>Tipo Documento Sunat</b> <br>
	<select id="TipoDoc" class="chosen-select form-control"  > </select> 
            </td>
        </tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
            <td><b>Nomenclatura Interna</b>
<input type="text" id="TxtNomenclatura" maxlength="2"  class="form-control" autocomplete="false" 
	    style="text-transform:uppercase" /> 
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><b>Serie</b>
				<input type="text" id="TxtNombreSer"  class="form-control" onkeyup="ValidarSer()" onkeypress="ValidarSer()" style="text-transform: uppercase;" autocomplete="off" >
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        
    </table>
       </div>
       
       <div class="modal-footer">
  <button type="button" id="BtnGrabarSerie" class="btn bg-vino mr-1 mb-1" onClick="RegistrarSerie()"> Grabar</button>
<button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"> Cancelar</button>									
								
      </div>

       
      </div>
 </div>
 </div>




<input type="hidden" id="IdFilaSerie" value="0"  >
<input type="hidden" id="ValorSerie" value="0"  >

<script type="text/javascript">
  $(document).ready(function() {
	$("#IdModalSerie").on('shown.bs.modal', function(){   $(this).find('#TxtNombreSer').focus(); 
	  $(this).find('.chosen-container').css({width: "100%"}); });
	$('#IdTblSerie').fixheadertable({
		//caption	: 'Lista de Areas', 
		colratio : [15,200,50,200], 
		height : 500, 
		width :'100%', 
		zebra : true, 
		sortable : false, 
		sortedColId : 3, 
		pager : false,
		rowsPerPage	 : 10,
		resizeCol : false,
	});
	  $('.chosen-select').chosen({allow_single_deselect:true});
     
  });
	
	function PintarFilaSerie($id){
	 var $idfilaanterior=$("#IdFilaSerie").val() 
	 
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
	//alert($id);alert($idfilaanterior)
	$("#"+$id).css({
	   "background-color": "#900052",
	   "color": "#FFFFFF"
	 })
	$("#IdFilaSerie").val($id)	
	
  }
	
	function LlenadoTipoDocumento($id){
	$.post("controlador/Cconfiguracion.php",{accion:'LLENAR_TIPODOC',id:$id},function(data){
		$("#TipoDoc").html(data).trigger("chosen:updated");
	 })
    }
	function LisSerie(){
	$("#IdCuerpoSerie").html("<tr><td colspan='2'> Cargando ..</td></tr>");
    $.post('controlador/Cconfiguracion.php',{accion:"LIS_SERIE"},function(data){
		$("#IdCuerpoSerie").html(data);$("#IdFilaSerie").val(0)
     })  
    }
	function AbrirModalSerie(){
	  $("#ValorSerie").val(1);LlenadoTipoDocumento(0)
	  $("#IdModalSerie").modal()
	  limpiar_campos_serie();
    }
	function CerrarModalSerie(){
	  $("#IdModalSerie").modal("hide")
    } 
	function limpiar_campos_serie(){
	  $("#IdSer,#TxtNombreSer,#TxtNomenclatura").val("");
	  $("#TipoDoc").val(0).trigger("chosen:updated");
	}
	
	function RegistrarSerie(){
	var $valor=$("#ValorSerie").val();
	var $id = $("#IdSer").val();
	var $serie = $("#TxtNombreSer").val()
	var $nomenclatura=$("#TxtNomenclatura").val()
	var $tipo_doc=$("#TipoDoc").val();
    var $nom_tipo_doc=$( "#TipoDoc option:selected" ).text();

	  if ($tipo_doc == 0){swal('Seleccione Tipo Documento ..', "Cuidado", "error");return false;}
	  if ($nomenclatura == ''){swal('Ingrese Nomenclatura ..', "Cuidado", "error");return false;}
	  if ($serie == ''){swal('Ingrese Serie ..', "Cuidado", "error");return false;}
	  

	$.post("controlador/Cconfiguracion.php",{accion:'NUEVO_SERIE',id:$id,serie:$serie,valor:$valor,tipo:$nom_tipo_doc,nom:$nomenclatura},function(data){
		if(data==1){$("#IdFilaSerie").val("");swal("Datos registrados Correctamente ..", "Felicitaciones", "success");LisSerie();CerrarModalSerie(); return false;}
		if(data==0){swal("Datos no registrados ..", "Error", "error"); return false;}
		if(data==2){swal("La Serie ya se encuentra registrada ..", "Error", "error"); return false;}
	})
	  
} 
	LisSerie()
	//LlenadoTipoDocumento(0)
	
</script>