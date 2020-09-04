
<table id="IdTblGruUsu" border="1" bordercolor="#cccccc" >
	<thead>
	   <tr style="font-size:14px">
		 <Th>Nro</Th>
		 <Th>Nombre Grupo</Th>
	   </tr>
	</thead>
	<tbody id="TbodyGruUsu" style="font-size:12px;"></tbody> 
</table>

<br>
<div class="row">
	<div class="col-lg-4 col-md-12">
		<div class="form-group">
		<!-- Simple Icon Button -->
			<button type="button" class="btn bg-vino mr-1 mb-1" onClick="AbrirModalGruUsu()"><i class="ft-plus"  ></i> Nuevo</button>
			<button type="button" class="btn bg-vino mr-1 mb-1" onClick="LlenarDatosGruUsu()"><i class="ft-edit-1"></i> Editar</button>
			<button type="button" class="btn bg-vino mr-1 mb-1" onClick="EliminarGruUsu()"><i class="ft-trash-2"></i> Eliminar</button>
		</div>
	</div>
	<div class="col-lg-5 col-md-12">
		<input type="text" class="form-control" placeholder="Buscar Grupo - Enter" id="TxtBuscar" >
	</div>
</div>

<!-- MODAL REGISTRAR GRUPO USUARIO -->
   
	<div id="IdModalGruUsu" class="modal fade" role="dialog" >
 
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">&nbsp; INGRESE GRUPO DE USUARIO </div>
    			<div class="modal-body">
    				<table  width="100%" style="font-size:13px; font-weight:bold;">
						<tr style="display: none">
							<td>Id</td>
							<td><input name ="id_gru" type="text" id="id_gru" size="5" readonly="readonly" class="form-control"/></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>
						<tr><td colspan="2">Grupo Usuario</td></tr>
            			<tr><td colspan="2"><input name ="nombre" type="text" id="nombre" style="text-transform:uppercase" class="form-control" value="" autocomplete="off" ></td></tr>        
        				<tr><td colspan="2">&nbsp;</td></tr>
    				</table>
 				</div>
				<div class="modal-footer" style="padding-bottom: 8px;">
				  <button type="button" id="BtnGrabarGruUsu" class="btn bg-vino mr-1 mb-1" onClick="RegistrarGrupo()"> Grabar</button>
				  <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"> Cancelar</button>
				</div>
        	</div>
		</div>
	</div>

<!-- FIN MODAL REGISTRAR USUARIO-->

<input type="hidden" id="IdFila" value="0">
<input type="hidden" id="ValorGruUsu" value="0">

<script type="text/javascript">
$(document).ready(function() {
   $("#IdModalGruUsu").on('shown.bs.modal', function(){   $(this).find('#nombre').focus();  });
   $('#IdTblGruUsu').fixheadertable({
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
	
	$("#TxtBuscar").keypress(function(e) {  
	   if(e.which==13) {
          LisGruUsu()
       }
    })
	
 });
	
 function AbrirModalGruUsu(){ limpiar_campos();  $("#ValorGruUsu").val(1); $("#IdModalGruUsu").modal()   }
	
 function CerrarModal(){  $("#IdModalGruUsu").modal("hide");  }

 function LisGruUsu(){	
	var $buscar=$("#TxtBuscar").val()
	
     $.post('controlador/Cconfiguracion.php',{accion:"LIS_GRU_USU",buscar:$buscar},function(data){
		$("#TbodyGruUsu").html(data);$("#IdFila").val(0);
     })  
 }
 
 function PintarFila($id){
	 var $idfilaanterior=$("#IdFila").val() 
	 
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
	$("#IdFila").val($id)	
	
  } 
	
 function RegistrarGrupo(){
	//validar_data();
	var $valor=$("#ValorGruUsu").val();
	var $id = $("#id_gru").val();
	var $nombre = $("#nombre").val()
  
	if ($nombre == ''){swal("Ingrese Nombre de Grupo ..", "Campo Obligatorio", "warning");$("#usuario").focus();return false;}
	$("#BtnGrabarGruUsu").prop("disabled",true);
	$.post("controlador/Cconfiguracion.php",{accion:'NUEVO_GRUPO',id:$id,nombre:$nombre,valor:$valor},function(data){
		$("#BtnGrabarGruUsu").prop("disabled",false);
		if(data==2){swal("Nombre Grupo ya existe ..", "Error", "error"); return false;}
		if(data==1){$("#IdFila").val("");swal("Dato registrado Correctamente", "Felicitaciones", "success");
		LisGruUsu();CerrarModal(); return false;}
		if(data==0){swal("Datos no registrados Correctamente ..", "Error", "error"); return false;}
		
	})
	  
} 
 
 function LlenarDatosGruUsu(){
	 $("#ValorGruUsu").val(2)
	 var $ident = $("#IdFila").val()
     var $id=$("#"+$ident).attr("IdGruUsu")
	 var $nombre=$("#"+$ident).attr("nombre")
      
	if($ident ==0){
		swal("Debe seleccionar un Registro", "Obligatorio", "warning");
		return false;
	}
	else{				
		$("#id_gru").val($id)
		$("#nombre").val($nombre)
		$("#IdModalGruUsu").modal()
	 }	
  }
	
 function EliminarGruUsu(){
	 
	 var $ident = $("#IdFila").val()
     var $id=$("#"+$ident).attr("IdGruUsu")
	  
	if($ident ==0){
		swal("Debe seleccionar un Registro", "Obligatorio", "warning");
		return false;
	}
	
  swal({
  title: "Confirmación",
  text: "Está seguro Eliminar Grupo",
  icon: "warning",
  buttons: true,
  dangerMode: true}).then((willDelete) => {
  if (willDelete) {
    $.post("controlador/Cconfiguracion.php",{accion:'ELI_GRU_USU',id:$id},function(data){
		   if(data==1){LisGruUsu(); swal("Grupo Eliminado",'Felicitaciones','success');return false;}
		   if(data==0){swal("Error",'Error','error');return false;}
		   
	     })
        } 
      });  
	  
  }
	
 function limpiar_campos(){  $("#id_gru,#nombre,#IdBuscar").val(""); }	
	
LisGruUsu()

</script>