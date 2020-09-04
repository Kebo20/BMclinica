<table id="IdTblPac" border="1" bordercolor="#cccccc" >
	<thead>
	   <tr style="font-size:14px">
		  <Th>Nro</Th>
		  <Th>Paciente</Th>
		  <Th>DNI</Th>
		  <Th>Sexo</Th>
		  <Th>Fecha Nac.</Th>
	   </tr>
	</thead>
	<tbody id="IdCuerpoPac" style="font-size:12px;">  </tbody>  
</table>

<br>
<div class="row">
	<div class="col-lg-4 col-md-12">
		<div class="form-group">
		<!-- Simple Icon Button -->
			<button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="AbrirModalPac()"><i class="ft-plus" ></i> Nuevo</button>
			<button type="button" class="btn  bg-vino mr-1 mb-1" onClick="LlenarDatosPac()" ><i class="ft-edit-1"></i> Editar</button>
		</div>
	</div>
	<div class="col-lg-5 col-md-12">
	  <input type="text" class="form-control" placeholder="Buscar Médico - Enter" id="TxtBuscarPac" >		
	</div>
</div>


<div id="IdModalPac" class="modal fade" role="dialog" >
 
   <div class="modal-dialog modal-xl" >
      <div class="modal-content">
      <div class="modal-header">
        
        &nbsp; INGRESE PACIENTE 
        
      </div>
    <div class="modal-body">
    <table  width="100%" style="font-size:12px; font-weight:bold;">
        <tr style='display:none'>
            <td><b>Id</b>
            <input name ="id_med" type="text" id="id_pac" size="5" readonly="readonly" class="form-control"/>
			<input name ="idper" type="text" id="idper_pac" size="5" readonly="readonly" class="form-control"/>
			</td>
			
        </tr>
        <tr>
            <td  width="15%"><b>DNI / CARNET EXT.</b><input  type="number" id="dni_pac"  class="form-control" value="" style="width:95%" 
											  autocomplete="off" ></td>
            <td width="20%" colspan="2"><b>Apellido Paterno</b>
            <input type="text" id="TxtApePatPac"  style="text-transform:uppercase;width:95%" class="form-control" value="" 
				   autocomplete="off" ></td>
			<td width="20%" ><b>Apellido Materno</b>
            <input type="text" id="TxtApeMatPac"  style="text-transform:uppercase;width:95%" class="form-control" value="" 
				   autocomplete="off"></td>
			<td width="20%"><b>Nombres</b>
            <input type="text" id="TxtNombresPac"  style="text-transform:uppercase;width:95%" class="form-control" value=""
				   autocomplete="off" ></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
           <td><b>Fec. Nacimiento</b><input type="date" id="TxtFecNacPac" style="text-transform:uppercase; width:95%" class="form-control" autocomplete="off" ></td>
           <td><b>Edad</b>
		 <input type="text" id="TxtEdad" style="text-transform:uppercase; width:95%" class="form-control" autocomplete="off" > 
		   </td>
			<td><b>Sexo</b><br />
           <label for="IdMasculinoPac"> <input type="radio" name="RadioSexoPac" id="IdMasculinoPac" checked="checked" value="M"  />
          <b>Masculino</b> </label>&nbsp;&nbsp;
          <label for="IdFemeninoPac"> <input type="radio" name="RadioSexoPac" id="IdFemeninoPac"  value="F"  />
          <b>Femenino </b></label>
             </td>
		 <td><b>Estado Civil</b><input type="text" id="TxtEstCivil" style="text-transform:uppercase; width:95%" class="form-control" autocomplete="off"></td>
	     <td><b>Estatura</b><input type="text" id="TxtEstatura" style="text-transform:uppercase; width:95%" class="form-control" autocomplete="off"></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
			<td><b>Departamento</b><input type="text" id="TxtDep" style="text-transform:uppercase; width:95%" class="form-control" autocomplete="off"></td>
            <td colspan="2"><b>Provincia</b><input type="text" id="TxtProv" style="text-transform:uppercase; width:95%" class="form-control" autocomplete="off"></td>
			<td><b>Distrito</b><input type="text" id="TxtDist" style="text-transform:uppercase; width:95%" class="form-control" autocomplete="off"></td>
		    <td><b>T&eacute;lefono </b>
            <input  type="number" id="TxtTelPac" style="width:95%" class="form-control" value=""
				   autocomplete="off" ></td>
        </tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
		  <td colspan="4"><b>Direcci&oacute;n</b><input type="text" id="TxtDirPac" style="text-transform:uppercase; width:98.5%" class="form-control" autocomplete="off"></td>
		<td ><b>Correo</b><input type="text" id="TxtCorreo" style=" width:95%" class="form-control" autocomplete="off"></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
		  <td colspan="4"><b>Familiar Responsable</b><input type="text" id="TxtResponsable" style="text-transform:uppercase; width:98.5%" class="form-control" autocomplete="off"></td>
		<td  ><b>Tel&eacute;fono Responsable</b><input type="text" id="TxtTelResp" style="text-transform:uppercase; width:98.5%" class="form-control" autocomplete="off"></td>
		</tr>
    </table>
 </div>
  <div class="modal-footer" >
    <button type="button" id="BtnGrabarSerie" class="btn bg-vino mr-1 mb-1" onClick="RegistrarPac()"> Grabar</button>
    <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"> Cancelar</button>									
								
      </div>
        </div>
     </div>
 </div>

 

