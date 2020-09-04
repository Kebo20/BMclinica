<?php require_once('cado/ClaseAdmision.php');
$oadmision=new Admision();
date_default_timezone_set('America/Lima');

?>
<div class="row" style="font-size: 13.5px">
	<div class="col-2 pl-2 " ><b>Dni/Carnet Ext.</b><br>
	  <input type="text" id="AmTxtDni" class="form-control" autocomplete="off" >
	</div>
	<div class="col-6 pl-2" ><b>Paciente</b><br>
	  <fieldset>
             <div class="input-group">
                <input type="text" class="form-control" id="AmTxtPaciente"  readonly autocomplete="off" >
                    <div class="input-group-append" style="cursor: pointer" onClick="AbrirBuscarPersona()">
                       <span class="input-group-text" id="basic-addon4"><i class="la la-search"></i></span>
                    </div>
				    <div class="input-group-append" style="cursor: pointer" onClick="AbrirNuevoPersona()" >
                       <span class="input-group-text" id="basic-addon4"><i class="la la-user-plus"></i></span>
                    </div>
             </div>
       </fieldset>
	</div>
	<div class="col-4 pl-2" >
	  <b>Tipo Servicio</b><br>
	  <select class="chosen-select form-control" id="TipoServ" style="width: 90%" onChange="Clasificacion();LlenarServicio()">
		  <option value="0"></option>
		  <?php $lis_serv=$oadmision->TipoServicio();
		  while($fila=$lis_serv->fetch()){ ?>
		     <option value="<?=$fila[0]?>" cod_tipo="<?=$fila[2]?>" ><?=$fila[1]?></option>
		  <?php }?>
	  </select>
	</div>
	
</div>
<div class="row" style="height: 12px"></div>
<div class="row" style="font-size: 13.5px">
	<div class="col-2 pl-2" >
	   <b>Fecha</b><br>
	  <input type="date" id="AmTxtFecha" value="<?=date('Y-m-d')?>" class="form-control" autocomplete="off" readonly >
	</div>
	<div class="col-2 pl-2 " id="IdDivTur" ><b>Turno</b><br>
		<select  id="CboTurno"  class="chosen-select form-control" onchange="TurnoSig()" >
          <option value="0"></option>
		  <option value="M">MA&Ntilde;ANA</option>
	      <option value="T">TARDE</option>
		</select>
	</div>
	<div class="col-4 pl-2" id="IdDivEsp" >
	  <b>Especialidad</b><br>
	  <select class="chosen-select form-control" id="AmCboIdEsp" onChange="MedicoXEsp()" >
		   <option value="0"></option>
		  <?php $lis_esp=$oadmision->Especialidades();
		  while($fila=$lis_esp->fetch()){ ?>
		     <option value="<?=$fila[0]?>"><?=$fila[1]?></option>
		  <?php }?>
	  </select>
	</div>
	<div class="col-4 pl-2" >
	  <b>M&eacute;dico</b><br>
	  <select class="chosen-select form-control" id="AmCboIdMed" style="width: 90%" onchange="Siguiente()">
		 <option value="0"></option>
	  </select>
	</div>

</div>

<div class="row" style="height: 12px"></div>

<div class="row" style="font-size: 13.5px">
   <div class="col-8 pl-2" >
	  <b>Servicio</b><br>
	  <select class="chosen-select form-control" id="AmCboServicio" onchange="SigCant()" >
		 <option value="0"></option>
	  </select>
	</div>
    <div class="col-2 pl-2" >
	  <b>Cantidad</b><br>
	  <input type="number" id="AmCan" value="1" class="form-control" />
	</div> 
    <div class="col-2 pl-2" style="padding-top:10px" >
	  <button type="button" class="btn btn-icon bg-vino mr-1 mb-1" onclick="AgregarCarrito()">
        <i class="la la-plus">
        </i>
      </button>
	</div>
</div>

<div class="row" style="height: 20px"></div>

