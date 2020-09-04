<link rel="stylesheet" type="text/css" href="assets/css/select2.min.css" />
<script src="assets/js/select2.full.min.js" type="text/javascript"></script>
<?php
include 'cado/ClaseFarmacia.php';

$ofarmacia = new Farmacia();
$productos = $ofarmacia->ListarProducto("");
$proveedores = $ofarmacia->Listarproveedor("");
session_start();
?>
<div class="modal-body">

    <table width="100%" style="font-size:12px; font-weight:bold;">
        <tr style='display:none'>
            <td><b>Id</b>
                <input name="id_com" type="text" id="id_com" size="5" readonly="readonly" class="form-control" />
            </td>

        </tr>

        <tr>
            <td width="15%">
                <label for="afecto"><b>Afecto</b></label>

                <input type="radio" id="afecto" name="tipo_afectacion" onclick="ClickAfecto()" class=" formulario" value="1" onchange="llenarIGV()">
                <label for="inafecto"><b>Inafecto</b></label>
                <input type="radio" id="inafecto" onclick="ClickInafecto()" name="tipo_afectacion" class=" formulario" value="2" onchange="llenarIGV()">
            </td>

            <td width="60%"><b>Proveedor</b>


                <select id="id_cmb_prov" class="form-control ECchosen-select" onchange="ChangeProv()" style="width:95%">
                    <option value="">Seleccione</option>
                    <?php foreach ($proveedores as $p) { ?>
                        <option value="<?= $p[0] ?>"><?= $p[1] ?></option>
                    <?php } ?>

                </select>
            </td>

            <td width="25%">
                <br>
                <button type="button" id="" style="width:85%" class="btn btn-xs bg-vino " onClick="AbrirModalOrdenCompra()"><i class='ft-plus-circle'></i> Orden de compra</button>
            <td>



        </tr>
    </table>
    <br>
    <table style="font-size:12px; font-weight:bold;">
        <tr>

            <td width="10%"><b>Tipo de doc.</b>
                <select id="tipo_documento" class="form-control ECchosen-select" onchange="ChangeTipoDoc()" style="width:95%">
                    <option value="">Seleccione</option>
                    <option value="FA">FA</option>
                    <option value="BV">BV</option>
                    <option value="FA">FA</option>
                    <option value="DI">DI</option>
                    <option value="GR">GR</option>
                </select></td>
            <td width="15%"><b>N° de doc.</b>
                <input type="text" id="nro_documento" style="text-transform:uppercase;width:95%" class="form-control numero" value="" autocomplete="off"></td>
            <td width="10%"><b>Fecha</b><input type="date" id="fecha" class="form-control" value="" style="width:95%" autocomplete="off"></td>

            <td width="10%"><b>Tipo de compra</b>
                <select id="tipo_compra" class="form-control ECchosen-select" onchange="ChangeTipoCompra()" style="width:95%">
                    <option value="">Seleccione</option>
                    <option value="Contado">Contado</option>
                    <option value="Crédito">Crédito</option>

                </select></td>
            <td width="8%"><b>N° de dias</b>
                <input type="number" id="nro_dias" value="0" style="text-transform:uppercase;width:95%" class="form-control numero" value="" autocomplete="off"></td>
            <td width="15%">
                <b>Factura afecta a IGV</b>

                <input type="checkbox" id="igv_detalle" class="" onclick="listar(); ClickIGV()">

            </td>
            <td with="62%"></td>

        </tr>

    </table>
    <hr>
    <table width="100%" class="" style="font-size:12px; font-weight:bold;">


        <tr>
            <td width="100%"><b>Producto</b><br>
                <select id="id_cmb_pro" class="form-control ECchosen-select" onchange="ChangeProducto()" style="width: 100%">
                    <option value="">Seleccione producto</option>
                    <?php foreach ($productos as $p) { ?>
                        <option id='<?= "pro_" . $p[0] ?>' nombre_producto='<?= $p[2] ?>' value="<?= $p[0] ?>"><?= $p[2] . " - " . $p[7] ?></option>
                    <?php } ?>
                </select>
            </td>







        </tr>
    </table>
    <br>
    <table style="font-size:12px; font-weight:bold;">
        <tr>

            <td width="15%"><b>Precio (S/.)</b>
                <input type="text" id="precio" style="width:95%" class="form-control numero" value="" autocomplete="off"></td>
            <!--<td width="10%"><b>Unidad</b>
                <select id='unidad' class="ECchosen-select form-control" onchange="ChangeBonificacion()">
                    <option value="0">Caja</option>
                    <option value="1">Unidad</option>
                </select>
            </td>-->
            <td width="10%"><b>Cantidad</b>
                <input type="number" id="cantidad" style="width:95%" class="form-control numero" value="" autocomplete="off"></td>
            <td width="15%"><b>Precio anterior(S/.)</b>
                <input type="text" id="precio_anterior" disabled="" value="0.00" style="width:95%" class="form-control numero" autocomplete="off"></td>
            <td width="15%"><b>Vencimiento</b>
                <input type="date" id="fecha_vencimiento" style="width:95%" class="form-control" value="" autocomplete="off"></td>

            <td width="15%"><b>N° lote</b>
                <input type="text" id="nro_lote" style="width:95%" class="form-control numero" autocomplete="off"></td>
            <td width="15%"><b>Bonificación</b>
                <select id='bonificacion' class="ECchosen-select form-control" onclick="ChangeBonificacion" onchange="ChangeBonificacion()">
                    <option value="">Seleccione</option>
                    <option value="0">No</option>
                    <option value="1">Si</option>
                </select>
            </td>
            <td width="5%">
                <br>
                <button type="button" id="BtnGrabarSerie" style="width:95%" class="btn btn-xs bg-vino " onClick="AñadirDetalle()"><i class='ft-plus'></i></button>
            <td>
        </tr>




    </table>