<input type="hidden" id="IdFilaPac" value="0"  >
<input type="hidden" id="ValorPac" value="0"  >
<input type="hidden" id="dni_antpac" value="0"  >

<script>

 $(document).ready(function() {
  $("#IdModalPac").on('shown.bs.modal', function(){$("#dni_pac").focus()});
 
  $('#IdTblPac').fixheadertable({
		colratio : [10,50,15,15,15], 
		height : 500, 
		width :'100%', 
		zebra : true, 
		sortable : false, 
		sortedColId : 3, 
		pager : false,
		rowsPerPage	 : 10,
		resizeCol : false,
	 });
	 
	 $("#TxtBuscarPac").keypress(function(e) {  
	   if(e.which==13) {
          LisPac()
       }
     })
	 $("#dni_pac").keypress(function(e) {   
	   if(e.which==13) {
          ConsultaDniPac()
       }
     })
	 $('.chosen-select').chosen({allow_single_deselect:true});
 }); 
	
function PintarFilaPac($id){
	 var $idfilaanterior=$("#IdFilaPac").val() 
	 
	 var $par=$idfilaanterior.split('_')
	 var $par_int=parseInt($par[1])
	// alert($par_int)
   if($par_int%2==0){
	   
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
	   "background-color": "#D2E0f2",
	   "color": "#4c4e7e"
	 })
	$("#IdFilaPac").val($id)

	
  }
  function LisPac(){
	 $buscar=$("#TxtBuscarPac").val();
	$("#IdCuerpoPac").html("<tr><td colspan='6'> Cargando ..</td></tr>");
    $.post('controlador/Cconfiguracion.php',{accion:"LIS_PAC",buscar:$buscar},function(data){
		$("#IdCuerpoPac").html(data);$("#IdFilaPac").val(0)
     })  
    }
   function AbrirModalPac(){
	  $("#ValorPac").val(1);LimpiarPac();DeshabilitarPac();
	  $("#IdModalPac").modal()
	  //limpiar_campos_caja();
    }

   function RegistrarPac(){
	//validar_data();
	var $valor=$("#ValorPac").val();
	var $id = $("#id_Pac").val();
	var $idper = $("#idper_pac").val();
	 // alert($idper);exit;
	var $dni_ant = $("#dni_antpac").val()
	var $dni = $("#dni_pac").val()
	var $pat = $("#TxtApePatPac").val()
	var $mat = $("#TxtApeMatPac").val()
	var $nom = $("#TxtNombresPac").val()
	var $fec_nac = $("#TxtFecNacPac").val()
	var $sexo = $('input:radio[name=RadioSexoPac]:checked').val()
	var $dir = $("#TxtDirPac").val()
	/*var $cmp = $("#TxtCmp").val()
	var $comision = $("#TxtComision").val()*/
	var $tel = $("#TxtTelPac").val()
	var $correo = $("#TxtCorreo").val()
	var $responsable = $("#TxtResponsable").val()
	var $tel_resp = $("#TxtTelRes").val()
	//var $foto = $("#TxtFoto").val()
	 
    // if($comision==''){$comision=0.00}
	 if($dni == ''){swal("Ingrese Dni ..", "Campo Obligatorio", "warning");return false;}  
	 if($pat == ''){swal("Ingrese Apellido Paterno ..", "Campo Obligatorio", "warning");return false;}
	 if($mat == ''){swal("Ingrese Apellido Materno ..", "Campo Obligatorio", "warning");return false;}
	 if($nom == ''){swal("Ingrese Nombres ..", "Campo Obligatorio", "warning");return false;}
	 if($fec_nac == ''){swal("Ingrese Fecha Nacimiento ..", "Campo Obligatorio", "warning");return false;}
	 if($sexo == ''){swal("Seleccione Sexo ..", "Campo Obligatorio", "warning");return false;}
	  
	   $.post("controlador/Cconfiguracion.php",{accion:'NUEVO_PAC',id:$id,dni:$dni,pat:$pat,mat:$mat,nom:$nom,fec_nac:$fec_nac,s:$sexo,dir:$dir,dni_ant:$dni_ant,tel:$tel,valor:$valor,dni_ant:$dni_ant,idper:$idper,correo:$correo,resp:$responsable,tel_resp:$tel_resp},function(data){ 
		
		   if(data==2){swal("DNI ya existe ..", "Verificar", "error"); return false;}
		if(data==1){$("#IdFilaPac").val(0);LisPac();swal("Datos registrados Correctamente ..", "Felicitaciones", "success");
		CerrarModalPac(); return false;}
		if(data==0){swal("Datos no registrados Correctamente ..", "Error", "error"); return false;}
	})
	  
  } 
	
	function LlenarDatosPac(){
	 $("#ValorPac").val(2);HabilitarPac();
	 var $ident = $("#IdFilaPac").val()
     var $idpac=$("#"+$ident).attr("idpac")
	 var $idper=$("#"+$ident).attr("idperpac")
	 if($ident == 0){
		swal("Debe seleccionar un Registro", "Seleccione Registro", "warning");return false;
	 }
		 $.post("controlador/Cconfiguracion.php",{accion:'LLENAR_PAC',idpac:$idpac,idper:$idper},function(data){
		     $("#idper_pac").val(data[7]);$("#id_pac").val(data[0]);$("#dni_antpac,#dni_pac").val(data[4])
			 $("#TxtApePatPac").val(data[1]);$("#TxtApeMatPac").val(data[2]);$("#TxtNombresPac").val(data[3])
			 $("#TxtFecNacPac").val(data[8]);$("#TxtDirPac").val(data[6]);
			 $("#TxtTelPac").val(data[5]);
			 if(data[9]=='MASCULINO'){$("#IdMasculinoPac").prop("checked",true)}
		     if(data[9]=='FEMENINO'){$("#IdFemeninoPac").prop("checked",true)}
			 $("#TxtCorreo").val(data[10]);$("#TxtResponsable").val(data[11]);$("#TxtTelResp").val(data[12]);
			 $("#TxtDep").val(data[13]);$("#TxtProv").val(data[14]);$("#TxtDist").val(data[15]);
			 $("#TxtEstCivil").val(data[17]);$("#TxtEstatura").val(data[16]);$("#TxtEdad").val(data[18])
			
			 $("#IdModalPac").modal();
	     },'json')
  }
  
  function ConsultaDniPac(){
		$("#IdCarga").show();
        var $dni = $('#dni_pac').val();
		var url = 'controlador/Cwebservice.php';
	    //var $valor=$("#ValorMed").val()
		$.ajax({
		type:'POST',
	    //dataType: "json",
		url:url,
		data:{accion:'WEBSERVICE_DNI',dni:$dni},
		success: function(datos_dni){
			    // alert(datos_dni)
			    if(datos_dni=='ERROR'){swal("Error de Sistema  ..",'Comunicarse con Informática','error')}
				if(datos_dni =='NO'){$("#IdCarga").hide();swal("Dni no Existe en Reniec ..",'Error','error');return false;}
			    var datos = eval(datos_dni);
		     	$("#idper_pac").val(datos[16])
				$("#TxtApePatPac").val(datos[1]);$("#TxtApeMatPac").val(datos[2]);$("#TxtNombresPac").val(datos[3])
				$("#TxtFecNacPac").val(datos[4])
			    if(datos[6]=='MASCULINO'){$("#IdMasculinoPac").prop("checked",true)}
				if(datos[6]=='FEMENINO'){$("#IdFemeninoPac").prop("checked",true)}
			    $("#TxtEstCivil").val(datos[7]);$("#TxtEstatura").val(datos[5]);$("#TxtDep").val(datos[8]);
			    $("#TxtProv").val(datos[9]);$("#TxtDist").val(datos[10])
			    $("#TxtDirPac").val(datos[11]); $("#TxtEdad").val(datos[17])
				$("#TxtTelPac").focus()
				$("#IdCarga").hide();
		 }
	    });
	
   }
 
  function CerrarModalPac(){
	$("#IdModalPac").modal("hide")
   } 
  function LimpiarPac(){
	 $("#idper_pac,#id_pac").val(0);
$("#dni_pac,#TxtApePatPac,#TxtApeMatPac,#TxtNombresPac,#TxtFecNacPac,#TxtDirPac,#TxtCorreo,#TxtResponsable,#TxtTelResp").val("")
	  $("#TxtEstCivil,#TxtEstatura,#TxtDep,#TxtProv,#TxtDist,#TxtEdad").val("")
$("#IdMasculinoPac").prop("checked",true)
   }
   function HabilitarPac(){
	 $("#dni_pac,#TxtApePatPac,#TxtApeMatPac,#TxtNombresPac,#TxtFecNacPac,#TxtDirPac,#TxtEdad").prop("disabled",true)
	 $("#TxtEstCivil,#TxtEstatura,#TxtDep,#TxtProv,#TxtDist").prop("disabled",true)
	 $("#IdMasculinoPac,#IdFemeninoPac").prop("disabled",true)
   }
   function DeshabilitarPac(){
	 $("#dni_pac,#TxtApePatPac,#TxtApeMatPac,#TxtNombresPac,#TxtFecNacPac,#TxtDirPac,#TxtEdad").prop("disabled",false)
	 $("#TxtEstCivil,#TxtEstatura,#TxtDep,#TxtProv,#TxtDist").prop("disabled",false)
	 $("#IdMasculinoPac,#IdFemeninoPac").prop("disabled",false)
   }
   
   
 
	
   
	
  LisPac()	
</script>
