<table id="IdTblMed" border="1" bordercolor="#cccccc" >
	<thead>
	   <tr style="font-size:14px">
		 <Th>Nro</Th>
		 <Th>M&eacute;dico</Th>
		 <Th>DNI</Th>
		 <Th>CMP</Th>
		 <Th>T&eacute;lefono</Th>
		 <Th>Direcci&oacute;n</Th>
		 <Th>Esp.</Th>
	   </tr>
	</thead>
	<tbody id="IdCuerpoMed" style="font-size:12px;">  </tbody>  
</table>

<br>
<div class="row">
	<div class="col-lg-4 col-md-12">
		<div class="form-group">
		<!-- Simple Icon Button -->
			<button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="AbrirModalMed()"><i class="ft-plus" ></i> Nuevo</button>
			<button type="button" class="btn  bg-vino mr-1 mb-1" onClick="LlenarDatosMed()" ><i class="ft-edit-1"></i> Editar</button>
		</div>
	</div>
	<div class="col-lg-5 col-md-12">
	  <input type="text" class="form-control" placeholder="Buscar Médico - Enter" id="TxtBuscarMed" >		
	</div>
</div>


<div id="IdModalMed" class="modal fade" role="dialog" >
 
   <div class="modal-dialog modal-lg" >
      <div class="modal-content">
      <div class="modal-header">
        
        &nbsp; INGRESE MEDICO 
        
      </div>
    <div class="modal-body">
    <table  width="100%" style="font-size:12px; font-weight:bold;">
        <tr style='display:none'>
            <td><b>Id</b>
            <input name ="id_med" type="text" id="id_med" size="5" readonly="readonly" class="form-control"/>
			<input name ="idper" type="text" id="idper" size="5" readonly="readonly" class="form-control"/>
			</td>
			
        </tr>
         <tr>
           <td rowspan="10" width="20%" align="center">
				<span id="IdFotoMed"  >
				<img id="avatar" src='img/avatar.jpg' width='90%' height='80%'  />
			   </span>
            <!--<input type="text" id="TxtFoto" style="display:none;"/>-->
           </td>
        </tr>
        <tr>
            <td  width="15%"><b>DNI</b><input  type="number" id="dni_med"  class="form-control" value="" style="width:95%" 
											  autocomplete="off" ></td>
            <td width="20%"><b>Apellido Paterno</b>
            <input type="text" id="TxtApePatMed"  style="text-transform:uppercase;width:95%" class="form-control" value="" 
				   autocomplete="off" ></td>
			<td width="20%"><b>Apellido Materno</b>
            <input type="text" id="TxtApeMatMed"  style="text-transform:uppercase;width:95%" class="form-control" value="" 
				   autocomplete="off"></td>
			<td width="20%"><b>Nombres</b>
            <input type="text" id="TxtNombresMed"  style="text-transform:uppercase;width:95%" class="form-control" value=""
				   autocomplete="off" ></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
           <td><b>Fec. Nacimiento</b><input type="date" id="TxtFecNac" style="text-transform:uppercase; width:95%" class="form-control" autocomplete="off" ></td>
           <td><b>Sexo</b><br />
           <label for="IdMasculino"> <input type="radio" name="RadioSexo" id="IdMasculino" checked="checked" value="M"  />
          <b>Masculino</b> </label>&nbsp;&nbsp;
          <label for="IdFemenino"> <input type="radio" name="RadioSexo" id="IdFemenino"  value="F"  />
          <b>Femenino </b></label>
             </td>
		 <td colspan="2"><b>Direcci&oacute;n</b><input type="text" id="TxtDir" style="text-transform:uppercase; width:95%" class="form-control" autocomplete="off"></td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
			<td><b>CMP</b><input type="text" id="TxtCmp" style="text-transform:uppercase; width:95%" class="form-control"
								 autocomplete="off" ></td>
            <td><b>Porcentaje Comisi&oacute;n</b>
            <input  type="number" id="TxtComision" style="width:95%" class="form-control" value=""
				   autocomplete="off" ></td>
		    <td><b>T&eacute;lefono </b>
            <input  type="number" id="TxtTel" style="width:95%" class="form-control" value=""
				   autocomplete="off" ></td>
        </tr>
    </table>
 </div>
  <div class="modal-footer" >
    <button type="button" id="BtnGrabarSerie" class="btn bg-vino mr-1 mb-1" onClick="RegistrarMed()"> Grabar</button>
    <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"> Cancelar</button>									
								
      </div>
        </div>
     </div>
 </div>

 <div id="IdModalAsignarEsp" class="modal fade" role="dialog" >
 
   <div class="modal-dialog modal-lg" >
      <div class="modal-content">
      <div class="modal-header"  id="NomMed">
        
		  &nbsp;  
        
      </div>
    <div class="modal-body">
    <table width="100%" style="margin-bottom: 0px" >
        <tr>
            <td ><b>Especialidad</b> <br>
	<select id="CboEsp" class="chosen-select form-control"  > </select> 
            </td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		 <tr>
            <td ><b>RNE</b> <br>
	<input type="text" id="TxtRne" class="form-control" autocomplete="off" >
            </td>
		</tr>
		<tr><td  ><br>
				<button type="button" id="BtnAgregar" class="btn bg-vino mr-1 mb-1" onClick="AsignarMedEsp()"> Agregar</button></td></tr>
       <tr><td>&nbsp;</td></tr> 
    </table>
	<table class="table" style="margin-top: 0px">
		<thead>
		   <th width="10%">Nro</th>
		   <th width="70%">Especialidad</th>
		   <th width="10%">rne</th>
		   <th width="10%"></th>
		</thead>
		<tbody id="CuerpoMedEsp"></tbody>
	</table>
 </div>
  <div class="modal-footer" >
    <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"> Cancelar</button>									
								
      </div>
        </div>
     </div>
 </div>