</div>
<div class="row">
    <div class="col-12 pl-2">
        <table id="IdTblCD" style="text-align:right;" border="1" bordercolor="#cccccc">
            <thead>
                <tr style="font-size:13px">
                    <Th></Th>
                    <Th>N°</Th>
                    <Th>Producto</Th>
                    <Th>Vencimiento</Th>
                    <Th>N° lote</Th>
                    <Th>Prec. ant.</Th>

                    <Th>Cant.</Th>
                    <Th>Prec. sin igv</Th>
                    <Th>Monto IGV</Th>
                    <Th>Subotal</Th>
                    <Th>Bon.</Th>

                </tr>
            </thead>
            <tbody id="IdCuerpoCD" style="font-size:12px;"> </tbody>
        </table>
    </div>

</div>
<br>
<div class="row">

    <div class="col-lg-8 col-md-12 ">
        <table width="100%" style="font-size:12px; font-weight:bold;">

            <tr>
                <td><b>Monto sin IGV(S/.)</b><input id="monto_sin_igv" disabled="" style="font-size:12px; text-align:right;width:95%" class="form-control" autocomplete="off"></td>
                <td colspan=""><b>Monto IGV(S/.)</b><input disabled="" id="monto_igv_total" style="font-size:12px;text-align:right;  width:95%" class="form-control" autocomplete="off"></td>
                <td colspan=""><b>IGV</b><input disabled="" id="igv" style="font-size:12px;text-align:right;  width:95%" class="form-control" autocomplete="off"></td>

                <td colspan=""><b>Total(S/.)</b><input disabled="" id="total" style="font-size:12px;text-align:right;  width:95%" class="form-control" autocomplete="off"></td>

            </tr>


        </table>
    </div>

    <div class="col-lg-4 col-md-12 ">
        <div class="form-group">
            <br>
            <button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="guardar()"><i class="ft-save"></i> Guardar</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="cancelar()"><i class="fa fa-crosshairs"></i>Cancelar</button>
        </div>
    </div>

</div>

