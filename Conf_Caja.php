<table id="IdTblCaja" border="1" bordercolor="#cccccc" >
	<thead>
	   <tr style="font-size:14px">
		 <Th>Nro</Th>
		 <Th>Caja</Th>
		 <Th>Fecha crea</Th>
		 <Th>User crea</Th>
		 <Th>Estado</Th>
		 <Th>Asignar Serie</Th>  
	   </tr>
	</thead>
	<tbody id="IdCuerpoCaja" style="font-size:12px;"></tbody>  
</table>
<br>
<div class="row">
	<div class="col-lg-4 col-md-12">
		<div class="form-group">
		<!-- Simple Icon Button -->
	<button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="AbrirModalCaja()"><i class="ft-plus"></i> Nuevo</button>
			<button type="button" class="btn  bg-vino mr-1 mb-1" onClick="LlenarDatosCaja()"><i class="ft-edit-1"></i> Editar</button>
		</div>
	</div>	
</div>

<div id="IdModalCaja" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        
        &nbsp; INGRESE CAJA </h4>
        
      </div>
    <div class="modal-body">

    <table width="100%">
        <tr style="display:none;">
            <td><b>Id</b>
	<input type="text" id="IdCaja"  readonly="readonly" class="form-control"  /></td>
        </tr>
        
        <tr>
            <td><b>Caja</b><input type="text" id="TxtNombreCaja" style="text-transform:uppercase" class="form-control" autocomplete="off" >
            </td>
        </tr>
        
        <tr>
            <td><b>Estado</b>
				<select id="TxtEstadoCaja" class="form-control" style="height:35px" >
                   <option value="0">Habilitado</option>
                   <option value="1">Dehabilitado</option>
                </select>
            </td>
        </tr>
       <tr><td>&nbsp;</td></tr> 
    </table>
    </div>
    
    <div class="modal-footer">
        <button type="button" id="BtnGrabarSerie" class="btn bg-vino mr-1 mb-1" onClick="RegistrarCaja()"> Grabar</button>
<button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"> Cancelar</button>											
								
      </div>
    
   </div>

 </div>
</div>


<div id="IdModalAsignar" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        
        &nbsp; ASIGNAR SERIE </h4>
        
      </div>
    <div class="modal-body">

    <table width="100%" style="margin-bottom: 0px" >
        <tr>
            <td ><b>Tipo Documento Sunat</b> <br>
	<select id="TipoDocCaja" onChange="LlenadoSeriesCaja()" class="chosen-select form-control"  > </select> 
            </td>
		</tr>
        <tr>
            <td ><b>Serie</b><br>
				<select id="CboSerie" class="form-control" style="height:35px" >
				   <option value="0"></option>
				</select>
            </td>
        </tr>
		<tr><td  ><br>
				<button type="button" id="BtnAgregar" class="btn bg-vino mr-1 mb-1" onClick="RegistrarSerieCaja()"> Agregar</button></td></tr>
       <tr><td>&nbsp;</td></tr> 
    </table>
	<table class="table" style="margin-top: 0px">
		<thead>
		   <th width="50%">Caja</th>
		   <th width="20%">Cod. Sunat</th>
		   <th width="30%">Serie</th>
		</thead>
		<tbody id="CuerpoSerieCaja"></tbody>
	</table>
    </div>
    
    <div class="modal-footer">
        
<button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"> Cancelar</button>											
								
      </div>
    
   </div>

 </div>
</div>

<input type="hidden" id="IdFilaCaja" value="0"  >
<input type="hidden" id="ValorCaja" value="0"  >

