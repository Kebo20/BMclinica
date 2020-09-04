<link  rel="stylesheet" type="text/css"  href="assets/css/select2.min.css" />
<script src="assets/js/select2.full.min.js"   type="text/javascript"></script>
<?php
include 'cado/ClaseConfiguracion.php';

$oconf = new Configuraciones();
$sucursales = $oconf->ListarSucursal("");
$sucursales2 = $oconf->ListarSucursal("");

include 'cado/ClaseFarmacia.php';

$ofarmacia = new Farmacia();
$productos = $ofarmacia->ListarProducto("");
session_start();
?>
<div class="modal-body">

    <table  width="100%" style="font-size:12px; font-weight:bold;">
        <tr style='display:none'>
            <td><b>Id</b>
                <input  type="text" id="id_OC" size="5" readonly="readonly" class="form-control"/>
            </td>

        </tr>

        <tr>


            <td width="30%"><b>Sucursales</b>


                <select id="OCid_cmb_suc" class="form-control OCchosen-select" onchange="almacenxsucursal()" style="width:95%" >
                    <option value="">Seleccione</option>
                    <?php foreach ($sucursales as $s) { ?>
                        <option   value="<?= $s[0] ?>"><?= $s[1] ?></option>
                    <?php } ?>

                </select>
            </td>
            <td width="30%"><b>Tipo</b>


                <select id="OCid_cmb_tipo" class="form-control OCchosen-select" onchange="almacenxsucursal();OCproductos()" style="width:95%" >
                    <option value="">Seleccione</option>
                    <option   value="logística">Logística</option>
                    <option   value="farmacia">Farmacia</option>

                </select>
            </td>
            <td width="30%"><b>Almacén</b>


                <select id="OCid_cmb_alm" class="form-control OCchosen-select" onchange="" style="width:95%" >
                    <option value="">Seleccione</option>

                </select>
            </td>


        </tr>
    </table>
    <hr>
    <table width="100%"  style="font-size:12px; font-weight:bold;">
        <tr>

            <td  width="25%"><b>N° orden</b><input  type="number" id="OCnro"  class="form-control numero" value="" style="width:95%" autocomplete="off" ></td>
            <td  width="25%"><b>Fecha</b><input  type="date" id="OCfecha"  class="form-control" value="" style="width:95%" 
                                                 autocomplete="off" ></td>

            <td width="25%"><b>Tipo de producto</b>
                <select id="OCtipo_producto" class="form-control OCchosen-select"   style="width:95%" >
                    <option value="">Seleccione</option>
                    <option value="producto">Producto</option>
                    <option value="servicio">Servicio</option>

                </select></td>


            <td width="25%"><b>Usuario</b>
                <input type="text" disabled=""  value="<?= $_SESSION['S_user']; ?>" style="text-transform:uppercase;width:95%" class="form-control "  
                       autocomplete="off" ></td>


        </tr>
        <tr>
            <td colspan="4" width="90%"><b>Referencia</b>
                <input type="text" id="OCreferencia" value="" style="text-transform:uppercase;width:98.5%" class="form-control"  
                       autocomplete="off" ></td>
        </tr>

    </table>
    <hr>
    <table  width="100%" class="" style="font-size:12px; font-weight:bold;">


        <tr>
            <td  width="60%"><b>Producto</b><br>
                <div id="OCid_cmb_pro-contenedor">
                <select id="OCid_cmb_pro" class="form-control OCchosen-select "  style="width: 95%" >
                    <option value="">Seleccione producto</option>

                </select>
                </div>
            </td>
            <td  width="10%"><b>Stock</b><br>
                <input type="text" disabled=""  value="" style="text-transform:uppercase;width:95%" class="form-control "  
                       autocomplete="off" >
            </td>
            <td  width="10%"><b>Cantidad</b><br>
                <input type="text"  id="OCcantidad" value="" style="text-transform:uppercase;width:95%" class="form-control numero"  
                       autocomplete="off" >
            </td>
            <td  width="10%"><b>Unidad</b><br>
                <input type="text"  id="OCunidad" value="" style="text-transform:uppercase;width:95%" class="form-control "  
                       autocomplete="off" >
            </td>
            <td  width="10%"><b></b><br>
                <button type="button"  style="width:95%;height: 35px" class="btn btn-xs bg-vino " onClick="OCAñadirDetalle()"><i class='ft-plus'></i></button><td>

            </td>


        </tr>
    </table>
    <br>