<div class="row" style="font-size: 13.5px">
  
  <div class="col-8 pl-2" >
	<table id="TblDetalleServicio" border="1" bordercolor="#cccccc" >
		<thead style="font-size:14px !important">
		   <th >Servicio</th>
		   <th >Cant.</th>
           <th >Precio</th>
           <th >Pago Pac.</th>
           <th >Pago Conv.</th>
           <th >Total</th>
           <th ></th>
		</thead>
		<tbody id="CuerpoDetSer"></tbody>
	</table> 
  </div>
  
  <div class="col-4 pl-2" >
  
    <table class="table" style="width:90% !important; background-color:#EAEAEA;"  >
      <thead>
         <th width="90%">CONVENIO</th>
      </thead>
    </table>
    <table width="90%" >
      <tr >
         <td width="50%">
   <input type="text"  class="form-control" readonly="readonly" value="  0%" style="width:90%; height:50px; font-size:18px" />
   </td>
         <td width="50%">
   <input type="text"  class="form-control" readonly="readonly" value=" S/ 0.00" style="width:100%; height:50px; font-size:18px" /></td>
      </tr>
    </table>
    <br />
    <table class="table" style="width:90% !important; background-color:#EAEAEA;"  >
      <thead>
         <th width="90%">PACIENTE</th>
      </thead>
    </table>
    <table width="90%" >
      <tr >
         <td width="50%">
   <input type="text"  class="form-control" readonly="readonly" value="  100%" style="width:90%; height:50px; font-size:18px" />
   </td>
         <td width="50%">
 <input type="text" class="form-control" readonly="readonly" value=" S/ 0.00" style="width:100%; height:50px; font-size:18px" id="TxtMonPac" />
   </td>
      </tr>
    </table>
  </div>

  
</div> 
<br />
<div class="row">
	<div class="col-lg-8 col-md-12">
		<div class="form-group">
		<!-- Simple Icon Button -->
            &nbsp;&nbsp;
			<button id="BtnGrabarAm" type="button" class="btn bg-vino mr-1 mb-1" onClick="GrabarAm()"><i class="ft-save"  ></i> Grabar</button>
			<button id="BtnGenDocAm" type="button" class="btn bg-vino mr-1 mb-1" onClick="AbrirModalDoc()">
            <i class="ft-file-text"></i> Generar Documento</button>
		</div>
	</div>
</div>

<div id="IdModalBusPer" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">  
        &nbsp; Buscar Paciente </h4>
      </div>
    <div class="modal-body">

    <table width="100%" style="margin-bottom: 0px" >
        <tr>
            <td><input type="text" id="AmTxtBus" class="form-control" autocomplete="off"></td>

		</tr>

       <tr><td>&nbsp;</td></tr> 
    </table>
	<table id="TblBusqueda" border="1" bordercolor="#cccccc" >
		<thead>
		   <th >Dni/Carnet Extranjer&iacute;a</th>
		   <th >Paciente</th>
		</thead>
		<tbody id="CuerpoBusPac"></tbody>
	</table>
    </div>
    
    <div class="modal-footer">
<button type="button" class="btn bg-vino mr-1 mb-1" onClick="TeclearBoton();CerrarModales()" > Aceptar</button>       
<button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"> Cancelar</button>											
								
      </div>
    
   </div>

 </div>
</div>


<div id="IdModalPacAm" class="modal fade" role="dialog" >
 
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
    <button type="button" id="BtnGrabarSerie" class="btn bg-vino mr-1 mb-1" onClick="RegistrarPacBus()"> Grabar</button>
    <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"> Cancelar</button>									
								
      </div>
        </div>
     </div>
</div>



