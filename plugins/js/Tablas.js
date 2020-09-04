function GrupoUsuarios($link, $tablink) {
    $("#ConfTab2").html("")
    $.post('Conf_GrupoUsuario.php', {}, function (data) {
        $("#ConfTab2").html(data);
        Desactivar($link, $tablink)
    })
}
function Usuarios($link, $tablink) {
    $("#ConfTab3").html("")
    $.post('Conf_Usuario.php', {}, function (data) {
        $("#ConfTab3").html(data);
        Desactivar($link, $tablink)
    })
}
function Series($link, $tablink) {
    $("#ConfTab4").html("")
    $.post('Conf_Serie.php', {}, function (data) {
        $("#ConfTab4").html(data);
        Desactivar($link, $tablink)
    })
}
function Cajas($link, $tablink) {
    $("#ConfTab5").html("")
    $.post('Conf_Caja.php', {}, function (data) {
        $("#ConfTab5").html(data);
        Desactivar($link, $tablink)
    })
}
function Especialidades($link, $tablink) {
    $("#ConfTab6").html("")
    $.post('Conf_Especialidad.php', {}, function (data) {
        $("#ConfTab6").html(data);
        Desactivar($link, $tablink)
    })
}
function Medicos($link, $tablink) {
    $("#ConfTab7").html("")
    $.post('Conf_Medico.php', {}, function (data) {
        $("#ConfTab7").html(data);
        Desactivar($link, $tablink)
    })
}
function Pacientes($link, $tablink) {
    $("#ConfTab8").html("")
    $.post('Conf_Paciente.php', {}, function (data) {
        $("#ConfTab8").html(data);
        Desactivar($link, $tablink)
    })
}
function Sucursales($link, $tablink) {
    $("#ConfTab13").html("")
    $.post('Conf_Sucursal.php', {}, function (data) {
        $("#ConfTab13").html(data);
        Desactivar($link, $tablink)
    })
}
function AbrirCaja($link, $tablink) {
    $("#AdmTab1").html("")
    $.post('Adm_AbrirCaja.php', {}, function (data) {
        $("#AdmTab1").html(data);
        Desactivar($link, $tablink)
    })
}
function CerrarCaja($link, $tablink) {
    $("#AdmTab2").html("")
    $.post('Adm_CerrarCaja.php', {}, function (data) {
        $("#AdmTab2").html(data);
        Desactivar($link, $tablink)
    })
}
function ReservarCita($link, $tablink) {
    $("#AdmTab3").html("")
    $.post('Adm_ReservarCita.php', {}, function (data) {
        $("#AdmTab3").html(data);
        Desactivar($link, $tablink)
    })
}
function AtencionMedica($link, $tablink) {
    $("#AdmTab4").html("")
    $.post('Adm_AtencionMedica.php', {}, function (data) {
        $("#AdmTab4").html(data);
        Desactivar($link, $tablink)
    })
}
function Egresos($link, $tablink) {
    $("#AdmTab5").html("")
    $.post('Adm_Egresos.php', {}, function (data) {
        $("#AdmTab5").html(data);
        Desactivar($link, $tablink)
    })
}
function ConsultaPac($link, $tablink) {
    $("#ConsTab1").html("")
    $.post('Cons_Consulta.php', {}, function (data) {
        $("#ConsTab1").html(data);
        Desactivar($link, $tablink)
    })
}
function LlamarAdm($link, $tablink) {
    $("#TicketTab1").html("")
    $.post('Ticket_LlamadoAdmision.php', {}, function (data) {
        $("#TicketTab1").html(data);
        Desactivar($link, $tablink)
    })
}
function LlamarCons($link, $tablink) {
    $("#TicketTab2").html("")
    $.post('Cons_Consulta.php', {}, function (data) {
        $("#TicketTab2").html(data);
        Desactivar($link, $tablink)
    })
}

function DocumentosCont($link, $tablink) {
    $("#ContTab1").html("")
    $.post('Cont_DocumentoElectronico.php', {}, function (data) {
        $("#ContTab1").html(data);
        Desactivar($link, $tablink)
    })
}
function Productos($link, $tablink) {
    $("#FarmTab1").html("")
    $.post('Farm_Producto.php', {}, function (data) {
        $("#FarmTab1").html(data);
        Desactivar($link, $tablink)
    })
}
function Laboratorios($link, $tablink) {
    $("#FarmTab2").html("")
    $.post('Farm_Laboratorio.php', {}, function (data) {
        $("#FarmTab2").html(data);
        Desactivar($link, $tablink)
    })
}
function Familias($link, $tablink) {
    $("#FarmTab3").html("")
    $.post('Farm_Familia.php', {}, function (data) {
        $("#FarmTab3").html(data);
        Desactivar($link, $tablink)
    })
}
function Principios_activos($link, $tablink) {
    $("#FarmTab4").html("")
    $.post('Farm_Principio_activo.php', {}, function (data) {
        $("#FarmTab4").html(data);
        Desactivar($link, $tablink)
    })
}
function Lotes($link, $tablink) {
    $("#FarmTab5").html("")
    $.post('Farm_Lote.php', {}, function (data) {
        $("#FarmTab5").html(data);
        Desactivar($link, $tablink)
    })
}
function Compras($link, $tablink) {
    $("#FarmTab6").html("")
    $.post('Farm_Compra.php', {}, function (data) {
        $("#FarmTab6").html(data);
        Desactivar($link, $tablink)
    })
}
function EfectuarCompra($link, $tablink) {
    $("#FarmTab7").html("")
    $.post('Farm_efectuar_compra.php', {}, function (data) {
        $("#FarmTab7").html(data);
        Desactivar($link, $tablink)
    })
}
function Proveedores($link, $tablink) {
    $("#FarmTab8").html("")
    $.post('Farm_Proveedor.php', {}, function (data) {
        $("#FarmTab8").html(data);
        Desactivar($link, $tablink)
    })
}
function Ventas($link, $tablink) {
    $("#FarmTab9").html("")
    $.post('Farm_Venta.php', {}, function (data) {
        $("#FarmTab9").html(data);
        Desactivar($link, $tablink)
    })
}