</div>
<div class="row" >
    <div class="col-12 pl-2" >
        <table id="IdTblOCD" style="text-align:right;" border="1" bordercolor="#cccccc" >
            <thead>
                <tr style="font-size:13px">
                    <Th></Th>
                    <Th>N°</Th>
                    <Th>Producto/Medicamento</Th>
                    <Th>Cantidad</Th>
                    <Th>Unidad</Th>
                    <Th>Despachado</Th>
                    <Th>Pendiente</Th>

                </tr>
            </thead>
            <tbody id="IdCuerpoOCD" style="font-size:12px;">  </tbody>  
        </table>
    </div>

</div>
<br>
<div class="row"  >

    <div class="col-lg-12 col-md-12 " >
        <div class="form-group" >
            &nbsp;&nbsp;
            <button type="button" id="OCbtn_nuevo" class="btn bg-vino cambio-color mr-1 mb-1"><i class="ft-plus-circle" ></i> Nuevo</button>
            <button type="button" id="OCbtn_guardar" class="btn  bg-vino mr-1 mb-1"  ><i class="ft-save"></i> Grabar</button>
            <button type="button" id="OCbtn_buscar" class="btn  bg-vino mr-1 mb-1" ><i class="ft-search"></i> Buscar</button>
            <button type="button" id="OCbtn_imprimir" class="btn  bg-vino mr-1 mb-1"  ><i class="ft-printer"></i> Imprimir</button>
            <button type="button" id="OCbtn_limpiar" class="btn  bg-vino mr-1 mb-1"  ><i class="ft-airplay"></i> Limpiar</button>
            <button type="button" id="OCbtn_anular" class="btn  bg-vino mr-1 mb-1"  ><i class="ft-crosshair"></i> Anular</button>
            <button type="button" id="OCbtn_finalizar" class="btn  bg-vino mr-1 mb-1"  ><i class="ft-arrow-right-circle"></i> Finalizar</button>
        </div>
    </div>

</div>
<input type="hidden" id="OCvalor" value="1">
<input type="hidden" id="IdFilaOC" value="">

<div id="OCModal" class="modal fade" role="dialog" >

    <div class="modal-dialog modal-xl" >
        <div class="modal-content">
            <div class="modal-header">

                &nbsp; Ordenes de compras

            </div>
            <div class="modal-body">

                <table  width="100%" style="font-size:12px; font-weight:bold;">


                    <tr>

                        <td width="30%"><b>Sucursales</b>


                            <select id="OCbuscar-id_cmb_suc" class="form-control OCchosen-select" onchange="almacenxsucursal2()" style="width:95%" >
                                <option value="">Seleccione</option>
                                <?php foreach ($sucursales2 as $s) { ?>
                                    <option   value="<?= $s[0] ?>"><?= $s[1] ?></option>
                                <?php } ?>

                            </select>
                        </td>
                        <td width="30%"><b>Tipo</b>


                            <select id="OCbuscar-id_cmb_tipo" class="form-control OCchosen-select" onchange="almacenxsucursal2();" style="width:95%" >
                                <option value="">Seleccione</option>
                                <option   value="logística">Logística</option>
                                <option   value="farmacia">Farmacia</option>

                            </select>
                        </td>
                        <td width="20%"><b>Almacén</b>


                            <select id="OCbuscar-id_cmb_alm" class="form-control " onchange="" style="width:95%" >
                                <option value="">Seleccione</option>

                            </select>
                        </td>
                        <td width="10%"><b></b>



                        </td>


                    </tr>
                </table>
                <table  width="100%" style="font-size:12px; font-weight:bold;">
                    <tr>
                        <td  width="30%"><b>N° orden</b><input  type="text" id="OCbuscar-nro_orden"  class="form-control numero" value="" style="width:95%" 
                                                                autocomplete="off" ></td>
                        <td  width="30%"><b>Fecha</b><input  type="date" id="OCbuscar-fecha"  class="form-control" value="" style="width:95%" 
                                                             autocomplete="off" ></td>
                        <td width="20%"><b>Estado</b>
                            <select id="OCbuscar-estado" class="form-control OCchosen-select"  style="width:95%" >
                                <option value="">Seleccione</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="finalizada">Finalizado</option>
                                <option value="anulada">Anulado</option>

                            </select></td>

                        <td width="10%"><br><button type="button" class="btn bg-vino mr-1 mb-1" onClick="OCListarBuscar()" ><i class="ft-search"></i></button></td>    

                    </tr>
                </table>

                <br>

                <table id="IdTblOCbuscar" style="text-align:right;" border="1" bordercolor="#cccccc" >
                    <thead>
                        <tr style="font-size:13px">
                            <Th>N°</Th>
                            <Th>Sucursal</Th>
                            <Th>Fecha</Th>
                            <Th>Nro orden</Th>
                            <Th>Almacén</Th>
                            <Th>Estado</Th>

                        </tr>
                    </thead>
                    <tbody id="IdCuerpoOCbuscar" style="font-size:12px;">  </tbody>  
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" id="" class="btn bg-vino mr-1 mb-1" onClick="OCLlenarDatos()" > Aceptar</button>
                <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"  > Cancelar</button>									
            </div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function () {
        $("#OCid_cmb_suc").focus();
        $('#IdTblOCD').fixheadertable({
            colratio: [5, 5, 30, 20, 20, 20, 20],
            height: 200,
            width: '100%',
            zebra: true,
            sortable: false,
            sortedColId: 3,
            pager: false,
            rowsPerPage: 10,
            resizeCol: false,
        });

        $('#IdTblOCbuscar').fixheadertable({
            colratio: [5, 50, 20, 20, 20, 20],
            height: 200,
            width: '100%',
            zebra: true,
            sortable: false,
            sortedColId: 3,
            pager: false,
            rowsPerPage: 10,
            resizeCol: false,
        });


        /* $('.select2').select2({
         width: 'resolve', heigth: '50%' // need to override the changed default
         });*/

        $('.OCchosen-select').chosen({allow_single_deselect: true});
        $(this).find('.chosen-container').css({width: "95%"});

        $('.numero').on("keypress", function () {
            if (event.keyCode > 47 && event.keyCode < 60 || event.keyCode == 46) {

            } else {
                event.preventDefault();
            }

        });

    });


