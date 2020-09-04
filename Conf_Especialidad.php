
<table id="IdTblEsp" border="1" bordercolor="#cccccc" >
	<thead>
	   <tr style="font-size:14px">
		 <Th>Nro</Th>
		 <Th>Especialidad</Th>
	   </tr>
	</thead>
	<tbody id="TbodyEsp" style="font-size:12px;"></tbody> 
</table>

<br>
<div class="row">
	<div class="col-lg-4 col-md-12">
		<div class="form-group">
		<!-- Simple Icon Button -->
			<button type="button" class="btn bg-vino mr-1 mb-1" onClick="AbrirModalEsp()"><i class="ft-plus"  ></i> Nuevo</button>
			<button type="button" class="btn bg-vino mr-1 mb-1" onClick="LlenarDatosEsp()"><i class="ft-edit-1"></i> Editar</button>
			<button type="button" class="btn bg-vino mr-1 mb-1" onClick="EliminarEsp()"><i class="ft-trash-2"></i> Eliminar</button>
		</div>
	</div>
	<div class="col-lg-5 col-md-12">
		<input type="text" class="form-control" placeholder="Buscar Especialidad - Enter" id="TxtBuscarEsp" >
	</div>
</div>

<!-- MODAL REGISTRAR ESPECIALIDAD -->
   
	<div id="IdModalEsp" class="modal fade" role="dialog" >
 
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">&nbsp; INGRESE ESPECIALIDAD MEDICA </div>
    			<div class="modal-body">
    				<table  width="100%" style="font-size:13px; font-weight:bold;">
						<tr style="display: none">
							<td>Id</td>
							<td><input name ="id_gru" type="text" id="id_esp" size="5" readonly="readonly" class="form-control"/></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr><td colspan="2">Especialidad</td></tr>
            			<tr><td colspan="2"><input name ="nombre_esp" type="text" id="nombre_esp" style="text-transform:uppercase" class="form-control" value="" autocomplete="off" ></td></tr>        
        				<tr><td colspan="2">&nbsp;</td></tr>
    				</table>
 				</div>
				<div class="modal-footer" style="padding-bottom: 8px;">
				  <button type="button" id="BtnGrabarEsp" class="btn bg-vino mr-1 mb-1" onClick="RegistrarEsp()"> Grabar</button>
				  <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"> Cancelar</button>
				</div>
        	</div>
		</div>
	</div>

<!-- FIN MODAL REGISTRAR ESPECIALIDAD -->

<input type="hidden" id="IdFilaEsp" value="0">
<input type="hidden" id="ValorEsp" value="0">

<script type="text/javascript">
$(document).ready(function() {
   $("#IdModalEsp").on('shown.bs.modal', function(){   $(this).find('#nombre_esp').focus();  });
   $('#IdTblEsp').fixheadertable({
		//caption	: 'Lista de Areas', 
		colratio : [15,300], 
		height : 500, 
		width :'100%', 
		zebra : true, 
		sortable : false, 
		sortedColId : 3, 
		pager : false,
		rowsPerPage	 : 10,
	 	resizeCol : false,
	 });
	
	$("#TxtBuscarEsp").keypress(function(e) {  
	   if(e.which==13) {
          LisEsp()
       }
    })
	
 });
	
 function AbrirModalEsp(){ limpiar_campos_esp();  $("#ValorEsp").val(1); $("#IdModalEsp").modal()   }
	
 function CerrarModalEsp(){  $("#IdModalEsp").modal("hide");  }

 function LisEsp(){	
	var $buscar=$("#TxtBuscarEsp").val()
     $.post('controlador/Cconfiguracion.php',{accion:"LIS_ESP",buscar:$buscar},function(data){
		$("#TbodyEsp").html(data);$("#IdFilaEsp").val(0);
     })  
 }
 
 function PintarFilaEsp($id){
	 var $idfilaanterior=$("#IdFilaEsp").val() 
	 
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
	$("#IdFilaEsp").val($id)	
	
  } 
	
 function RegistrarEsp(){
	//validar_data();
	var $valor=$("#ValorEsp").val();
	var $id = $("#id_esp").val();
	var $nombre = $("#nombre_esp").val()
  
	if ($nombre == ''){swal("Ingrese Especialidad ..", "Campo Obligatorio", "warning");return false;}
	$("#BtnGrabarEsp").prop("disabled",true);
	$.post("controlador/Cconfiguracion.php",{accion:'NUEVO_ESP',id:$id,nombre:$nombre,valor:$valor},function(data){
		$("#BtnGrabarEsp").prop("disabled",false);
		if(data==1){LisEsp();swal("Dato registrado Correctamente", "Felicitaciones", "success");
		CerrarModalEsp(); return false;}
		if(data==0){swal("Datos no registrados Correctamente ..", "Error", "error"); return false;}
		
	})
	  
} 
 
 function LlenarDatosEsp(){
	 $("#ValorEsp").val(2)
	 var $ident = $("#IdFilaEsp").val()
     var $id=$("#"+$ident).attr("idesp")
	 var $nombre=$("#"+$ident).attr("nom")
      
	if($ident ==0){
		swal("Debe seleccionar un Registro", "Obligatorio", "warning");
		return false;
	}
	else{				
		$("#id_esp").val($id)
		$("#nombre_esp").val($nombre)
		$("#IdModalEsp").modal()
	 }	
  }
	
 function EliminarEsp(){
	 
	 var $ident = $("#IdFilaEsp").val()
     var $id=$("#"+$ident).attr("idesp")
	  
	if($ident ==0){
		swal("Debe seleccionar un Registro", "Obligatorio", "warning");
		return false;
	}
	
  swal({
  title: "Confirmación",
  text: "Está seguro Eliminar Especialidad",
  icon: "warning",
  buttons: true,
  dangerMode: true}).then((willDelete) => {
  if (willDelete) {
    $.post("controlador/Cconfiguracion.php",{accion:'ELI_ESP',id:$id},function(data){
		   if(data==1){LisEsp(); swal("Especialidad Eliminado",'Felicitaciones','success');return false;}
		   if(data==0){swal("Error",'Error','error');return false;}
		   
	     })
        } 
      });  
	  
  }
	
 function limpiar_campos_esp(){  $("#id_esp,#nombre_esp").val(""); }	
	
LisEsp('')

</script>