function EfectuarVenta($link, $tablink) {
    $("#FarmTab10").html("")
    $.post('Farm_efectuar_venta.php', {}, function (data) {
        $("#FarmTab10").html(data);
        Desactivar($link, $tablink)
    })
}

function Chat($link, $tablink) {
//    $("#ChatTab").html("");
//    $.post('Chat.php', {}, function (data) {
//        $("#ChatTab").html(data);
        Desactivar($link, $tablink);
//    })
}
function CategoriaProductosLog($link, $tablink) {
    $("#LogTab1").html("")
    $.post('Log_categoria_producto.php', {}, function (data) {
        $("#LogTab1").html(data);
        Desactivar($link, $tablink)
    })
}
function ProductosLog($link, $tablink) {
    $("#LogTab2").html("")
    $.post('Log_producto.php', {}, function (data) {
        $("#LogTab2").html(data);
        Desactivar($link, $tablink)
    })
}
function Almacen($link, $tablink) {
    $("#LogTab3").html("")
    $.post('Log_almacen.php', {}, function (data) {
        $("#LogTab3").html(data);
        Desactivar($link, $tablink)
    })
}
function OrdenCompra($link, $tablink) {
    $("#LogTab4").html("")
    $.post('Log_orden_compra.php', {}, function (data) {
        $("#LogTab4").html(data);
        Desactivar($link, $tablink)
    })
}

function Desactivar($link, $tablink) {
    //PARA MODULO DE CONFIGURACION
    $("#LinkConf1,#LinkConf2,#LinkConf3,#LinkConf4,#LinkConf5,#LinkConf6,#LinkConf7,#LinkConf8,#LinkConf9").removeClass("active")
    $("#LinkConf10,#LinkConf11,#LinkConf12,#LinkConf13").removeClass("active")
    $("#ConfTab1,#ConfTab2,#ConfTab3,#ConfTab4,#ConfTab5,#ConfTab6,#ConfTab7,#ConfTab8,#ConfTab9,#ConfTab10").removeClass("active")
    $("#ConfTab11,#ConfTab12,#ConfTab13").removeClass("active")

    //PARA MODULO DE ADMISION
    $("#LinkAdm1,#LinkAdm2,#LinkAdm3,#LinkAdm4,#LinkAdm5").removeClass("active")
    $("#AdmTab1,#AdmTab2,#AdmTab3,#AdmTab4,#AdmTab5").removeClass("active")

    //PARA MODULO DE CONSULTORIOS
    $("#LinkCons1").removeClass("active")
    $("#ConsTab1").removeClass("active")

    //PARA MODULO DE TICKET
    $("#LinkTicket1").removeClass("active")
    $("#TicketTab1").removeClass("active")

    //PARA MODULO DE CONTABILIDAD
    $("#LinkCont1").removeClass("active")
    $("#ContTab1").removeClass("active")
    //PARA MODULO DE FARMACIA
    $("#LinkFarm1,#LinkFarm2,#LinkFarm3,#LinkFarm4,#LinkFarm5,#LinkFarm6,#LinkFarm7,#LinkFarm8,#LinkFarm9,#LinkFarm10").removeClass("active")
    $("#FarmTab1,#FarmTab2,#FarmTab3,#FarmTab4,#FarmTab5,#FarmTab6,#FarmTab7,#FarmTab8,#FarmTab9,#FarmTab10").removeClass("active")

    $("#LinkChat").removeClass("active")
    $("#ChatTab").removeClass("active")
 //PARA MODULO DE LOGÍSTICA
    $("#LinkLog1,#LinkLog2,#LinkLog3,#LinkLog4").removeClass("active")
    $("#LogTab1,#LogTab2,#LogTab3,#LogTab4").removeClass("active")

    $("#" + $link).addClass("active")
    $("#" + $tablink).addClass("active")
}




/*$(document).ready(function() {
 
 
 
 $('#IdTblPaciente').fixheadertable({
 //caption	: 'Lista de Areas', 
 colratio : [15,50,50,15,50], 
 height : 500, 
 width :'100%', 
 zebra : true, 
 sortable : false, 
 sortedColId : 3, 
 pager : false,
 rowsPerPage	 : 10,
 resizeCol : false,
 });
 });	*/



// PARA ACTIVAR MENUS
function  Aparecer($id, $idvertical) {
    var $activo = $("#HiActivo").val()
    $("#" + $id).show();
    $("#" + $idvertical).css({
        "background-color": "#FFFFFF",
        "color": "#5E0E38"
    })

    $("#" + $activo).css({
        "background-color": "#5E0E38",
        "color": "#FFFFFF"
    })
    $("#HiActivo").val($idvertical)
}

// FUNCIONES PARA CARGAR PAGINAS