</script>


<script>
//DEZPLAZAR POR FORMULARIO
    $("#OCid_cmb_suc").change(function () {
        setTimeout(function () {
            $("#OCid_cmb_tipo").trigger('chosen:open');
        }, 200);

    });
    $("#OCid_cmb_tipo").change(function () {
        setTimeout(function () {
            $("#OCid_cmb_alm").trigger('chosen:open');
        }, 2000);


    });

    $("#OCid_cmb_alm").change(function () {
        $("#OCnro").focus();
    });
    $("#OCnro").keypress(function (e) {
        if (e.which == 13) {
            $("#OCfecha").focus();
        }
    });

    $("#OCfecha").keypress(function (e) {

        if (e.which == 13) {
            setTimeout(function () {
                $("#OCtipo_producto").trigger('chosen:open');
            }, 200);
        }

    });


    $("#OCtipo_producto").change(function () {
        $("#OCreferencia").focus();

    });
    $("#OCreferencia").keypress(function (e) {
        if (e.which == 13) {
            setTimeout(function () {
                $("#OCid_cmb_pro").trigger('chosen:open');
            }, 200);
        }

    });
    $("#OCid_cmb_pro").change(function () {

        $("#OCcantidad").focus();
    });
    $("#OCcantidad").keypress(function (e) {

        if (e.which == 13) {
            $("#OCunidad").focus();
        }
    });
    $("#OCunidad").keypress(function (e) {
        if (e.which == 13) {
            OCAñadirDetalle();
        }
    });

    //BOTONES
    $("#OCbtn_nuevo").click(function () {

        $.blockUI({css: {backgroundColor: '#AD1158', color: '#FDFDFD'}, message: '<h1>Espere...</h1>'});
        setTimeout($.unblockUI, 2000);
    });
    $("#OCbtn_guardar").click(function () {
        OCguardar();

    });
    $("#OCbtn_buscar").click(function () {
        OCListarBuscar();
        $("#OCbtn_nuevo").attr("disabled", "true");
        $("#OCbtn_limpiar").attr("disabled", "true");
        $("#OCModal").modal();
    });
    $("#OCbtn_imprimir").click(function () {

    });
    $("#OCbtn_limpiar").click(function () {
        $("#id_OC,#OCreferencia,#OCfecha,#OCnro,#OCcantidad,#OCunidad,#OCid_cmb_alm").val("");
        setTimeout(function () {
            $("#OCid_cmb_suc,#OCid_cmb_pro,#OCid_cmb_tipo,#OCtipo_producto,#OCid_cmb_alm").val("").trigger('chosen:updated');

        }, 200);

        orden_compra = new Array();
        OClistar();

    });
    $("#OCbtn_anular").click(function () {

        var $ident = $("#IdFilaOC").val();
        if ($ident == 0) {
            swal("Debe seleccionar un Registro", "Obligatorio", "warning");
            return false;
        }

        $.post("controlador/Clogistica.php", {accion: "ESTADO_ORD_COM", estado: "anulada", id: $("#id_OC").val()}, function (data) {
            if (data == 1) {
                swal("Correcto", "Orden anulada", "success");
            } else {
                swal("Error", "No se pudo anular la orden", "error");
            }
        });



    });
    $("#OCbtn_finalizar").click(function () {
        var $ident = $("#IdFilaOC").val();
        if ($ident == 0) {
            swal("Debe seleccionar un Registro", "Obligatorio", "warning");
            return false;
        }

        $.post("controlador/Clogistica.php", {accion: "ESTADO_ORD_COM", estado: "finalizada", id: $("#id_OC").val()}, function (data) {
            if (data == 1) {
                swal("Correcto", "Orden finalizada", "success");
            } else {
                swal("Error", "No se pudo anular la orden", "error");
            }
        });

    });
    
    
    //DETALLE ORDEN DE COMPRA
    var orden_compra = new Array();
    function OClistar() {
        $("#IdCuerpoOCD").html("");
        for (var i = 0; i < orden_compra.length; i++) {

            $("#IdCuerpoOCD").append("<tr><td class='text-left'><a class='btn text-left' onclick='OCeliminar(" + i + ")'>\n\
            <icon class='ft-trash'> </icon></a></td><td>" + parseInt(i + 1) + "</td>\n\
            <td style='text-align:left;'>" + orden_compra[i].nombre_producto + "</td>\n\
            <td style='text-align:left;'> " + orden_compra[i].cantidad + "</td>\n\
            <td> " + orden_compra[i].unidad + "</td><td> " + orden_compra[i].despachado + "</td><td> " + orden_compra[i].pendiente + "</td>");
            console.log(orden_compra[i]);
        }
    }

    function OCAñadirDetalle() {


        if ($("#OCid_cmb_pro").val() == "") {
            swal("Campo requerido", "Seleccione un producto", "warning");
            setTimeout(function () {
                $("#OCid_cmb_pro").trigger('chosen:open');
            }, 200);
            return false;
        }

        if ($("#OCcantidad").val() == "") {
            swal("Campo requerido", "Inserte una cantidad", "warning");
            $("#OCcantidad").focus();
            return false;
        }

        if ($("#OCunidad").val() == "") {
            swal("Campo requerido", "Inserte una unidad", "warning");
            $("#OCunidad").focus();
            return false;
        }

        var id_producto = $("#OCid_cmb_pro").val();
        var seleccionado = $("#OCid_cmb_pro").val();
        var nombre_producto = $("#OCpro_" + seleccionado).attr("nombre_producto");
        var cantidad = $("#OCcantidad").val();
        var unidad = $("#OCunidad").val();


        for (var i = 0; i < orden_compra.length; i++) {

            if (orden_compra[i].id_producto == id_producto) {
                orden_compra[i].cantidad = parseInt(orden_compra[i].cantidad) + parseInt(cantidad);
                OClistar();

                $("#OCcantidad").val("");
                $("#OCunidad").val("");

                setTimeout(function () {
                    $("#OCid_cmb_pro").val("").trigger('chosen:updated');

                    $("#OCid_cmb_pro").trigger('chosen:open');
                }, 300);
                return false;
            }
        }

        var detalle = {id_producto: id_producto, nombre_producto: nombre_producto, cantidad: cantidad, unidad: unidad, despachado: "0", pendiente: "0"};
        orden_compra.push(detalle);
        OClistar();
        $("#OCcantidad").val("");
        $("#OCunidad").val("");
        setTimeout(function () {
            $("#OCid_cmb_pro").val("").trigger('chosen:updated');

            $("#OCid_cmb_pro").trigger('chosen:open');
        }, 300);
    }

    function OCeliminar(id) {

        orden_compra.splice(id, 1);
        OClistar();
    }