<div id="AmModalDoc" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="modal-header" style="padding-left: 15px !important">  
        <b> GENERAR DOCUMENTO </b>
      </div>
    <div class="modal-body">   
   <table width="100%" style="font-size:13px" >
     <tbody>
        <tr>
           <td width="25%"><b>DNI</b>
              <input type="text" id="TxtDniPago" class="form-control"  style="width:95%" />
           </td>
           <td colspan="2"> <b>Cliente</b>
              <input type="text" id="TxtNomPago" class="form-control"  style="width:98%" />
           </td>
           
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
          <td width="25%"><b>Condicion de Pago</b><br />
            <label for="IdContado" ><input type="radio" name="CondicionPago" id="IdContado"  value="CONTADO" checked="checked" 
            onclick="CondicionPago()" /> Contado  &nbsp;&nbsp;</label>
            <label for="IdCredito" ><input type="radio" name="CondicionPago" id="IdCredito"  value="CREDITO" 
            onclick="CondicionPago()" /> Cr&eacute;dito  &nbsp;&nbsp;</label>
           </td>
          <td  id="TdIdTipoPago"><b>Tipo Pago</b><br />
      <label for="IdEfectivo" ><input type="radio" name="TipoPago" id="IdEfectivo"  value="E" checked="checked" onclick="OpcionPago()" /> Efectivo  &nbsp;&nbsp;</label>
            <label for="IdTarjeta" ><input type="radio" name="TipoPago" id="IdTarjeta"  value="T" onclick="OpcionPago()" /> Tarjeta  &nbsp;&nbsp;</label>
            <label for="IdMixto" ><input type="radio" name="TipoPago" id="IdMixto"  value="M" onclick="OpcionPago()" /> Mixto</label>
           </td>
            <td width="25%" id="TrDoc"><b>Tipo Documento</b>

                     <select class="form-control" id="CboTipoDoc" style="width:90%" onchange="OcultarRuc()" >
                           <option value="01"  >BOLETA</option>
                           <option value="03">FACTURA</option>
                           <option value="00">TICKET</option>
                           
                     </select>
           </td>
           <tr><td>&nbsp;</td></tr>
         <tr id="TrFact">
           <td width="25%"><b>Ruc</b>
           <input type="text" id="TxtRucAm" class="form-control" onkeypress="return validaNum(event)" style="width:95%" /></td>
           <td><b>Raz&oacute;n Social</b>
           <input type="text" id="TxtRazon" class="form-control" style="width:95%" onkeyup="javascript:LisLab()" /></td>
           <td><b>Direcci&oacute;n</b><input type="text" id="TxtDirRazon" class="form-control" style="width:95%"  /></td>
         </tr> 
            <tr><td>&nbsp;</td></tr>
        <tr> 
             <td  ><b>TOTAL</b>
             <input type="text" id="TxtTotal" class="form-control" style="width:95%; color:#000; font-weight:bold; size:16px;" readonly="readonly" /> </td>
            
           </tr>
           <tr><td>&nbsp;</td></tr>
           <tr id="OpcionEfectivo"> 
             <td width="25%" ><b>Monto Pagado</b>
             <input type="number" id="TxtMontoPagado" min="0" class="form-control" style="width:95%; color:#000; font-weight:bold; size:20px;" onkeyup="Vuelto()" /> </td>
             <td width="30%"><b>Vuelto</b>
             <input type="text" id="TxtVuelto" class="form-control" style="width:95%; color:#000; font-weight:bold; size:16px;"
              readonly="readonly" /> </td>
             <td width="30%">&nbsp;</td>
           </tr>
           <tr id="OpcionMixto" style="display:none"> 
             <td width="25%" ><b>Monto Efectivo</b>
            <input type="number" id="TxtEfectivo" class="form-control" style="width:95%; color:#000; font-weight:bold; size:16px;" 
            onkeyup="MontoMixto()" /> </td>
             <td ><b>Monto Tarjeta</b><input type="text" id="TxtTarjeta" class="form-control" style="width:95%" readonly="readonly" /></td>
             <!--<td width="30%" style="display:none"><b>Nro Voucher</b><input type="text" id="TxtMixtoVoucher" class="form-control" style="width:95%; color:#000; font-weight:bold; size:16px;" /> </td>-->
           </tr>
           <tr id="OpcionTarjeta" style="display:none"> 
             <td  width="25%"><b>Visa (Nro Voucher) </b>
             <input type="text" id="TxtVouVisa" class="form-control" style="width:95%; color:#000; font-weight:bold; size:16px;" /> </td>
             <td  ><b>Mastercard (Nro Voucher) </b>
             <input type="text" id="TxtVouMas" class="form-control" style="width:95%; color:#000; font-weight:bold; size:16px;" /> </td>
             <td  ><b>Otros (Nro Voucher) </b>
             <input type="text" id="TxtVouOtros" class="form-control" style="width:95%; color:#000; font-weight:bold; size:16px;" /> </td> 
           </tr>
           <tr id="OpcionTarjetaPago" style="display:none"> 
             <td  width="25%"><b>Visa (Monto) </b>
             <input type="text" id="TxtVouVisaPago" class="form-control" style="width:95%; color:#000; font-weight:bold; size:16px;" /> </td>
             <td  ><b>Mastercard (Monto) </b>
             <input type="text" id="TxtVouMasPago" class="form-control" style="width:95%; color:#000; font-weight:bold; size:16px;" /> </td>
             <td  ><b>Otros (Monto) </b>
           <input type="text" id="TxtVouOtrosPago" class="form-control" style="width:95%; color:#000; font-weight:bold; size:16px;" /> </td> 
           </tr>
        </tr>
      </tbody>
   </table>
    
    </div>
    
    <div class="modal-footer">
