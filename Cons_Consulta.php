<?php
require_once("cado/ClaseAdmision.php");
$oadmision=new Admision();
date_default_timezone_set("America/Lima");
?>
<style>
	.font-size14 {
		font-size: 14px;
}
</style>
<div class="col-xl-12 col-lg-12">
	<div class="card">
		<div><h4 class="card-title">Paciente:</h4></div>
		<div class="card-content">
			<div class="card-body">	
			<!--INICIO DE NOMBRE DE LOS TABS-->
				<ul class="nav nav-tabs nav-topline nav-justified">
					<li class="nav-item">
						<a class="nav-link active" id="base-tab41" data-toggle="tab" aria-controls="tab41" href="#tab41" aria-expanded="true">Antecedentes</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="base-tab42" data-toggle="tab" aria-controls="tab42" href="#tab42" aria-expanded="false">Consulta</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="base-tab43" data-toggle="tab" aria-controls="tab43" href="#tab43" aria-expanded="false">Solicitudes</a>
					</li>
				</ul>
			<!--FIN DE NOMBRE DE LOS TABS-->
			
				<div class="tab-content px-1 pt-1">
				<!--INICIO CONTENIDO DEL PANEL ANTECEDENTES-->
					<div role="tabpanel" class="tab-pane active" id="tab41" aria-expanded="true" aria-labelledby="base-tab41">
						<div class="row">
                           <div class="col-md-2 col-sm-12">                            
                               <div class="row">
                               	 <div class="col-12">
								 	<h4 class="text-secondary font-size14">Alergias</h4>
								 	<textarea id="AntecedentesAlergias" style="width: 100%; height: 150px; font-size: 12px;"></textarea>			   
								 </div>
                               </div>
                               <div class="row">
                               	 <div class="col-12">
								   <h4 class="text-secondary font-size14">Qx Previas</h4>						
								   <textarea id="AntecedentesQx" style="width: 100%; height: 150px; font-size: 12px;"></textarea>			   
								 </div>
                               </div>                               
                           </div>
                           <div class="col-md-3 col-sm-12">
                           	  <div class="row">
								<div class="col-12">
									<h4 class="text-secondary font-size14">Medicamentos Habituales</h4>                         
									<textarea id="AntecedentesMed" style="width: 100%; height: 150px; font-size: 12px;"></textarea>								
                         	    </div>
                          	  </div>
                          	  <div class="row">
								<div class="col-12">
									<h4 class="text-secondary font-size14">Familiares</h4>                         
									<textarea id="AntecedentesFam" style="width: 100%; height: 150px; font-size: 12px;"></textarea>						
                         	    </div>
                          	  </div>
                           </div>
                           <div class="col-md-3 col-sm-12">
							  <div class="row">
								  <div class="col-12">
									<h4 class="text-secondary font-size14">G.O</h4>                         
									<textarea id="AntecedentesGO" style="width: 100%; height: 330px; font-size: 12px;"></textarea>                           			
                         		  </div>
                          	  </div>
                           </div>
                           <div class="col-md-4 col-sm-12">                                              
							  <h4 class="text-secondaryt font-size14">Patolog&iacute;as</h4>
                          	  <textarea id="AntecedentesPato" style="width: 100%; height: 330px; font-size: 12px;"></textarea>      
                           </div>
                        </div>
                        <div class="row">
                        	<div class="col-2">
                        		<button type="button" class="btn bg-vino mr-1 mb-1" onClick="GrabarAntecedentes()"><i class="ft-plus"></i> Grabar</button>
                        	</div>
                        </div>
					</div>
				<!--FIN CONTENIDO DEL PANEL ANTECEDENTES-->	
				
				<!--INICIO CONTENIDO DEL PANEL CONSULTA-->		
					<div class="tab-pane" id="tab42" aria-labelledby="base-tab42">
						<div class="row mt-2">
							<div class="col-4 font-italic">
							  <b>Especialidad</b>
							 <input type="text" class="form-control" id="TxtCeEspecialidad" style="width:95%"  />
							</div>							
							<div class="col-4 font-italic">
								<b>M&eacute;dico</b><br>
								<input type="text" class="form-control" id="TxtCeMedico" style="width:95%"  />	
							</div>
							<div class="col-4 font-italic">
								<b>Citas Anteriores</b><br>
	<button type="button" class="btn bg-vino mr-1 mb-0 w-50" onClick="AbrirModalCitasAnteriores()"><i class="ft-plus"  ></i> Ver</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 col-sm-12">                            
                            	<h4 class="text-secondary font-size14"><b>Raz&oacute;n de Visita</b></h4>
								<textarea id="ConsultaRV" style="width: 100%; height: 150px; font-size: 12px;"></textarea>             
                           </div>
                           <div class="col-md-2 col-sm-12">                            
                            	<h4 class="text-secondary font-size14"><b>Signos y S&iacute;ntomas</b></h4>
								<textarea id="ConsultaRV" style="width: 100%; height: 150px; font-size: 12px;"></textarea>             
                           </div>
                           <div class="col-md-4 col-sm-12">                            
                            	<h4 class="text-secondary font-size14"><b>Dx Sindr&oacute;mica</b></h4>
								<!--<textarea id="ConsultaRV" style="width: 100%; height: 150px; font-size: 12px;"></textarea>-->                            <table width="100%">
                              <tr>
                                 <td width="80%">
                            <input type="text" class="form-control" id="TxtCieNom1" style="width:95%" onkeyup="javascript:LisCie()"  />	</td>
                                 <td width="20%"><input type="text" class="form-control" id="TxtCie_1" style="width:95%"  />	</td>
                              </tr>
                              <tr><td>&nbsp;</td></tr>
                              <tr>
                                 <td width="80%"><input type="text" class="form-control" id="TxtCieNom2" style="width:95%"  />	</td>
                                 <td width="20%"><input type="text" class="form-control" id="TxtCie_2" style="width:95%"  />	</td>
                              </tr>
                              <tr><td>&nbsp;</td></tr>
                              <tr>
                                 <td width="80%"><input type="text" class="form-control" id="TxtCieNom3" style="width:95%"  />	</td>
                                 <td width="20%"><input type="text" class="form-control" id="TxtCie_3" style="width:95%"  />	</td>
                              </tr>    
                            </table>
                                                      
                             
                           </div>
                           <div class="col-md-2 col-sm-12">                            
                            	<h4 class="text-secondary font-size14">Dx</h4>
								<textarea id="ConsultaRV" style="width: 100%; height: 150px; font-size: 12px;"></textarea>             
                           </div>
                           <div class="col-md-2 col-sm-12">                            
                            	<h4 class="text-secondary font-size14">&nbsp;</h4>
								<input type="radio" class="custom-control-input" id="customRadio" name="example" value="customEx">
								<label class="custom-control-label" for="customRadio">P</label>								

								<input type="radio" class="custom-control-input" id="customRadio2" name="example" value="customEx">
								<label class="custom-control-label" for="customRadio2">D</label>									
								
								<input type="radio" class="custom-control-input" id="customRadio" name="example" value="customEx">
								<label class="custom-control-label" for="customRadio">R</label>
								
                           </div>
                           <div class="col-md-1 col-sm-12">                            
                            	<h4 class="text-secondary font-size14">CIE10</h4>
									           
                           </div>
						</div>
						<div class="row">
						   <div class="col-md-4 col-sm-12">                            
                            	<h4 class="text-secondary font-size14">Exploraci&oacute;n de F&iacute;sica</h4>
								<textarea id="ConsultaRV" style="width: 100%; height: 150px; font-size: 12px;"></textarea>             
                           </div>
                           <div class="col-md-8 col-sm-12">                            
                            	<h4 class="text-secondary font-size14">Tratamiento</h4>
								<textarea id="ConsultaRV" style="width: 100%; height: 150px; font-size: 12px;"></textarea>             
                           </div>
						</div>
						<div class="row">
						   <div class="col-md-4 col-sm-12">                            
                            	<h4 class="text-secondary font-size14">Tiempo de enfermedad</h4>
								<textarea id="ConsultaRV" style="width: 100%; height: 75px; font-size: 12px;"></textarea>             
                           </div>
						</div>
					</div>
				<!--FIN CONTENIDO DEL PANEL CONSULTA-->		
					
				<!--INICIO CONTENIDO DEL PANEL SOLICITUDES-->		
					<div class="tab-pane" id="tab43" aria-labelledby="base-tab43">
						<p>Biscuit ice cream halvah candy canes bear claw ice cream cake chocolate bar donut. Toffee cotton
							candy liquorice. Oat cake lemon drops gingerbread dessert caramels. Sweet dessert jujubes powder sweet
							sesame snaps.</p>
					</div>
				<!--FIN CONTENIDO DEL PANEL SOLICITUDES-->	
				</div>
			</div>
		</div>
	</div>