// FUNCIONES DEL FORMULARIO
    function OCproductos() {
        $('#OCid_cmb_pro').chosen('destroy');
        if ($("#OCid_cmb_tipo").val() == "logística") {

            $.post("controlador/Clogistica.php", {accion: "LISTAR_PRO_OC"}, function (data) {
                $("#OCid_cmb_pro").html(data);
//                console.log(data);
                setTimeout(function () {
                    $(document).find('#OCid_cmb_pro').chosen({allow_single_deselect: true});
                    $(document).find('.chosen-container').css({width: "95%"});

                }, 500);

            }
            );
        }
        if ($("#OCid_cmb_tipo").val() == "farmacia") {

            $.post("controlador/Cfarmacia.php", {accion: "LISTAR_PRO_OC"}, function (data) {

                $("#OCid_cmb_pro").html(data);
//                $("#OCid_cmb_pro").removeAttr('style');
//                console.log(data);
                setTimeout(function () {
                    $(document).find('#OCid_cmb_pro').chosen({allow_single_deselect: true});
                    $(document).find('.chosen-container').css({width: "95%"});

                }, 500);

            });

        }
    }

    function almacenxsucursal() {
        $("#OCid_cmb_alm").html("");
        $('#OCid_cmb_alm').chosen('destroy');
        $.post("controlador/Clogistica.php", {accion: "LISTAR_ALMxSUC", sucursal: $("#OCid_cmb_suc").val(), tipo: $("#OCid_cmb_tipo").val()}, function (data) {

            $("#OCid_cmb_alm").html(data);
            console.log(data);
            setTimeout(function () {
                    $(document).find('#OCid_cmb_alm').chosen({allow_single_deselect: true});
                    $(document).find('.chosen-container').css({width: "95%"});

                }, 500);
        });
    }
    
    
    function OCguardar() {

        if (orden_compra.length == 0) {
            swal("Vacío", "Inserte datos", "warning");
            return false;
        }
        if ($("#OCid_cmb_suc").val() == "") {
            swal("Campo requerido", "Seleccione una sucursal", "warning");
            setTimeout(function () {
                $("#OCid_cmb_suc").trigger('chosen:open');
            }, 200);
            return false;
        }
        if ($("#OCid_cmb_tipo").val() == "") {
            swal("Campo requerido", "Seleccione un tipo de orden", "warning");
            setTimeout(function () {
                $("#OCtipo").trigger('chosen:open');
            }, 200);
            return false;
        }
        if ($("#OCtipo_producto").val() == "") {
            swal("Campo requerido", "Seleccione un tipo de producto", "warning");
            setTimeout(function () {
                $("#OCtipo_producto").trigger('chosen:open');
            }, 200);
            return false;
        }
        if ($("#OCid_cmb_alm").val() == "") {
            swal("Campo requerido", "Seleccione un almacén", "warning");
            setTimeout(function () {
                $("#OCid_cmb_alm").trigger('chosen:open');
            }, 200);
            return false;
        }

        if ($("#OCfecha").val() == "") {
            swal("Campo requerido", "Inserte fecha", "warning");
            $("#OCfecha").focus();
            return false;
        }

        if ($("#OCnro").val() == "") {
            swal("Campo requerido", "Inserte fecha", "warning");
            $("#OCnro").focus();
            return false;
        }



        $.post("controlador/Clogistica.php", {

            accion: "NUEVO_ORD_COM",
            orden_compra: JSON.stringify(orden_compra),
            fecha: $("#OCfecha").val(),
            id: $("#id_OC").val(),
            referencia: $("#OCreferencia").val(),
            tipo: $("#OCid_cmb_tipo").val(),
            tipo_producto: $("#OCtipo_producto").val(),
            nro: $("#OCnro").val(),
            almacen: $("#OCid_cmb_alm").val(),
            sucursal: $("#OCid_cmb_suc").val(),
            valor: $("#OCvalor").val()

        }, function (data) {

            if (data == 1) {
                swal("Correcto", "Orden registrada correctamente", "success");
            } else {
                swal("Error", "Orden no registrada ", "error");
            }
            cancelar();
            $("#OCbtn_nuevo").removeAttr("disabled");
            $("#OCbtn_limpiar").removeAttr("disabled");
            console.log(data);
        });
    }


    function OCcancelar() {
        orden_compra = new Array();
        $("#OCnro").val("");
        $("#OCreferencia").val("");
        $("#OCfecha").val("");
        $("#OCid_cmb_alm").val("");
        setTimeout(function () {
            $("#OCid_cmb_alm").val("").trigger('chosen:updated');
        }, 200);
        setTimeout(function () {
            $("#OCid_cmb_pro").val("").trigger('chosen:updated');
        }, 200);
        setTimeout(function () {
            $("#OCid_cmb_tipo").val("").trigger('chosen:updated');
        }, 200);
        setTimeout(function () {
            $("#OCid_cmb_suc").val("").trigger('chosen:updated');
        }, 200);
        setTimeout(function () {
            $("#OCtipo_producto").val("").trigger('chosen:updated');
        }, 200);
        $("#OCcantidad").val("");
        $("#OCunidad").val("");

        OClistar();
    }

    function PintarFilaOC($id) {
        var $idfilaanterior = $("#IdFilaOC").val()

        var $par = $idfilaanterior.split('_')
        var $par_int = parseInt($par[1]);
        // alert($par_int)
        if ($par_int % 2 == 0) {
            // alert("hola")
            $("#" + $idfilaanterior).css({
                "background-color": "#f5f5f5",
                "color": "#000000"
            });
        } else {
            $("#" + $idfilaanterior).css({
                "background-color": "#FFFFFF",
                "color": "#000000"
            });
        }
        //alert($id);alert($idfilaanterior)
        $("#" + $id).css({
            "background-color": "#900052",
            "color": "#FFFFFF"
        });
        $("#IdFilaOC").val($id);

    }



