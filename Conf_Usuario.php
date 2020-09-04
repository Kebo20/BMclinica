<table id="IdTblUsu" border="1" bordercolor="#cccccc" >
	<thead>
	   <tr style="font-size:14px">
		 <Th>Nro</Th>
		 <Th>Usuario</Th>
		 <Th>Login</Th>
		 <Th>Pass</Th>
		 <Th>Estado</Th>
		  
	   </tr>
	</thead>
	<tbody id="TbodyUsuario" style="font-size:12px;"> </tbody>  	
</table>

<br>
<div class="row">
	<div class="col-lg-4 col-md-12">
		<div class="form-group">
		<!-- Simple Icon Button -->
			<button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="AbrirModalUsu()"><i class="ft-plus"></i> Nuevo</button>
			<button type="button" class="btn  bg-vino mr-1 mb-1" onClick="LlenarDatosUsu()"><i class="ft-edit-1"></i> Editar</button>
			<button type="button" class="btn  bg-vino mr-1 mb-1"><i class="ft-trash-2"></i> Eliminar</button>
		</div>
	</div>
	<div class="col-lg-5 col-md-12">
	  <input type="text" class="form-control" placeholder="Buscar Usuario - Enter" id="TxtBuscarUsu" >
	
	</div>
</div>


<div id="IdModalUsu" class="modal fade" role="dialog" >
 
   <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        &nbsp; INGRESE USUARIO </h4>
        
      </div>
    <div class="modal-body">
    <table  width="100%" style="font-size:13px; font-weight:bold;">
        <tr style='display:none'>
            <td>Id</td>
            <td><input name ="id_usu" type="text" id="id_usu" size="5" readonly="readonly" class="form-control"/></td>
        </tr>
        
        <tr>
            <td><b>Apellidos y Nombres</b>
            <input name ="usuario" type="text" id="usuario" style="text-transform:uppercase" class="form-control" value="" autocomplete="off"></td>
        </tr>
        
        <tr>
            <td><b>Login</b>
				<input name ="login" type="text" id="login" style="text-transform:uppercase" class="form-control" value="" autocomplete="off"></td>
        </tr>
        
        <tr>
            <td><b>Contrase&ntilde;a</b>
				<input name ="pass" type="password" id="pass" style="text-transform:uppercase" class="form-control" value="" autocomplete="off"></td>
        </tr>
        
        <tr>
            <td><b>Estado</b>
            <select id="id_cmb_est" class="form-control" style="height:35px">
                <option value="0" selected="selected"> Activo </option>
                <option value="1"> Inactivo </option>
            </select>
            </td>
        </tr>
        
        <tr>
            <td><b>Grupo Usuario</b>
            <select id="Tipo" class="form-control" style="height:35px" > </select>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
    </table>
 </div>
  <div class="modal-footer">
       <button type="button" id="BtnGrabarUsu" class="btn bg-vino mr-1 mb-1" onClick="RegistrarUsuario()" > Grabar</button>
	   <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"  > Cancelar</button>									
  </div>
        </div>
     </div>
 </div>


<input type="hidden" id="IdFilaUsuario" value="0"  >
<input type="hidden" id="ValorUsu" value="0"  >

<script >
$(document).ready(function() {
   $("#IdModalUsu").on('shown.bs.modal', function(){
        $(this).find('#usuario').focus();
    });
   $('#IdTblUsu').fixheadertable({
		//caption	: 'Lista de Areas', 
		colratio : [15,150,100,50,20], 
		height : 500, 
		width :'100%', 
		zebra : true, 
		sortable : false, 
		sortedColId : 3, 
		pager : false,
		rowsPerPage	 : 10,
		resizeCol : false,
	});
 });
	
 function AbrirModalUsu(){ limpiar_campos(); LlenadoGrupoUsuario(0); $("#ValorUsu").val(1); $("#IdModalUsu").modal()   }
	
 function LisUsuario(){	
	var $buscar=$("#TxtBuscarUsu").val()
     $.post('controlador/Cconfiguracion.php',{accion:"LIS_USUARIO",buscar:$buscar},function(data){
		$("#TbodyUsuario").html(data);$("#IdFilaUsuario").val(0);
     })  
 }

function PintarFilaUsuario($id){
	 var $idfilaanterior=$("#IdFilaUsuario").val() 
	 
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
	$("#IdFilaUsuario").val($id)	
	
  }  

function LlenadoGrupoUsuario($id){
	$.post("controlador/Cconfiguracion.php",{accion:'LLENAR_GRUPO',id:$id},function(data){
		$("#Tipo").html(data);
	})
 }
	
function RegistrarUsuario(){
	//validar_data();
	var $valor=$("#ValorUsu").val();
	var $id = $("#id_usu").val();
	var $usuario = $("#usuario").val().toUpperCase();
	var $login = $("#login").val();
	var $pass = $("#pass").val();
    var $estado=$("#id_cmb_est").val();
	var $tipo=$("#Tipo").val();
	
	if ($usuario == ''){swal("Ingrese Usuario ..", "Campo Obligatorio", "warning");$("#usuario").focus();return false;}
	if ($login == ''){swal("Ingrese Login ..", "Campo Obligatorio", "warning");$("#login").focus();return false;}
	if ($pass == ''){swal("Ingrese Password ..", "Campo Obligatorio", "warning");$("#pass").focus();return false;}
	if($tipo==0){swal("Seleccione Grupo de Usuario ..", "Campo Obligatorio", "warning");return false;}
	$("#BtnGrabarUsu").prop("disabled",true);
	$.post("controlador/Cconfiguracion.php",{accion:'NUEVO_USUARIO',id:$id,usuario:$usuario,login:$login,pass:$pass,estado:$estado,valor:$valor,tipo:$tipo},function(data){
		alert(data)
		$("#BtnGrabarUsu").prop("disabled",false);
		if(data==2){swal("Usuario ya existe ..", "Error", "error"); return false;}
		if(data==1){ $("#IdFilaUsuario").val(0);swal("Datos registrados Correctamente ..", "Felicitaciones","success");
			LisUsuario();CerrarModalUsu(); return false;}
		if(data==0){swal("Datos no registrados Correctamente ..", "Error", "error"); return false;}
		
	})
	  
} 
	
function LlenarDatosUsu(){
	 $("#ValorUsu").val(2)
	 var $ident = $("#IdFilaUsuario").val()
     var $id=$("#"+$ident).attr("idusu")
      
	if($ident ==0){
		swal("Debe seleccionar un Registro", "Obligatorio", "warning");
		return false;
	}
	   $.post("controlador/Cconfiguracion.php",{accion:'LLENAR_USUARIO',id:$id},function(data){
		   $("#id_usu").val(data.id);$("#usuario").val(data.nombre);$("#login").val(data.usuario);$("#pass").val(data.pass);
		   $("#id_cmb_est").val(data.estado);LlenadoGrupoUsuario(data.id_grupo_usuario)
		   $("#IdModalUsu").modal()
	    },'JSON')
		
		
	 
  }
	
function limpiar_campos(){
	$("#id_usu,#usuario,#login,#pass").val("");
	$("#id_cmb_est").val(0);//$("#Tipo").val();
}
	
function CerrarModalUsu(){ $("#IdModalUsu").modal("hide"); }
	 		
LisUsuario()