</div>
<!-- MODAL REGISTRAR GRUPO USUARIO -->
   
	<div id="IdModalCitasAnter" class="modal fade" role="dialog" >
 
		<div class="modal-dialog modal-lg rotateIn">
			<div class="modal-content">
				<div class="modal-header bg-vino">&nbsp; CITAS ANTERIORES </div>
    			<div class="modal-body">
    				<table  width="100%" style="font-size:13px;">
						<tr class="text-center">
          					<th>FECHA</th>
           					<th>DIAGN&Oacute;STICO</th>
           					<th>M&Eacute;DICO</th>
           				</tr>
            			<tr>
            				<td><?=date("Y/m/d")?></td>
            				<td>Diagnostico reservado por probable infeccion de coronavirus</td>
            				<td>Benjamin Franklin</td>
            			</tr>
            			<tr>
            				<td><?=date("Y/m/d")?></td>
            				<td>Diagnostico reservado por probable infeccion de coronavirus</td>
            				<td>Benjamin Franklin</td>
            			</tr>
            			<tr>
            				<td><?=date("Y/m/d");?></td>
            				<td>Diagnostico reservado por probable infeccion de coronavirus</td>
            				<td>Benjamin Franklin</td>
            			</tr>
    				</table>
 				</div>
				<div class="modal-footer">				  
				  <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"> Cancelar</button>
				</div>
        	</div>
		</div>
	</div>

