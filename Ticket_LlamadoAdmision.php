
<div class="app-content content" style="margin-left: 10%; margin-right: 10%" >
     
   <div class="content-wrapper">
    
     <div class="content-body">
		 <div class="row">
			 <div class="col-12 text-left">
			       <div class="card">
				            <div class="card-content">
                                <div class="card-body">   
									  <span id="IdVentanilla" style="font-weight: bolt; color: #900052; font-size: 25px; text-align: left !important">
									   VENTANILLA  </span>	
                                </div>
                            </div>
				   </div>
			 </div>
		 </div>
       <div class="row">
		            
                    <div class="col-xl-4 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="success"><span id="Total" style="font-size: 30px">0</span></h3>
                                            <h6 > Total Turnos </h6>
                                        </div>
                                        <div>
                                            <i class="icon-user-follow success font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="info"><span id="Atendidos" style="font-size: 30px">0</span></h3>
                                            <h6>Turnos Atendidos</h6>
                                        </div>
                                        <div>
                                            <i class="icon-user-following info font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div id='PorAten' class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 0%" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12">
                        <div class="card pull-up">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-left">
                                            <h3 class="danger"><span style="font-size: 30px" id="Pendientes" >0</span></h3>
                                            <h6>Turnos Pendientes</h6>
                                        </div>
                                        <div>
                                            <i class="icon-user-unfollow danger font-large-2 float-right"></i>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                        <div id="PorPen" class="progress-bar bg-gradient-x-danger" role="progressbar" style="width:0%" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
		 
	</div>
		 
   <div class="row">
		  <!--<div class="col-xl-12 col-lg-12 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    
									<div class="row">
									   <div class="col-xl-5 text-center" >
										 
									   </div>
									   <div class="col-xl-7 " >
										 <span style="font-size: 150px; font-weight: bold; color:#464E7E">A15</span>
									   </div>
									</div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>-->
	   <div class="col-xl-2 col-md-2 col-2"></div>
	   <div class="col-xl-8 col-md-12 col-12" >
                            <div class="card">
                                <div class="card-content">
                                    <div class="weather-date position-relative">
                                        <div class="date-info position-absolute bg-blue bg-lighten-1 white mt-3 p-1 text-center"
											 style="background-color: #EE7D8B !important" >
                                            <span class="date block">Turno</span>
                                            
                                        </div>
                                    </div>
                                    <div class="card-body bg-blue bg-lighten-4 rounded-top" style="background-color: #EDEAEC !important">
                                        <ul class="list-inline text-right">
                                            <!--<li><a data-action="reload"><i class="ft-rotate-cw font-medium-4 blue"></i></a></li>-->
                                        </ul>
                                        <div class="animated-weather-icons text-center">
                                            <span id="Turno" style="color: #900052; font-size: 150px; font-weight: bold"></span>
                                        </div>
                                   
                                    </div>
                                    <div class="card-footer bg-blue bg-darken-2 py-1 border-0" style="background-color: #900052 !important; ">
                                        <div class="row">
                                            <div class="col-6 text-center display-table-cell" style="border-right: solid !important; border-color: aliceblue !important; margin: 0px !important ">
                                          <button type="button" class="btn btn-light btn-min-width btn-glow mr-1 mb-1" style="color: #464E7E; font-weight: bold" onClick="Siguiente()">Siguiente</button>
                                            </div>
                                            <div class="col-6 text-center display-table-cell">
             <button type="button" class="btn btn-light btn-min-width btn-glow mr-1 mb-1" onClick="Rellamar()">
				 Llamar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
	          <div class="col-xl-2 col-md-2 col-2"></div>
   </div>
		 
  </div>
</div>
 <input type="hidden" id="HiIdTicket" value="0" >
<script>
	
	function ActualizarTurnos(){
	   $.post("controlador/Cticket.php",{accion:'ADM_TURNOS'},function(data){
		     $data=data.split('*')
		     $("#Total").text($data[0]);$("#Atendidos").text($data[1]);$("#Pendientes").text($data[2])
		     $('#PorAten').css('width', $data[3]);$('#PorPen').css('width', $data[4]);
		     ActualizarTurnos()
	   })
	}
	function NumeroTurno(){
	   $.post("controlador/Cticket.php",{accion:'NUM_TURNO'},function(data){
		    
		    if(data=='NO'){swal("Archivo no Existe", "Comuniquese con Informática", "Error");return false;}
		    if(data==0){swal("Archivo ha sido modificado", "Seleccione Registro", "warning");return false;}
		    $data=data.split('*') 
		    $("#IdVentanilla").text("VENTANILLA "+$data[0]);
		    $("#Turno").text($data[1]);$("#HiIdTicket").val($data[2]);
	   })
	}
	function Siguiente(){
	   $.post("controlador/Cticket.php",{accion:'SIGUIENTE'},function(data){
		    $data=data.split('*')
		    
		    if($data[0]=='NO'){swal("Archivo no Existe", "Comuniquese con Informática", "Error");return false;}
		    if($data[0]==0){swal("Archivo ha sido modificado", "Seleccione Registro", "warning");return false;}
		    if($data[0]=='error'){return false;}
		    $("#Turno").text($data[0])
		    $("#HiIdTicket").val($data[1]);
		    
		    
	   })
	}
function Rellamar(){ 
	$id=$("#HiIdTicket").val();
	$.post("controlador/Cticket.php",{accion:'RELLAMAR',id:$id},function(data){ }) 
}
	
	NumeroTurno();
    ActualizarTurnos()
</script>