<input type="hidden" id="IdFilaMed" value="0"  >
<input type="hidden" id="ValorMed" value="0"  >
<input type="hidden" id="dni_ant" value="0"  >

<script>

 $(document).ready(function() {
  $("#IdModalMed").on('shown.bs.modal', function(){$("#dni_med").focus()});
  $("#IdModalAsignarEsp").on('shown.bs.modal', function(){$(this).find('.chosen-container').css({width: "100%"});});
  $('#IdTblMed').fixheadertable({
		colratio : [10,50,15,15,15,50,10], 
		height : 500, 
		width :'100%', 
		zebra : true, 
		sortable : false, 
		sortedColId : 3, 
		pager : true,
		rowsPerPage	 : 2,
		resizeCol : false,
	 });
	 
	 $("#TxtBuscarMed").keypress(function(e) {  
	   if(e.which==13) {
          LisMed()
       }
     })
	 $("#dni_med").keypress(function(e) {   
	   if(e.which==13) {
          ConsultaDni()
       }
     })
	 $('.chosen-select').chosen({allow_single_deselect:true});
 }); 
	
function PintarFilaMed($id){
	 var $idfilaanterior=$("#IdFilaMed").val() 
	 
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
	   "background-color": "#D2E0f2",
	   "color": "#4c4e7e"
	 })
	$("#IdFilaMed").val($id)

	
  }
	
  function LisMed(){
	 $buscar=$("#TxtBuscarMed").val();
	$("#IdCuerpoMed").html("<tr><td colspan='6'> Cargando ..</td></tr>");
    $.post('controlador/Cconfiguracion.php',{accion:"LIS_MED",buscar:$buscar},function(data){
		$("#IdCuerpoMed").html(data);$("#IdFilaMed").val(0)
     })  
    }
   function AbrirModalMed(){
	  $("#ValorMed").val(1);LimpiarMed();DeshabilitarMed();
	  $("#IdModalMed").modal()
	  //limpiar_campos_caja();
    }
	function AbrirModalMedEsp($idmed,$nom_med){
		LlenadoEsp(); $("#NomMed").text("ASIGNAR ESPECIALIDAD: "+$nom_med);LisMedEsp($idmed)
		$("#IdModalAsignarEsp").modal(); }

   function RegistrarMed(){
	//validar_data();
	var $valor=$("#ValorMed").val();
	var $id = $("#id_med").val();
	var $idper = $("#idper").val();
	 // alert($idper);exit;
	var $dni_ant = $("#dni_ant").val()
	var $dni = $("#dni_med").val()
	var $pat = $("#TxtApePatMed").val()
	var $mat = $("#TxtApeMatMed").val()
	var $nom = $("#TxtNombresMed").val()
	var $fec_nac = $("#TxtFecNac").val()
	var $sexo = $('input:radio[name=RadioSexo]:checked').val()
	var $dir = $("#TxtDir").val()
	var $cmp = $("#TxtCmp").val()
	var $comision = $("#TxtComision").val()
	var $tel = $("#TxtTel").val()
	var $foto = $("#TxtFoto").val()
	 
     if($comision==''){$comision=0.00}
	 if($dni == ''){swal("Ingrese Dni ..", "Campo Obligatorio", "warning");return false;}  
	 if($pat == ''){swal("Ingrese Apellido Paterno ..", "Campo Obligatorio", "warning");return false;}
	 if($mat == ''){swal("Ingrese Apellido Materno ..", "Campo Obligatorio", "warning");return false;}
	 if($nom == ''){swal("Ingrese Nombres ..", "Campo Obligatorio", "warning");return false;}
	 if($fec_nac == ''){swal("Ingrese Fecha Nacimiento ..", "Campo Obligatorio", "warning");return false;}
	 if($sexo == ''){swal("Seleccione Sexo ..", "Campo Obligatorio", "warning");return false;}
	  
	   $.post("controlador/Cconfiguracion.php",{accion:'NUEVO_MEDICO',id:$id,dni:$dni,pat:$pat,mat:$mat,nom:$nom,fec_nac:$fec_nac,s:$sexo,dir:$dir,foto:$foto,dni_ant:$dni_ant,cmp:$cmp,comision:$comision,tel:$tel,f:$foto,valor:$valor,dni_ant:$dni_ant,idper:$idper},function(data){
		   
		if(data==2){swal("DNI ya existe ..", "Verificar", "error"); return false;}
		if(data==1){$("#IdFilaMed").val(0);swal("Datos registrados Correctamente ..", "Felicitaciones", "success");
		LisMed();CerrarModalMed(); return false;}
		if(data==0){swal("Datos no registrados Correctamente ..", "Error", "error"); return false;}
	})
	  
  } 
	
	function LlenarDatosMed(){
	 $("#ValorMed").val(2);HabilitarMed();
	 var $ident = $("#IdFilaMed").val()
     var $idmed=$("#"+$ident).attr("idmed")
	 var $idper=$("#"+$ident).attr("idper")
	 if($ident == 0){
		swal("Debe seleccionar un Registro", "Seleccione Registro", "warning");return false;
	 }
		 
		 $.post("controlador/Cconfiguracion.php",{accion:'LLENAR_MED',idmed:$idmed},function(data){
		     $("#idper").val(data[8]);$("#id_med").val(data[0]);$("#dni_ant,#dni_med").val(data[4])
			 $("#TxtApePatMed").val(data[1]);$("#TxtApeMatMed").val(data[2]);$("#TxtNombresMed").val(data[3])
			 $("#TxtFecNac").val(data[9]);$("#TxtDir").val(data[7]);$("#TxtCmp").val(data[5]);$("#TxtComision").val(data[11])
			 $("#TxtTel").val(data[6]);
			 if(data[10]=='MASCULINO'){$("#IdMasculino").prop("checked",true)}
		     if(data[10]=='FEMENINO'){$("#IdFemenino").prop("checked",true)}
			 $foto=data[12];
			 if(data[12]==''){$foto_decode="<img id='avatar' src='img/avatar.jpg' width='90%' height='80%'  />"}else{
				$foto_decode="<img id='avatar' width='90%' height='80%' src='data:image/gif;base64,"+$foto+"'  />" 
			 }
			 
			 $("#IdFotoMed").html($foto_decode)
			 $("#IdModalMed").modal();
	     },'json')
  }
  
  function ConsultaDni(){
	   // alert('hola')
		$("#IdCarga").show();
        var $dni = $('#dni_med').val();
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
		     	$("#idper").val(datos[16])
				$("#TxtApePatMed").val(datos[1]);$("#TxtApeMatMed").val(datos[2]);$("#TxtNombresMed").val(datos[3])
				$("#TxtFecNac").val(datos[4])
			    if(datos[6]=='MASCULINO'){$("#IdMasculino").prop("checked",true)}
				if(datos[6]=='FEMENINO'){$("#IdFemenino").prop("checked",true)}
			    $("#TxtDir").val(datos[11])
				$foto=datos[12];
				$foto_decode="<img id='avatar' width='90%' height='80%' src='data:image/gif;base64,"+$foto+"'  />"
				$("#IdFotoMed").html($foto_decode)
				//$('#TxtFoto').val($foto);
				$("#IdCarga").hide();$("#TxtCmp").focus();
		 }
	    });
	
   }
 
  function CerrarModalMed(){
	$("#IdModalMed").modal("hide")
   } 
  function LimpiarMed(){
	 $("#idper,#id_med").val(0);
	 $("#dni_med,#TxtApePatMed,#TxtApeMatMed,#TxtNombresMed,#TxtFecNac,#TxtDir,#TxtCmp,#TxtComision,#TxtTel").val("")
	  $("#IdFotoMed").html("<img id='avatar' src='img/avatar.jpg' width='90%' height='80%'  />")
	 $("#IdMasculino").prop("checked",true)
   }
   function HabilitarMed(){
	 $("#dni_med,#TxtApePatMed,#TxtApeMatMed,#TxtNombresMed,#TxtFecNac,#TxtDir").prop("disabled",true)
	 $("#IdMasculino,#IdFemenino").prop("disabled",true)
   }
   function DeshabilitarMed(){
	 $("#dni_med,#TxtApePatMed,#TxtApeMatMed,#TxtNombresMed,#TxtFecNac,#TxtDir").prop("disabled",false)
	 $("#IdMasculino,#IdFemenino").prop("disabled",false)
   }
   function LlenadoEsp(){
	$.post("controlador/Cconfiguracion.php",{accion:'LLE_ESP'},function(data){
		$("#CboEsp").html(data).trigger("chosen:updated");
	 })
    }
   function AsignarMedEsp(){
	//validar_data();
	var $fila=$("#IdFilaMed").val()
	var $idmed=$("#"+$fila).attr('idmed')
	var $rne = $("#TxtRne").val();
	var $idesp = $("#CboEsp").val();
	
	if ($idesp ==0){swal("Seleccione Especialidad ..", "Campo Obligatorio", "warning");return false;}
	if ($rne ==''){swal("Seleccione RNE ..", "Campo Obligatorio", "warning");return false;}
	
	 
	$.post("controlador/Cconfiguracion.php",{accion:'NUEVO_MED_ESP',idmed:$idmed,rne:$rne,idesp:$idesp},function(data){
		if(data==2){swal("Especialidad ya Ingresada ..", "Verificar", "warning"); return false;}
		if(data==1){LimpiarMedEsp();LisMedEsp($idmed);
					swal("Datos registrados Correctamente ..", "Felicitaciones", "success"); return false;}
		if(data==0){swal("Datos no registrados Verifique RNE ..", "Error", "error"); return false;}
     })	  
   }
   function LisMedEsp($idmed){
	$.post("controlador/Cconfiguracion.php",{accion:'LIS_MED_ESP',idmed:$idmed},function(data){
		$("#CuerpoMedEsp").html(data)
	 })
    }
 function EliminarMedEsp($id,$idmed){
	swal({
    title: "Confirmacion",
    text: "Está seguro de Eliminar Especialidad",
    icon: "warning",
    buttons: true,
    dangerMode: true}).then((willDelete) => {
     if (willDelete) {
		$.post("controlador/Cconfiguracion.php",{accion:'ELI_MED_ESP',id:$id},function(data){
		   if(data==1){LisMedEsp($idmed)
					swal("Dato Eliminado Correctamente ..", "Felicitaciones", "success"); return false;}
		   if(data==0){swal("Dato no Eliminado ..", "Error", "error"); return false;}
			
	    })
	    } 
    });
  }
	function LimpiarMedEsp(){
	  $("#TxtRne").val("");$("#CboEsp").val(0).trigger("chosen:updated");
	}
   
	
  LisMed()	
</script>