<script type="text/javascript">
  $(document).ready(function() {
	$("#IdModalAsignar").on('shown.bs.modal', function(){$(this).find('.chosen-container').css({width: "100%"});});
	$('#IdTblCaja').fixheadertable({
		//caption	: 'Lista de Areas', 
		colratio : [15,50,50,50,50,30], 
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
 
function PintarFilaCaja($id){
	 var $idfilaanterior=$("#IdFilaCaja").val() 
	 
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
	$("#IdFilaCaja").val($id)	
	
  }
	
  function LisCaja(){
	$("#IdCuerpoCaja").html("<tr><td colspan='6'> Cargando ..</td></tr>");
    $.post('controlador/Cconfiguracion.php',{accion:"LIS_CAJA"},function(data){
		$("#IdCuerpoCaja").html(data);$("#IdFilaCaja").val(0)
     })  
    }
  function AbrirModalCaja(){
	  $("#ValorCaja").val(1);
	  $("#IdModalCaja").modal()
	  limpiar_campos_caja();
    }
  function RegistrarCaja(){
	//validar_data();
	var $valor=$("#ValorCaja").val();
	var $id = $("#IdCaja").val();
	var $caja = $("#TxtNombreCaja").val()
	var $estado=$("#TxtEstadoCaja").val()
	
	if ($caja == ''){swal("Ingrese Caja ..", "Campo Obligatorio", "warning");return false;}
	 
	$.post("controlador/Cconfiguracion.php",{accion:'NUEVO_CAJA',id:$id,caja:$caja,valor:$valor,est:$estado},function(data){
		 //alert(data)
		if(data==1){$("#IdFilaCaja").val(0);swal("Datos registrados Correctamente ..", "Felicitaciones", "success");
		          LisCaja();CerrarModalCaja(); return false;}
		if(data==0){swal("Datos no registrados ..", "Error", "error"); return false;}
	})	  
  }
  function LlenarDatosCaja(){
	 $("#ValorCaja").val(2)
	 var $ident = $("#IdFilaCaja").val()
     var $id=$("#"+$ident).attr("idcaja")
	 var $caja=$("#"+$ident).attr("nom")
	 var $est=$("#"+$ident).attr("est")

	if($ident == ''){
		//alert("Debe seleccionar un Registro");
		swal("Debe seleccionar un Registro", "Seleccione Registro", "warning");return false;
	}
	else{
		$("#IdCaja").val($id)
		$("#TxtNombreCaja").val($caja)		
		$("#TxtEstadoCaja").val($est)						
		$("#IdModalCaja").modal();
		
	}	
  }
  function LlenadoTipoDocCaja($id){
	$.post("controlador/Cconfiguracion.php",{accion:'LLE_TIPODOC',id:$id},function(data){
		$("#TipoDocCaja").html(data).trigger("chosen:updated");
	 })
    }
  function LlenadoSeriesCaja(){
	  $cod_sunat=$("#TipoDocCaja").val()
	  //alert($cod_sunat)
	$.post("controlador/Cconfiguracion.php",{accion:'LLE_SERIES',cod:$cod_sunat},function(data){
		$("#CboSerie").html(data).trigger("chosen:updated");
	 })
    }
  function AbrirModalAsignar($id){
	  LlenadoTipoDocCaja($id);LisSerieCaja($id)
	  $("#IdModalAsignar").modal()
    }
  function LisSerieCaja($idcaja){
	$("#CuerpoSerieCaja").html("<tr><td colspan='3'> Cargando ..</td></tr>");
    $.post('controlador/Cconfiguracion.php',{accion:"LIS_SERIE_CAJA",idcaja:$idcaja},function(data){
		$("#CuerpoSerieCaja").html(data);
     })  
    }
  function RegistrarSerieCaja(){
	//validar_data();
	var $fila=$("#IdFilaCaja").val()
	var $idcaja=$("#"+$fila).attr('idcaja')
	var $cod_sunat = $("#TipoDocCaja").val();
	var $idserie = $("#CboSerie").val()
	 //alert($cod_sunat);alert($idserie);exit;
	if ($cod_sunat ==0){swal("Seleccione Tipo Documento ..", "Campo Obligatorio", "warning");return false;}
	if ($idserie ==0){swal("Seleccione Serie ..", "Campo Obligatorio", "warning");return false;}
	 
	$.post("controlador/Cconfiguracion.php",{accion:'NUEVO_CAJA_SERIE',id:$idcaja,cod:$cod_sunat,idserie:$idserie},function(data){
		if(data==1){LlenadoTipoDocCaja($idcaja);$("#TipoDocCaja").val(0).trigger("chosen:updated");
					LisSerieCaja($idcaja);LlenadoSeriesCaja();
					swal("Datos registrados Correctamente ..", "Felicitaciones", "success"); return false;}
		if(data==0){swal("Datos no registrados ..", "Error", "error"); return false;}
	})	  
  }
  
  function CerrarModalCaja(){
	  $("#IdModalCaja").modal("hide")
    }
  function limpiar_campos_caja(){
	$("#IdCaja,#TxtNombreCaja").val("");
	}
  LisCaja()	
</script>