<button type="button" class="btn bg-vino mr-1 mb-1" onClick="Teclear();" > Aceptar</button>       
<button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"> Cancelar</button>											
								
      </div>
    
   </div>

 </div>
</div>



<input type="hidden" id="IdHiPer" value="0" >
<input type="hidden" id="IdHiPerPago" value="0" >
<input type="hidden" id="IdHiTotalBus" value="0" >
<input type="hidden" id="IdFilaBusPer" value="0"  >
<input type="hidden" id="ValorEnter" value="0"  >
<script type="text/javascript">
	
  $(document).ready(function() {
	  $("#AmTxtDni").focus()
	$("#IdModalBusPer").on('shown.bs.modal', function(){   $(this).find('#AmTxtBus').focus(); });
	$("#IdModalPacAm").on('shown.bs.modal', function(){   $(this).find('#dni_pac').focus(); });
	$("#AmModalDoc").on('shown.bs.modal', function(){   $(this).find('#TxtMontoPagado').focus(); });
	
	
	 // $(this).find('.chosen-container').css({width: "100%"}); 
	$('#TblBusqueda').fixheadertable({
		//caption	: 'Lista de Areas', 
		colratio : [30,70], 
		height : 280, 
		width :'100%', 
		zebra : true, 
		sortable : false, 
		sortedColId : 3, 
		pager : false,
		rowsPerPage	 : 10,
		resizeCol : false,
	});
	$('#TblDetalleServicio').fixheadertable({
		//caption	: 'Lista de Areas', 
		colratio : [45,10,15,15,15,15,5], 
		height : 200, 
		width :'100%', 
		zebra : true, 
		sortable : false, 
		sortedColId : 3, 
		pager : false,
		rowsPerPage	 : 10,
		resizeCol : false,
	});
	$('#IdFooter').fixheadertable({
		//caption	: 'Lista de Areas', 
		colratio : [60,15,15,15], 
		height : 0, 
		width :'100%', 
		zebra : true, 
		sortable : false, 
		sortedColId : 3, 
		pager : false,
		rowsPerPage	 : 10,
		resizeCol : false,
	});
	  $('.chosen-select').chosen({allow_single_deselect:true});
     
	$("#AmTxtDni").keypress(function(e) {  
	   if(e.which==13) {
          BuscarPersona();
       }
     })
	$("#TxtDniPago").keypress(function(e) {  
	   if(e.which==13) {
          BuscarPersonaPago();
       }
     })
	
	$("#AmTxtBus").keypress(function(e) {  
	   if(e.which==13) {
          BuscarPersonaNom();
       }
     })
	
     $("#dni_pac").keypress(function(e) {   
	   if(e.which==13) {
          ConsultaDniPacBus()
       }
     })
	 $("#CboTurno").keypress(function(e) {   
	   if(e.which==13) {
          Siguiente()
       }
     })
	 $("#TxtRucAm").keypress(function(e) {  
	   if(e.which==13) {
          ConsultaRucAm();
       }
     })
	 $("#AmCan").keypress(function(e) {  
	   if(e.which==13) {
          AgregarCarrito();
       }
     })
	  
  });
  
      $(document).keydown(function(tecla){ 
            if (tecla.keyCode == 27) { 
                CerrarModales()
            }
		    if (tecla.keyCode == 115) { 
                AbrirNuevoPersona()
            }
		    if (tecla.keyCode == 113) { 
                AbrirBuscarPersona()
            }
		    if (tecla.keyCode == 40) {
                $dato=$("#IdFilaBusPer").val().split("_")
				$ant=$dato[1]
				$total=$("#IdHiTotalBus").val()
				$actual=parseInt($ant)+1
				//alert($actual)
				if($actual<=$total){
				  $id='TblBusPac_'+$actual
				  PintarFilaBusPer($id)
				   exit;
				}
            }
		    if (tecla.keyCode == 38) {
                $dato=$("#IdFilaBusPer").val().split("_")
				$ant=$dato[1]
				$total=$("#IdHiTotalBus").val()
				$actual=parseInt($ant)-1
				//alert($actual)
				if($actual>0){
				  $id='TblBusPac_'+$actual
				  PintarFilaBusPer($id)
				  exit;
				}
            }
		    if (tecla.keyCode == 13) {
                Teclear();exit;
            }
			
			if (tecla.ctrlKey && tecla.keyCode == 81){
              GrabarAm();$("#BtnGrabarAm").focus();     
            }
 
        });
  
  	function Teclear(){
		      $fila=$("#IdFilaBusPer").val()
		      $btn=$fila.split('_')
			  $idbtn=$btn[1];
			 // alert($fila)
	          $("#BtnBusPac_"+$idbtn).keypress(function(e) {
                 if(e.which == 13) {
					$dni=$("#"+$fila).attr('dni');$pac=$("#"+$fila).attr('pac')
					
					$("#AmTxtDni").val($dni);$("#AmTxtPaciente").val($pac);CerrarModales();
					 setTimeout(function(){ $("#TipoServ").trigger('chosen:open');}, 200); 
					exit;
                  }
               });
	  }
	  function TeclearBoton(){
		      $fila=$("#IdFilaBusPer").val()
		      $btn=$fila.split('_')
			  $idbtn=$btn[1];
			  $dni=$("#"+$fila).attr('dni');$pac=$("#"+$fila).attr('pac')
			  $("#AmTxtDni").val($dni);$("#AmTxtPaciente").val($pac);CerrarModales();
		      setTimeout(function(){ $("#TipoServ").trigger('chosen:open');}, 200); 		
	   }
	
  function PintarFilaBusPer($id){
	 var $idfilaanterior=$("#IdFilaBusPer").val() 
	 var $btn=$id.split('_')
	 var $idbtn=$btn[1]
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
	 
	$("#IdFilaBusPer").val($id)
    $("#BtnBusPac_"+$idbtn).focus()
	
  }
	
  function MedicoXEsp(){
	  $id=$("#AmCboIdEsp").val()
	$.post('controlador/Cadmision.php',{accion:"MED_ESP",id:$id},function(data){
		//$("#AmCboIdMed").html(data).trigger("chosen:updated");$("#AmCboIdMed").trigger('chosen:activate');
		setTimeout(function(){$("#AmCboIdMed").html(data).trigger("chosen:updated"); $("#AmCboIdMed").trigger('chosen:open');}, 200);
     })
  }
 function Medicos(){
     $.post('controlador/Cadmision.php',{accion:"MED"},function(data){
	     setTimeout(function(){$("#AmCboIdMed").html(data).trigger("chosen:updated"); $("#AmCboIdMed").trigger('chosen:open');}, 200);	
     })
  }
  function BuscarPersona(){
	  $dni=$("#AmTxtDni").val()
	$.post('controlador/Cadmision.php',{accion:"BUS_PER",dni:$dni},function(data){
		$data=data.split('**')
		$("#AmTxtPaciente").val($data[1]);$("#IdHiPer").val($data[0])
		if($data[0]==''){
			//swal("Paciente no Existe", "Agregar Paciente", "warning");return false;
			swal({
              title: 'Paciente no Existe',
              text: 'Agregar Paciente (F4)',
              type: 'warning',
			  icon: "warning",
              showConfirmButton: false
              }).then(function() {
              $('#AmTxtDni').focus();
          });
		}else{
		   setTimeout(function(){ $("#TipoServ").trigger('chosen:open');}, 200);
		}
     })
	}
	
  function BuscarPersonaPago(){
	  $dni=$("#TxtDniPago").val()
	$.post('controlador/Cadmision.php',{accion:"BUS_PER",dni:$dni},function(data){
		$data=data.split('**')
		$("#TxtNomPago").val($data[1]);$("#IdHiPerPago").val($data[0])
		if($data[0]==''){
			//swal("Paciente no Existe", "Agregar Paciente", "warning");return false;
			swal({
              title: 'Persona a Facturar no Existe',
              text: 'Error',
              type: 'warning',
			  icon: "warning",
              showConfirmButton: false
              }).then(function() {
              $('#TxtDniPago').focus();
          });
		  return false;
		}
     })
	}
  function BuscarPersonaNom(){
	  $nom=$("#AmTxtBus").val()
	$.post('controlador/Cadmision.php',{accion:"BUS_NOM",nom:$nom},function(data){
		$data=data.split('**')
		$("#AmTxtBus").blur();
		$("#CuerpoBusPac").html($data[0]);PintarFilaBusPer('TblBusPac_1');$("#IdHiTotalBus").val($data[1])
		$("#ValorEnter").val(1)
     })
	}
  function AbrirBuscarPersona(){$("#IdHiTotalBus,#IdFilaBusPer").val(0);$("#CuerpoBusPac").html('');
							   $("#IdModalBusPer").modal()}
  function AbrirNuevoPersona(){ $("#IdModalPacAm").modal()}
  function CerrarModales(){ $("#IdModalBusPer,#IdModalPacAm").modal('hide') }
   
  function ConsultaDniPacBus(){
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
  
  function RegistrarPacBus(){
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
		if(data==1){swal("Datos registrados Correctamente ..", "Felicitaciones", "success");CerrarModales(); return false;}
		if(data==0){swal("Datos no registrados Correctamente ..", "Error", "error"); return false;}
	})
	  
  }
	
   function Clasificacion(){
	 $codtipo=$("#TipoServ option:selected").attr("cod_tipo")
	 if($codtipo=='C' || $codtipo=='E'){$("#IdDivTur,#IdDivEsp").show();$("#AmCboIdMed").html('').trigger("chosen:updated");
	 setTimeout(function(){ $("#CboTurno").trigger('chosen:open');}, 200);
	 }else{$("#IdDivTur,#IdDivEsp").hide();Medicos()} 	 
   }
   
   function TurnoSig(){
	 setTimeout(function(){ $("#AmCboIdEsp").trigger('chosen:open');}, 200); 
   }
   
   function Siguiente(){
	  setTimeout(function(){ $("#AmCboServicio").trigger('chosen:open');}, 200);
   }
   
   function SigCant(){setTimeout(function(){ $("#AmCan").focus();}, 200); }

   function AbrirModalDoc(){
	 $("#TrFact").hide();$("#CboTipoDoc").val('01')
     $("#AmModalDoc").modal()
   }
   
   function OpcionPago(){
	   
	   $tipo_pago=$('input:radio[name=TipoPago]:checked').val() 
	   if ($tipo_pago=='E'){$("#TxtVouVisa,#TxtVouMas,#TxtVouOtros,#TxtEfectivo,#TxtTarjeta").val('');
	       $("#OpcionEfectivo").show();$("#OpcionTarjeta,#OpcionTarjetaPago,#OpcionMixto").hide();$("#TxtMontoPagado").focus()}
       if ($tipo_pago=='T'){$("#TxtMontoPagado,#TxtVuelto,#TxtEfectivo,#TxtTarjeta").val('');
        $("#OpcionTarjeta,#OpcionTarjetaPago").show();$("#OpcionEfectivo,#OpcionMixto").hide();$("#TxtVouVisa").focus()}
	   if ($tipo_pago=='M'){$("#TxtMontoPagado,#TxtVuelto,#TxtVouVisa,#TxtVouMas,#TxtVouOtros").val('');
	   $("#OpcionMixto").show();$("#OpcionEfectivo").hide();$("#OpcionTarjeta,#OpcionTarjetaPago").show();$("#TxtEfectivo").focus()}      
   }
   function CondicionPago(){
	    LimpiarAm();$("#TxtMontoIngreso").val('');
		var $empresa=$('input:radio[name=TipoEmpresa]:checked').val()
	    
	    $condicion=$('input:radio[name=CondicionPago]:checked').val()
		if($condicion=='CONTADO'){$("#IdEfectivo").prop("checked",true);$("#TdIdTipoPago").show();$("#TrDoc").show();
		$("#TrIngreso").hide();OpcionPago();}
		else{$("#TdIdTipoPago").hide();
		$("#OpcionEfectivo,#OpcionTarjeta,#OpcionTarjetaPago,#OpcionMixto").hide();$("#TrDoc").hide();$("#TrIngreso").show();
		  $("#TxtMontoIngreso").prop("disabled",true);$("#ChekIngreso").prop("checked",false);
		}
		//TrIngreso,ChekIngreso,TxtMontoIngreso
   }
   function LimpiarAm(){
	 $("#TrFact").hide();
     $("#TxtRuc,#TxtRazon,#TxtDirRazon,#TxtMontoPagado,#TxtVuelto,#TxtEfectivo,#TxtTarjeta,#TxtVouVisa,#TxtVouMas,#TxtVouOtros").val('')
    }
   
   function OcultarRuc(){
	 $tipo_doc=$("#CboTipoDoc").val();$('#TxtRucAm,#TxtRazon,#TxtDirRazon').val('');
     if($tipo_doc=='03'){$("#TrFact").show();$("#TxtRucAm").focus()}else{$("#TrFact").hide();$("#TxtMontoPagado").focus();}
   }
   
    function ConsultaRucAm(){ 
		var $ruc = $('#TxtRucAm').val();
		$("#IdCargando").show();
		$.ajax({
		type:'POST',
		url:'controlador/Cadmision.php',
		data:{accion:'CONSULTA_RUC',ruc:$ruc},
		dataType:"JSON",
		success: function(datos){
		if(datos==0){swal("RUC no se encuentra en la Busqueda ..", "Error", "error");$("#IdCargando").hide();return false;}
	     $('#TxtRazon').val(datos[1]);$('#TxtDirRazon').val(datos[2]);$("#IdCargando").hide();
		}
	});
  }
  
  function LlenarServicio(){
	  $id=$("#TipoServ").val()
	$.post('controlador/Cadmision.php',{accion:"LLE_SERV",id:$id},function(data){
		//alert(data)
		$("#AmCboServicio").html(data).trigger("chosen:updated");
     })
	}
	
   
    var carrito=new Array();
			   
	 function AgregarCarrito(){  
	              $id=$("#AmCboServicio").val() 
				  $servicio=$("#AmCboServicio option:selected").text()
				  $can=$("#AmCan").val()
				  $precio=$("#AmCboServicio option:selected").attr('precio')
				  $pago_pac=($can*$precio).toFixed(2);
				  $pago_conv=0.00;
				  $total=(parseFloat($pago_pac)+parseFloat($pago_conv)).toFixed(2);;
				  if($id==0){
					  swal({
                      title: "Cuidado",
                      text: "Seleccione Servicio",
					  icon: "warning",
                      buttons: false,
				      timer: 1500
                      })
					  setTimeout(function(){ $("#AmCboServicio").trigger('chosen:open');}, 200);  
				     return false;
				   }
				 var ArrayBidi=new Array();
				     ArrayBidi.push($id);
					 ArrayBidi.push($servicio);
					 ArrayBidi.push($can);
					 ArrayBidi.push($precio);
					 ArrayBidi.push($pago_pac);
					 ArrayBidi.push($pago_conv);
					 ArrayBidi.push($total);
					 carrito.push(ArrayBidi);
				     ListarCarrito();	
					 setTimeout(function(){ $("#AmCboServicio").trigger('chosen:open');}, 200);		 
	 }
	 
	 function EliminarCesta(index){
   	  carrito.splice(index,1);
	  ListarCarrito();
	}
	 	 
	 function ListarCarrito(){
				$("#CuerpoDetSer").html(""); $i=0;$total=0;
				$.each(carrito,function(index,columna){$i++;
				   
				   $total=(parseFloat($total)+parseFloat(columna[6])).toFixed(2);
				   $("#CuerpoDetSer").append("<tr height='30px'><td style='font-size:10px;' >&nbsp;"+columna[1]+"</td><td align='center'  style='font-size:10px;'>"+columna[2]+"</td><td style='font-size:10px;'>&nbsp;"+columna[3]+"</td><td style='font-size:10px;'>&nbsp;"+columna[4]+"</td><td style='font-size:10px;'>&nbsp;"+columna[5]+"</td><td style='font-size:10px;'>&nbsp;"+columna[6]+"</td><td align='center' style='font-size:10px;'><img src='img/eliminar.png' height='20' width='20' border='0' onclick=\"javascript:EliminarCesta('"+index+"');\"  /></td></tr>"); 
				})
				   $("#TxtMonPac").val('S/ '+String($total));	  
	  }
	  
	  function GrabarAm(){
	    //AmTxtDni,TipoServ,AmTxtFecha,CboTurno,AmCboIdEsp,AmCboServicio
		$dni=$("#AmTxtDni").val()
		$pac=$("#AmTxtPaciente").val()
		$idtiposerv=$("#TipoServ").val()
		$codtipo=$("#TipoServ option:selected").attr("cod_tipo")
		$idturno=$("#CboTurno").val()
		$idesp=$("#AmCboIdEsp").val()
		$idmed=$("#AmCboIdMed").val()
		
		if($dni==''){swal("Ingrese Paciente", "Cuidado", "warning");return false;}
		if($pac==''){swal("Ingrese Paciente", "Cuidado", "warning");return false;}
		if($idtiposerv==0){swal("Seleccione Tipo Servicio", "Cuidado", "warning");return false; }
		if($codtipo=='C' || $codtipo=='E'){
		  if($idturno==0){swal("Seleccione turno", "Cuidado", "warning");return false; }
		  if($idturno==0){swal("Seleccione Especialidad", "Cuidado", "warning");return false; }
		}else{
		   $idturno=0;$idesp=0;
		}
		if($idmed==0){swal("Seleccione Medico", "Cuidado", "warning");return false; }
		
		if($idtiposerv==0){swal("Seleccione Tipo Servicio", "Cuidado", "warning");return false; }
		
		$.post('controlador/Cadmision.php',{accion:"GRABAR_AM",dni:$dni,idtiposerv:$idtiposerv,idturno:$idturno,idesp:$idesp,idmed:$idmed,carrito:carrito,cod_tipo:$codtipo},function(data){
		  if(data==0){swal("Error de Registro", "Error", "error");return false;}
		  if(data==1){LimpiarAM();swal("Registro Satisfactorio", "Felicitaciones", "success");$("#AmTxtDni").focus();return false;}
		  if(data==2){swal("Paciente no existe", "Cuidado", "warning");return false;}
     })
		
	  }
	  
	 function LimpiarAM(){
	   $("#TipoServ,#CboTurno,#AmCboIdEsp,#AmCboIdMed,#AmCboServicio").val(0).trigger('chosen:updated');$("#AmCan").val(1)
	   $("#AmTxtDni,#AmTxtPaciente").val("");$("#CuerpoDetSer").html("")
	 }

</script>