<!-- FIN MODAL REGISTRAR USUARIO-->


<script>
	function AbrirModalCitasAnteriores(){ $("#IdModalCitasAnter").modal()   }
	function MedicoXEspecialidad(){
	  $id=$("#ConsultaCboIdEsp").val()
	$.post('controlador/Cadmision.php',{accion:"MED_ESP",id:$id},function(data){
		$("#ConsultaCboIdMed").html(data).trigger("chosen:updated");$("#ConsultaCboIdMed").trigger('chosen:activate');
     })
	}
	function Siguiente1(){
	 $('#ConsultaCboIdEsp').trigger('chosen:activate');
   }

   function LisCie(){
	    // var $pac=$("#pac1").val()
		 var $datos='';
		 // alert('hola')
		 $.post('controlador/Cadmision.php',{accion:"AUTOCIE"},function(data){
	        //alert(data)
		   $datos=eval(data)
		   alert($datos)
		 $( "#TxtCieNom1" ).autocomplete({
			max:10,
			source: $datos,
			minLength: 3,
			select:function(event,ui){
				alert(ui.value)
			   /*$("#IdHiPac").val(ui.item.id)
			   $("#TxtDni").val(ui.item.dni)
			   $("#pac1,#TxtDni").prop("disabled",true); 
			   $('#med .chzn-drop .chzn-search input[type="text"]').focus();  */
			 }
		   });
		 })	   
	 }
</script>