<div id="ECModalOrdenCompra" class="modal fade" role="dialog">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                &nbsp; <h4>Ordenes de compras</h4>

            </div>
            <div class="modal-body">


                <table width="100%" style="font-size:12px; font-weight:bold;">
                    <tr>
                        <td width="100%"><b>N° orden</b><input style='width: 10%' type="text" id="ECbuscar-nro_orden" class="form-control numero" value="" style="width:95%" autocomplete="off"></td>



                    </tr>
                </table>

                <br>
                <div class='row'>
                    <div class='col-lg-6'>
                        <table id="IdTblECbuscar" style="text-align:right;" border="1" bordercolor="#cccccc">
                            <h4>Ordenes pendientes</h4>
                            <thead>
                                <tr style="font-size:13px">
                                    <Th>N°</Th>
                                    <Th>Nro orden</Th>
                                    <Th>Fecha</Th>
                                </tr>
                            </thead>
                            <tbody id="IdCuerpoECbuscar" style="font-size:12px;"> </tbody>
                        </table>
                    </div>
                    <div class='col-lg-6'>
                        <h4>Detalles</h4>
                        <table id="IdTblECbuscardetalle" style="text-align:right;" border="1" bordercolor="#cccccc">
                            <thead>
                                <tr style="font-size:13px">
                                    <Th>N°</Th>
                                    <Th>Producto</Th>
                                    <Th>Cantidad</Th>
                                    <Th>Unidad</Th>
                                    <Th>Despachado</Th>
                                    <Th>Pendiente</Th>


                                </tr>
                            </thead>
                            <tbody id="IdCuerpoECbuscardetalle" style="font-size:12px;"> </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="" class="btn bg-vino mr-1 mb-1" onClick="OCLlenarDatos()"> Aceptar</button>
                <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"> Cancelar</button>
            </div>
        </div>
    </div>
</div>




<input type="hidden" id="IdFilaECOC" value="0">

