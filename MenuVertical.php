<div class="main-menu menu-fixed menu-light menu-accordion" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="active"><a href="index.php" style="margin-bottom: -25px"><i class="la la-home"></i><span>ERP SALUD</span></a></li>
            <li class=" navigation-header"><span data-i18n="Professional">M&oacute;dulos</span><i class="la la-ellipsis-h" data-toggle="tooltip" data-placement="right" data-original-title="Professional"></i></li>
            <li class=" nav-item"><a href="#"><i class="la la-edit"></i><span class="menu-title" data-i18n="Appointment">Configuraci&oacute;n</span></a>
                <ul class="menu-content menu-accordion bg-vino-oscuro">
                    <li id="Conf_1" onClick="Aparecer('LiConfTab1', 'Conf_1');"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Permisos del Sistema</span></a></li>

                    <li id="Conf_2" onClick="GrupoUsuarios('LinkConf2', 'ConfTab2');Aparecer('LiConfTab2', 'Conf_2');"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Grupo Usuarios</span></a></li>

                    <li id="Conf_3" onClick="Usuarios('LinkConf3', 'ConfTab3');Aparecer('LiConfTab3', 'Conf_3')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Usuarios</span></a></li>

                    <li id="Conf_4" onClick="Series('LinkConf4', 'ConfTab4');Aparecer('LiConfTab4', 'Conf_4')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Series</span></a></li>

                    <li id="Conf_5" onClick="Cajas('LinkConf5', 'ConfTab5');Aparecer('LiConfTab5', 'Conf_5')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Cajas</span></a></li>

                    <li id="Conf_6" onClick="Especialidades('LinkConf6', 'ConfTab6');Aparecer('LiConfTab6', 'Conf_6')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Especialidades</span></a></li>

                    <li id="Conf_7" onClick="Medicos('LinkConf7', 'ConfTab7');Aparecer('LiConfTab7', 'Conf_7')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>M&eacute;dicos</span></a></li>

                    <li id="Conf_8" onClick="Pacientes('LinkConf8', 'ConfTab8');Aparecer('LiConfTab8', 'Conf_8')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Pacientes</span></a></li>

                    <li id="Conf_9" onClick="Aparecer('LiConfTab9', 'Conf_9')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Aseguradoras</span></a></li>

                    <li id="Conf_10" onClick="Aparecer('LiConfTab10', 'Conf_10')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Empleadoras</span></a></li>

                    <li id="Conf_11" onClick="Aparecer('LiConfTab11', 'Conf_11')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Planes de Salud</span></a></li>

                    <li id="Conf_12" onClick="Aparecer('LiConfTab12', 'Conf_12')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Historia Cl&iacute;nica</span></a></li>
                    <li id="Conf_13" onClick="Sucursales('LinkConf13', 'ConfTab13');Aparecer('LiConfTab13', 'Conf_13')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Sucursales</span></a></li>
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="la la-stethoscope"></i><span class="menu-title" data-i18n="Doctors">Admisi&oacute;n</span></a>
                <ul class="menu-content bg-vino-oscuro">
                    <li id="Adm_1" onClick="AbrirCaja('LinkAdm1', 'AdmTab1');Aparecer('LiAdmTab1', 'Adm_1')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Abrir Caja</span></a></li>

                    <li id="Adm_2" onClick="CerrarCaja('LinkAdm2', 'AdmTab2');Aparecer('LiAdmTab2', 'Adm_2')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Cerrar Caja</span></a></li>

                    <li id="Adm_3" onClick="ReservarCita('LinkAdm3', 'AdmTab3');Aparecer('LiAdmTab3', 'Adm_3')" ><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Reservar Cita</span></a></li>  

                    <li id="Adm_4" onClick="AtencionMedica('LinkAdm4', 'AdmTab4');Aparecer('LiAdmTab4', 'Adm_4')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Atenci&oacute;n M&eacute;dica</span></a></li>

                    <li id="Adm_5" onClick="Egresos('LinkAdm5', 'AdmTab5');Aparecer('LiAdmTab5', 'Adm_5')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Egresos</span></a></li>

                    <li id="Adm_6"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Seguimiento AM</span></a></li>

                    <li id="Adm_7"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Arqueo de Caja</span></a></li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="la la-stethoscope"></i><span class="menu-title" data-i18n="Doctors">Consultorio</span></a>
                <ul class="menu-content bg-vino-oscuro">
                    <li id="Cons_1" onClick="ConsultaPac('LinkCons1', 'ConsTab1');Aparecer('LiConsTab1', 'Cons_1')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Consulta Pacientes</span></a></li>

                    <li id="Cons_2"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Reporte Consultas</span></a></li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="la la-stethoscope"></i><span class="menu-title" data-i18n="Doctors">Tickets</span></a>
                <ul class="menu-content bg-vino-oscuro">
                    <li id="Ticket_1" onClick="LlamarAdm('LinkTicket1', 'TicketTab1');Aparecer('LiTicketTab1', 'Ticket_1')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Admision Ticket</span></a></li>

                    <li id="Ticket_2" onClick="LlamarCons('LinkTicket2', 'TicketTab2');Aparecer('LiTicketTab2', 'Ticket_2')" ><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Consultorio Ticket</span></a></li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="la la-stethoscope"></i><span class="menu-title" data-i18n="Doctors">
                        Contabilidad</span></a>
                <ul class="menu-content bg-vino-oscuro">
                    <li id="Cont_1" onClick="DocumentosCont('LinkCont1', 'ContTab1');Aparecer('LiContTab1', 'Cont_1')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Documentos</span></a></li>	

                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="la la-stethoscope"></i><span class="menu-title" data-i18n="Doctors">
                        Farmacia</span></a>
                <ul class="menu-content bg-vino-oscuro">
                    <li id="Farm_1" onClick="Productos('LinkFarm1', 'FarmTab1');Aparecer('LiFarmTab1', 'Farm_1')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Productos</span></a></li>	
                    <li id="Farm_2" onClick="Laboratorios('LinkFarm2', 'FarmTab2');Aparecer('LiFarmTab2', 'Farm_2')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Laboratorios</span></a></li>	
                    <li id="Farm_3" onClick="Familias('LinkFarm3', 'FarmTab3');Aparecer('LiFarmTab3', 'Farm_3')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Familias</span></a></li>	
                    <li id="Farm_4" onClick="Principios_activos('LinkFarm4', 'FarmTab4');Aparecer('LiFarmTab4', 'Farm_4')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Principios activos</span></a></li>	
                    <li id="Farm_5" onClick="Lotes('LinkFarm5', 'FarmTab5');Aparecer('LiFarmTab5', 'Farm_5')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Lotes</span></a></li>	
                    <li id="Farm_6" onClick="Compras('LinkFarm6', 'FarmTab6');Aparecer('LiFarmTab6', 'Farm_6')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Reporte Compras</span></a></li>
                    <li id="Farm_7" onClick="EfectuarCompra('LinkFarm7', 'FarmTab7');Aparecer('LiFarmTab7', 'Farm_7')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Realizar Compra</span></a></li>  	
                    <li id="Farm_8" onClick="Proveedores('LinkFarm8', 'FarmTab8');Aparecer('LiFarmTab8', 'Farm_8')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Proveedores</span></a></li>	
                    <li id="Farm_9" onClick="Ventas('LinkFarm9', 'FarmTab9');Aparecer('LiFarmTab9', 'Farm_9')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Reporte Ventas</span></a></li>
                     <li id="Farm_10" onClick="EfectuarVenta('LinkFarm10', 'FarmTab10');Aparecer('LiFarmTab10', 'Farm_10')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Realizar Venta</span></a></li>   	
                </ul>
            </li>
            <li class=" nav-item"><a href="#"><i class="la la-stethoscope"></i><span class="menu-title" data-i18n="Doctors">
                        Logística</span></a>
                <ul class="menu-content bg-vino-oscuro">
                    <li id="Log_1" onClick="CategoriaProductosLog('LinkLog1', 'LogTab1');Aparecer('LiLogTab1', 'Log_1')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Categoría de  productos</span></a></li>	

                </ul>
                <ul class="menu-content bg-vino-oscuro">
                    <li id="Log_2" onClick="ProductosLog('LinkLog2', 'LogTab2');Aparecer('LiLogTab2', 'Log_2')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Productos</span></a></li>	

                </ul>
                <ul class="menu-content bg-vino-oscuro">
                    <li id="Log_3" onClick="Almacen('LinkLog3', 'LogTab3');Aparecer('LiLogTab3', 'Log_3')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Almacén</span></a></li>	

                </ul>
                <ul class="menu-content bg-vino-oscuro">
                    <li id="Log_3" onClick="OrdenCompra('LinkLog4', 'LogTab4');Aparecer('LiLogTab4', 'Log_4')"><a class="menu-item bg-blanco_color-vino-osucro" href="#"><i></i><span>Orden de compra</span></a></li>	

                </ul>
            </li>

        </ul>
    </div>
</div>