//FUNCIONES MODAL
    function OCListarBuscar() {
        var $fecha = $("#OCbuscar-fecha").val();
        var $estado = $("#OCbuscar-estado").val();
        var $nro = $("#OCbuscar-nro_orden").val();
        var $almacen = $("#OCbuscar-id_cmb_alm").val();
        $.post('controlador/Clogistica.php', {accion: "LIS_ORD_COM", fecha: $fecha, estado: $estado, nro: $nro, almacen: $almacen},
                function (data) {
                    $("#IdCuerpoOCbuscar").html(data);
                    $("#IdFilaOC").val(0);
                });
    }

    function almacenxsucursal2() {
        $("#OCbuscar-id_cmb_alm").html("");
        $("#OCbuscar-id_cmb_alm").chosen('destroy');
        $.post("controlador/Clogistica.php", {accion: "LISTAR_ALMxSUC", sucursal: $("#OCbuscar-id_cmb_suc").val(), tipo: $("#OCbuscar-id_cmb_tipo").val()}, function (data) {

            $("#OCbuscar-id_cmb_alm").html(data);
            console.log(data);
             setTimeout(function () {
                    $(document).find('#OCbuscar-id_cmb_alm').chosen({allow_single_deselect: true});
                    $(document).find('.chosen-container').css({width: "95%"});

                }, 500);
        });
    }

    function OCLlenarDatos() {
        $("#OCvalor").val(2);
        var $ident = $("#IdFilaOC").val();
        var $id = $("#" + $ident).attr("idOC");
        if ($ident == 0) {
            swal("Debe seleccionar un Registro", "Obligatorio", "warning");
            return false;
        }
        $.post("controlador/Clogistica.php", {accion: 'LLENAR_ORD_COM', id: $id}, function (data) {
            console.log(data);
            $.blockUI({css: {backgroundColor: '#AD1158', color: '#FDFDFD'}, message: '<h1>Espere...</h1>'});
            setTimeout($.unblockUI, 1000);
            $("#OCvalor").val("2");
            $("#id_OC").val(data.id);
            $("#OCnro").val(data.numero);
            $("#OCfecha").val(data.fecha);
            $("#OCreferencia").val(data.referencia);
            $("#OCid_cmb_suc").val(data.id_sucursal).trigger("chosen:updated");
            $("#OCid_cmb_tipo").val(data.tipo).trigger("chosen:updated");
            $("#OCtipo_producto").val(data.tipo_producto).trigger("chosen:updated");
            almacenxsucursal();
            setTimeout(function () {

                $("#OCid_cmb_alm").val(data.id_almacen).trigger("chosen:updated");
            }, 1000);
            $.post("controlador/Clogistica.php", {accion: 'LLENAR_ORD_COM_DET', id: data.id}, function (detalles) {
                orden_compra = new Array();

                for (var i = 0; i < detalles.length; i++) {
                    orden_compra_detalle = {id_producto: detalles[i].id_producto, nombre_producto: detalles[i].nombre,
                        cantidad: detalles[i].cantidad, unidad: detalles[i].unidad, despachado: detalles[i].despachado,
                        pendiente: detalles[i].pendiente};
                    orden_compra.push(orden_compra_detalle);

                }

                OClistar();

                console.log(orden_compra);
            }, 'JSON');

        }, 'JSON');

        $("#OCModal").modal("hide");
    }



</script>