<script>
    $(document).ready(function() {
        $("#afecto").focus();
        $('#IdTblCD').fixheadertable({
            colratio: [5, 5, 27, 13, 10, 10, 8, 12, 12, 12, 5],
            height: 200,
            width: '100%',
            zebra: true,
            sortable: false,
            sortedColId: 3,
            pager: false,
            rowsPerPage: 10,
            resizeCol: false,
        });
        $('#IdTblECbuscar').fixheadertable({
            colratio: [10, 20, 20],
            height: 200,
            width: '100%',
            zebra: true,
            sortable: false,
            sortedColId: 3,
            pager: false,
            rowsPerPage: 10,
            resizeCol: false,
        });
        $('#IdTblECbuscardetalle').fixheadertable({
            colratio: [5, 20, 20, 20, 20, 20],
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

        $('.ECchosen-select').chosen({
            allow_single_deselect: true
        });
        $(this).find('.chosen-container').css({
            width: "95%"
        });
        $('.numero').on("keypress", function() {
            if (event.keyCode > 47 && event.keyCode < 60 || event.keyCode == 46) {

            } else {
                event.preventDefault();
            }

        });
        $("#monto_igv_total").val("0.00");
        $("#monto_sin_igv").val("0.00");
        $("#total").val("0.00");
        $("#igv").val("0.00");
    });
</script>


<script>
    //DETALLE_COMPRA
    var compra = new Array();

    function AbrirModalOrdenCompra() {
        ECBuscarOrden();
        $("#ECModalOrdenCompra").modal();
    }

    function ECLlenarOrdenDetalle($id) {
        var $id_orden = $("#" + $id).attr("idECOC");

        $.post("controlador/Clogistica.php", {
                accion: 'LLENAR_ORD_COM_DET',
                id: $id_orden
            },
            function(detalles) {
                console.log(detalles);
                for (var i = 0; i < detalles.length; i++) {

                    $("#IdCuerpoECbuscardetalle").append("<tr><td>" + parseInt(i + 1) + "</td><td>" + detalles[i].nombre + "</td><td>" +
                        detalles[i].cantidad + "</td><td>" + detalles[i].unidad + "</td><td>" +
                        detalles[i].despachado + "</td><td>" + detalles[i].pendiente + "</td></tr>");

                }

            }, 'JSON');
    }




    function ECBuscarOrden() {
        $("#IdCuerpoECbuscardetalle").html("");
        var $nro = $("#ECbuscar-nro_orden").val();
        $.post('controlador/Clogistica.php', {
                accion: "LIS_ORD_COMxnro",
                nro: $nro
            },
            function(data) {
                $("#IdCuerpoECbuscar").html(data);
                $("#IdFilaEC").val(0);
                $("#ECbuscar-nro_orden").val("");
            });
    }

    $("#ECbuscar-nro_orden").keypress(function(e) {
        if (e.which == 13) {
            ECBuscarOrden();
        }

    });


    function PintarFilaECOC($id) {
        var $idfilaanterior = $("#IdFilaECOC").val()

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

        $("#" + $id).css({
            "background-color": "#900052",
            "color": "#FFFFFF"
        });
        $("#IdFilaECOC").val($id);
        ECLlenarOrdenDetalle($id);
    }



    function AbrirModalDetalle() {
        $("#IdModalDetalle").modal();
    }

    function llenarIGV() {
        if ($('input:radio[name=tipo_afectacion]:checked').val() == "1") {
            $("#igv").val("0.18");
            $('input:radio[name=tipo_afectacion]:checked').val()
        };
        if ($('input:radio[name=tipo_afectacion]:checked').val() == "2") {
            $("#igv").val("0.00");
        };
        listar()

    }

    function listar() {
        $("#IdCuerpoCD").html("");
        console.log("");
        var stotal = 0;
        for (var i = 0; i < compra.length; i++) {
            if (compra[i].bonificacion == '0') {
                bonificacion = "<input type='checkbox' disabled readonly>";
            } else {
                bonificacion = "<input type='checkbox' checked disabled readonly>";
            }

            //Calculo del IGV
            //.toFixed(2) RECORTA A DOS DECIMALES SIN REDONDEAR INCLUIDO ENTEROS .00
            if ($("#igv_detalle").prop("checked")) {
                compra[i].precio_sin_igv = (Math.round((compra[i].precio * (100 / 118)) * 100) / 100).toFixed(2);
                compra[i].monto_igv = (Math.round(compra[i].precio * (18 / 118) * 100) / 100).toFixed(2);
                compra[i].subtotal = (Math.round((compra[i].precio_sin_igv * compra[i].cantidad) * 100) / 100).toFixed(2);
            } else {
                compra[i].precio_sin_igv = (compra[i].precio).toFixed(2);
                compra[i].monto_igv = (Math.round(compra[i].precio * (0.18) * 100) / 100).toFixed(2);
                compra[i].subtotal = (Math.round((parseFloat(compra[i].precio_sin_igv * compra[i].cantidad)) * 100) / 100).toFixed(2);
            }

            if (compra[i].bonificacion == '0') {
                stotal += parseFloat(compra[i].subtotal);
            } else {
                compra[i].subtotal = "0.00"
            }
            $("#IdCuerpoCD").append("<tr><td class='text-left'><a class='btn text-left' onclick='eliminar(" + i + ")'>\n\
            <icon class='ft-trash'> </icon></a></td><td>" + parseInt(i + 1) + "</td>\n\
            <td style='text-align:left;'>" + compra[i].nombre_producto + "</td><td style='text-align:left;'> " + compra[i].fecha_vencimiento + "</td>\n\
            <td style='text-align:left;'> " + compra[i].nro_lote + "</td><td>S/. " + compra[i].precio_anterior + "</td>\n\
            <td> " + compra[i].cantidad + "</td><td>S/. " + compra[i].precio_sin_igv + "</td>\n\
            <td>S/. " + compra[i].monto_igv + "</td><td>S/. " + compra[i].subtotal + "</td>\n\
            <td> " + bonificacion + "</td></tr>");
            console.log(compra[i]);
        }

        $("#monto_sin_igv").val((Math.round(stotal * 100) / 100).toFixed(2));
        monto_sin_igv = $("#monto_sin_igv").val();
        igv = $("#igv").val();
        $("#monto_igv_total").val((Math.round((monto_sin_igv * igv) * 100) / 100).toFixed(2));
        monto_igv_total = $("#monto_igv_total").val();
        total = (Math.round((parseFloat(monto_igv_total) + parseFloat(monto_sin_igv)) * 100) / 100).toFixed(2);
        $("#total").val(total);
    }


    function AñadirDetalle() {


        if ($("#id_cmb_pro").val() == "") {
            swal("Campo requerido", "Seleccione un producto", "warning");
            $("#id_cmb_pro").focus();
            return false;
        }

        if ($("#fecha_vencimiento").val() == "") {
            swal("Campo requerido", "Inserte una fecha", "warning");
            $("#fecha_vencimiento").focus();
            return false;
        }
        if ($("#cantidad").val() == "") {
            swal("Campo requerido", "Inserte una cantidad", "warning");
            $("#cantidad").focus();
            return false;
        }
        if ($("#precio").val() == "") {
            swal("Campo requerido", "Inserte un precio", "warning");
            $("#precio").focus();
            return false;
        }
        if ($("#bonificacion").val() == "") {
            swal("Campo requerido", "Seleccione bonificación", "warning");
            $("#bonificacion").focus();
            return false;
        }

        var id_producto = $("#id_cmb_pro").val();
        var seleccionado = $("#id_cmb_pro").val();
        var nombre_producto = $("#pro_" + seleccionado).attr("nombre_producto");
        var cantidad = $("#cantidad").val();
        var precio = Math.round(parseFloat($("#precio").val()) * 100) / 100;
        var fecha_vencimiento = $("#fecha_vencimiento").val();
        var nro_lote = $("#nro_lote").val();
        var precio_anterior = $("#precio_anterior").val();
        var bonificacion = $("#bonificacion").val();
        precio_sin_igv = "";
        monto_igv = "";
        subtotal = "";
        var detalle = {
            id_producto: id_producto,
            nombre_producto: nombre_producto,
            cantidad: cantidad,
            precio: precio,
            precio_sin_igv: precio_sin_igv,
            monto_igv: monto_igv,
            subtotal: subtotal,
            fecha_vencimiento: fecha_vencimiento,
            bonificacion: bonificacion,
            precio_anterior: precio_anterior,
            nro_lote: nro_lote
        };
        compra.push(detalle);
        listar();
        //
        $("#nro_lote").val("");
        $("#cantidad").val("");
        $("#precio").val("");
        //        $("#precio_anterior").val("0.00");
        $("#fecha_vencimiento").val("");
        setTimeout(function() {
            $("#bonificacion").val("").trigger('chosen:updated');
        }, 200);
        setTimeout(function() {
            $("#id_cmb_pro").val("").trigger('chosen:updated');
        }, 200);
        setTimeout(function() {
            $("#id_cmb_pro").trigger('chosen:open');
        }, 200);
    }


    function eliminar(id) {

        compra.splice(id, 1);
        listar();
    }

    function guardar() {

        if (compra.length == 0) {
            swal("Vacío", "Inserte datos", "warning");
            return false;
        }
        if ($("#fecha").val() == "") {
            swal("Campo requerido", "Inserte fecha", "warning");
            $("#fecha").focus();
            return false;
        }
        if ($("#proveedor").val() == "") {
            swal("Campo requerido", "Seleccione un proveedor", "warning");
            $("#proveedor").focus();
            return false;
        }
        if ($("#tipo_documento").val() == "") {
            swal("Campo requerido", "Seleccione un tipo de documento", "warning");
            $("#tipo_documento").focus();
            return false;
        }
        if ($("#nro_documento").val() == "") {
            swal("Campo requerido", "Inserte número de documento", "warning");
            $("#nro_documento").focus();
            return false;
        }
        if ($("#tipo_compra").val() == "") {
            swal("Campo requerido", "Seleccione un tipo de compra", "warning");
            $("#tipo_compra").focus();
            return false;
        }
        if ($("#nro_dias").val() == "") {
            swal("Campo requerido", "Inserte número de dias", "warning");
            $("#nro_dias").focus();
            return false;
        }

        $.post("controlador/Cfarmacia.php", {

            accion: "NUEVO_COM",
            compra: JSON.stringify(compra),
            proveedor: $("#id_cmb_prov").val(),
            fecha: $("#fecha").val(),
            tipo_documento: $("#tipo_documento").val(),
            nro_documento: $("#nro_documento").val(),
            tipo_afectacion: $("input:radio[name=tipo_afectacion]:checked").val(),
            nota_credito: "0",
            tipo_compra: $("#tipo_compra").val(),
            nro_dias: $("#nro_dias").val(),
            monto_igv: $("#monto_igv_total").val(),
            igv: $("#igv").val(),
            monto_sin_igv: $("#monto_sin_igv").val(),
            total: $("#total").val()
        }, function(data) {

            if (data.indexOf("OK") > -1) {
                swal("Correcto", "Compra registrada correctamente", "success");
            } else {
                swal("Error", "Compra no registrada ", "error");
            }
            cancelar();
            console.log(data);
        });
    }


    function cancelar() {
        compra = new Array();
        $("#monto_igv_total").val("0.00");
        $("#nro_documento").val("");
        $("#nro_dias").val("");
        $("#nro_lote").val("");
        $("#cantidad").val("");
        $("#precio_anterior").val("");
        $("#monto_sin_igv").val("0.00");
        $("#total").val("0.00");
        $("#fecha").val("");
        $("#fecha_vencimiento").val("");
        //        $("#igv").val("");
        setTimeout(function() {
            $("#id_cmb_pro").val("").trigger('chosen:updated');
        }, 200);
        setTimeout(function() {
            $("#id_cmb_prov").val("").trigger('chosen:updated');
        }, 200);
        setTimeout(function() {
            $("#tipo_documento").val("").trigger('chosen:updated');
        }, 200);
        setTimeout(function() {
            $("#tipo_compra").val("").trigger('chosen:updated');
        }, 200);
        setTimeout(function() {
            $("#bonificacion").val("").trigger('chosen:updated');
        }, 200);
        listar();
    }



    $("#fecha").keypress(function(e) {
        if (e.which == 13) {


            setTimeout(function() {
                $("#tipo_compra").trigger('chosen:open');
            }, 200);
        }
    });

    function ChangeProv() {
        setTimeout(function() {
            $("#tipo_documento").trigger('chosen:open');
        }, 200);
    }



    function ChangeTipoDoc() {
        $("#nro_documento").focus();
    }

    $("#nro_documento").keypress(function(e) {
        if (e.which == 13) {
            $("#fecha").focus();
        }
    });

    function ClickAfecto() {
        setTimeout(function() {
            $("#id_cmb_prov").trigger('chosen:open');
        }, 200);
    }

    function ClickInafecto() {
        setTimeout(function() {
            $("#id_cmb_prov").trigger('chosen:open');
        }, 200);
    }

    function ChangeTipoCompra() {

        $("#nro_dias").focus();
    }


    $("#nro_dias").keypress(function(e) {
        if (e.which == 13) {

            setTimeout(function() {
                $("#id_cmb_pro").trigger('chosen:open');
            }, 200);
        }
    })

    function ClickIGV() {
        setTimeout(function() {
            $("#id_cmb_pro").trigger('chosen:open');
        }, 200);
    }

    function ChangeProducto() {

        $.post("controlador/Cfarmacia.php", {
            accion: "PRECIO_COMPRA_ULTIMO",
            id: $("#id_cmb_pro").val()
        }, function(data) {
            if (!data.precio_sin_igv) {
                $("#precio_anterior").val("0.00");
            } else {
                $("#precio_anterior").val(data.precio_sin_igv);
            }

            console.log(data);
        }, "JSON").fail(function() {
            $("#precio_anterior").val("0.00");
        });
        $("#precio").focus();
    }

    $("#precio").keypress(function(e) {
        if (e.which == 13) {
            $("#cantidad").focus();
        }
    })
    $("#cantidad").keypress(function(e) {
        if (e.which == 13) {
            $("#fecha_vencimiento").focus();
        }
    })
    $("#fecha_vencimiento").keypress(function(e) {
        if (e.which == 13) {
            $("#nro_lote").focus();
        }
    })

    $("#nro_lote").keypress(function(e) {
        if (e.which == 13) {
            setTimeout(function() {
                $("#bonificacion").trigger('chosen:open');
            }, 200);
        }
    })

    function ChangeBonificacion() {
        AñadirDetalle();
    }


    $(document).keydown(function(tecla) {


        if (tecla.ctrlKey && tecla.keyCode == 83) {
            tecla.preventDefault();
            guardar();
        }

    });
</script>