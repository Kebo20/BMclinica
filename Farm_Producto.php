<?php
include'cado/ClaseFarmacia.php';

$ofarm = new Farmacia();
$familias = $ofarm->ListarFamilia("");
$laboratorios = $ofarm->ListarLaboratorio("");
$principios = $ofarm->ListarPrincipio("");
?>
<link  rel="stylesheet" type="text/css"  href="assets/css/select2.min.css" />

<script src="assets/js/select2.full.min.js"   type="text/javascript"></script>
<table id="IdTblPro" border="1" bordercolor="#cccccc" >
    <thead>
        <tr style="font-size:14px">
            <Th>N°</Th>
            <Th>Cód.</Th>
            <Th>Nombre</Th>
            <Th>Precio</Th>
            <Th>Prec. compra</Th>
            <Th>Código dig...</Th>
            <Th>Familia</Th>
            <Th>Lab.</Th>
            <Th>Principio</Th>
            <Th>Stock mín.</Th>
            <Th>Stock máx.</Th>
            <Th>Tipo de producto</Th>
            <Th>Tipo de medicamento</Th>
            <Th>Tipo de afectación</Th>

        </tr>
    </thead>
    <tbody id="TbodyPro" style="font-size:12px;"> </tbody>  	
</table>

<br>
<div class="row">
    <div class="col-lg-4 col-md-12">
        <div class="form-group">
            <!-- Simple Icon Button -->
            <button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="AbrirModalPro()"><i class="ft-plus"></i> Nuevo</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="LlenarDatosPro()"><i class="ft-edit-1"></i> Editar</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="EliminarPro()"><i class="ft-trash-2"></i> Eliminar</button>
        </div>
    </div>
    <div class="col-lg-5 col-md-12">
        <input type="text" class="form-control" onkeyup="LisPro()" placeholder="Buscar Producto" id="TxtBuscarPro" >

    </div>
</div>

<div id="IdModalPro" class="modal fade" role="dialog" >

    <div class="modal-dialog modal-xl" >
        <div class="modal-content">
            <div class="modal-header">

                &nbsp; INGRESE PRODUCTO

            </div>
            <div class="modal-body">
                <table  width="100%" style="font-size:12px; font-weight:bold;">
                    <tr style='display:none'>
                        <td><b>Id</b>
                        <td><input style="width:95%" name ="id_pro" type="text" id="id_pro" size="5" readonly="readonly" class="form-control PROformulario"/></td>

                        </td>

                    </tr>
                    <tr>
                        <td width="10%"><b>Código</b>
                            <input style="width:95%" name ="codigo" type="text" id="PROcodigo"  class="form-control PROformulario" value="" autocomplete="off"></td>
                        <td width="10%"><b>Nombre</b>
                            <input style="width:95%" name ="nombre" type="text" id="PROnombre"  class="form-control PROformulario" value="" autocomplete="off"></td>
                        <td width="10%"><b>Precio</b>
                            <input style="width:95%" name ="precio" type="text" id="PROprecio"  class="form-control PROformulario numero" value="" autocomplete="off"></td>

                        <td width="10%"><b>Precio de compra</b>
                            <input style="width:95%" name ="precio_compra" type="text" id="PROprecio_compra"  class="form-control numero PROformulario" value="" autocomplete="off"></td>

                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td width="10%"><b>Código dig...</b>
                            <input style="width:95%" name ="" type="text" id="PROcoddig"  class="form-control PROformulario" value="" autocomplete="off"></td>

                        <td width="10%"><b>Familia</b><br>
                            <select id="PROid_cmb_fam" class="form-control chosen-select PROformulario"  style="height:30px;width:95%">
                                <option value="" > Seleccione una familia </option>
                                <?php foreach ($familias as $f) { ?>
                                    <option value="<?= $f[0] ?>"><?= $f[1] ?></option>
                                <?php } ?>
                            </select>
                        </td>

                        <td width="10%"><b>Laboratorio</b><br>
                            <select id="PROid_cmb_lab" class="form-control chosen-select PROformulario"  style="height:30px;width:95%">
                                <option value="" > Seleccione un laboratorio </option>
                                <?php foreach ($laboratorios as $l) { ?>
                                    <option value="<?= $l[0] ?>"><?= $l[1] ?></option>
                                <?php } ?>
                            </select>
                        </td>

                        <td width="10%"><b>Principio activo</b><br>
                            <select id="PROid_cmb_prin" class="form-control chosen-select PROformulario"  style="height:35px;width:95%">
                                <option value="" > Seleccione un principio acitvo </option>
                                <?php foreach ($principios as $p) { ?>
                                    <option value="<?= $p[0] ?>"><?= $p[1] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                    <td width="10%"><b>Stock mínimo</b>
                        <input style="width:95%" name ="" type="text" id="PROstock_min"  class="form-control PROformulario numero" value="" autocomplete="off"></td>

                    <td width="10%"><b>Stock max</b>
                        <input style="width:95%" name ="" type="text" id="PROstock_max"  class="form-control PROformulario numero" value="" autocomplete="off"></td>

                    <td width="10%"><b>Tipo de producto</b><br>
                        <select id="PROtipo_producto" class="form-control chosen-select PROformulario" style="height:30px;width:95%" >
                            <option value="" > Seleccione un tipo de producto</option>
                            <option value="producto" > Producto</option>
                            <option value="servicio" > Servicio</option>

                        </select>
                    </td>

                    <td width="10%"><b>Tipo de medicamento</b><br>
                        <select id="PROtipo_medicamento" class="form-control chosen-select PROformulario" style="height:30px;width:100%" >
                            <option value="" > Seleccione un tipo de medicamento</option>
                            <option value="genérico" >Genérico</option>
                            <option value="marca" >Marca</option>

                        </select>
                    </td>

                    <td width="10%"><b>Tipo de afectación</b><br>
                        <select id="PROtipo_afectacion" class="form-control chosen-select PROformulario" style="height:30px;width:100%" >
                            <option value="" > Seleccione un tipo de afectación</option>
                            <option value="1" >Gravado</option>
                            <option value="2" >Exonerado</option>
                            <option value="3" >Inafecto</option>

                        </select>
                    </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="BtnGrabarPro" class="btn bg-vino mr-1 mb-1" onClick="RegistrarPro()" > Grabar</button>
                <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"  > Cancelar</button>									
            </div>
        </div>
    </div>
</div>



<input type="hidden" id="IdFilaPro" value="0"  >
<input type="hidden" id="ValorPro" value="0"  >

<script >
    $(document).ready(function () {
        $("#IdModalPro").on('shown.bs.modal', function () {
            $(this).find('#codigo').focus();
        });
        $('#IdTblPro').fixheadertable({
            //caption	: 'Lista de Areas', 
            colratio: [5, 10, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15],
            height: 500,
            width: '100%',
            zebra: true,
            sortable: false,
            sortedColId: 3,
            pager: false,
            rowsPerPage: 10,
            resizeCol: false,
        });
//        $('.chosen-select').chosen({width: "100%"});
        // $('.chosen-select').select2({dropdownParent: $('#IdModalPro')});
        $('.chosen-select').chosen({allow_single_deselect: true});
        $(this).find('.chosen-container').css({width: "100%"});
        $('.numero').on("keypress", function () {
            if (event.keyCode > 47 && event.keyCode < 60 || event.keyCode == 46) {

            } else {
                event.preventDefault();
            }

        });
    });

    function AbrirModalPro() {
        limpiar_camposPro();
        $("#ValorPro").val(1);
        $("#IdModalPro").modal()
    }

    function LisPro() {
        var $buscar = $("#TxtBuscarPro").val()
        $.post('controlador/Cfarmacia.php', {accion: "LIS_PRO", buscar: $buscar}, function (data) {
            $("#TbodyPro").html(data);
            $("#IdFilaPro").val(0);
        })
    }

    function PintarFilaPro($id) {
        var $idfilaanterior = $("#IdFilaPro").val()

        var $par = $idfilaanterior.split('_')
        var $par_int = parseInt($par[1])
        // alert($par_int)
        if ($par_int % 2 == 0) {
            // alert("hola")
            $("#" + $idfilaanterior).css({
                "background-color": "#f5f5f5",
                "color": "#000000"
            })
        } else {
            $("#" + $idfilaanterior).css({
                "background-color": "#FFFFFF",
                "color": "#000000"
            })
        }
        //alert($id);alert($idfilaanterior)
        $("#" + $id).css({
            "background-color": "#900052",
            "color": "#FFFFFF"
        })
        $("#IdFilaPro").val($id)

    }

    function RegistrarPro() {
        //validar_data();
        var $valor = $("#ValorPro").val();
        var $id = $("#id_pro").val();
        var $codigo = $("#PROcodigo").val();
        var $nombre = $("#PROnombre").val();
        var $precio = $("#PROprecio").val();
        var $precio_compra = $("#PROprecio_compra").val();
        var $codigodig = $("#PROcoddig").val();
        var $familia = $("#PROid_cmb_fam").val();
        var $laboratorio = $("#PROid_cmb_lab").val();
        var $principio = $("#PROid_cmb_prin").val();
        var $stock_min = $("#PROstock_min").val();
        var $stock_max = $("#PROstock_max").val();
        var $tipo_producto = $("#PROtipo_producto").val();
        var $tipo_medicamento = $("#PROtipo_medicamento").val();
        var $tipo_afectacion = $("#PROtipo_afectacion").val();


        if ($codigo == '') {
            swal("Ingrese código del producto ..", "Campo Obligatorio", "warning");
            $("#PROcodigo").focus();
            return false;
        }
        if ($nombre == '') {
            swal("Ingrese Nombre ..", "Campo Obligatorio", "warning");
            $("#PROnombre").focus();
            return false;
        }
        if ($precio == '') {
            swal("Ingrese precio ..", "Campo Obligatorio", "warning");
            $("#PROprecio").focus();
            return false;
        }
        if ($precio_compra == '') {
            swal("Ingrese precio de compra ..", "Campo Obligatorio", "warning");
            $("#PROprecio_compra").focus();
            return false;
        }
        if ($codigodig == '') {
            swal("Ingrese código dig ..", "Campo Obligatorio", "warning");
            $("#PROcoddig").focus();
            return false;
        }
        if ($familia == '') {
            swal("Seleccione una familia ..", "Campo Obligatorio", "warning");
            $("#PROid_cmb_fam").focus();
            return false;
        }
        if ($laboratorio == '') {
            swal("Seleccione un laboratorio ..", "Campo Obligatorio", "warning");
            $("#PROid_cmb_lab").focus();
            return false;
        }
        if ($principio == '') {
            swal("Seleccione un principio activo ..", "Campo Obligatorio", "warning");
            $("#PROid_cmb_prin").focus();
            return false;
        }
        if ($stock_min == '') {
            swal("Ingrese stock mínimo ..", "Campo Obligatorio", "warning");
            $("#PROstock_min").focus();
            return false;
        }
        if ($stock_max == '') {
            swal("Ingrese stock máximo ..", "Campo Obligatorio", "warning");
            $("#PROstock_max").focus();
            return false;
        }
        if ($tipo_producto == '') {
            swal("Seleccione un tipo de producto ..", "Campo Obligatorio", "warning");
            $("#PROtipo_producto").focus();
            return false;
        }
        if ($tipo_medicamento == '') {
            swal("Seleccione un tipo de medicamento ..", "Campo Obligatorio", "warning");
            $("#PROtipo_producto").focus();
            return false;
        }
        if ($tipo_afectacion == '') {
            swal("Seleccione un tipo de afectación IGV ..", "Campo Obligatorio", "warning");
            $("#PROtipo_afectacion").focus();
            return false;
        }

       $("#BtnGrabarPro").prop("disabled", true);
        $.post("controlador/Cfarmacia.php", {accion: 'NUEVO_PRO', id: $id, codigo: $codigo, nombre: $nombre,
            precio: $precio, precio_compra: $precio_compra, stock_min: $stock_min, stock_max: $stock_max, codigodig: $codigodig,
            familia: $familia, laboratorio: $laboratorio, principio: $principio, tipo_producto: $tipo_producto, tipo_medicamento: $tipo_medicamento,
            tipo_afectacion: $tipo_afectacion, valor: $valor}, function (data) {
            //alert(data);
            $("#BtnGrabarPro").prop("disabled", false);
            if (data == 2) {
                swal("Nombre ya existe ..", "Error", "error");
                return false;
            }
            if (data == 1) {
                $("#IdFilaPro").val(0);
                swal("Datos registrados Correctamente ..", "Felicitaciones", "success");
                LisPro();
                CerrarModalPro();
                return false;
            }
            if (data == 0) {
                swal("Datos no registrados Correctamente ..", "Error", "error");
                return false;
            }

        })

    }

    function LlenarDatosPro() {
        $("#ValorPro").val(2)
        var $ident = $("#IdFilaPro").val()
        var $id = $("#" + $ident).attr("idpro")

        if ($ident == 0) {
            swal("Debe seleccionar un Registro", "Obligatorio", "warning");
            return false;
        }
        $.post("controlador/Cfarmacia.php", {accion: 'LLENAR_PRO', id: $id}, function (data) {
            $("#id_pro").val(data.id);
            $("#PROcodigo").val(data.codigo);
            $("#PROnombre").val(data.nombre);
            $("#PROprecio").val(data.precio);
            $("#PROprecio_compra").val(data.precio_compra);
            $("#PROcoddig").val(data.codigodigemid);
            // $("#id_cmb_fam").val(data.id_familia);
            //$("#id_cmb_fam").change();
            $("#PROid_cmb_fam").val(data.id_familia).trigger("chosen:updated");
            //  $("#id_cmb_lab").val(data.id_laboratorio);
            // $("#id_cmb_lab").change();
            $("#PROid_cmb_lab").val(data.id_laboratorio).trigger("chosen:updated");
            //$("#id_cmb_prin").val(data.id_principio);
            //$("#id_cmb_prin").change();
            $("#PROid_cmb_prin").val(data.id_principio).trigger("chosen:updated");
            $("#PROstock_min").val(data.stock_min);
            $("#PROstock_max").val(data.stock_max);
            //$("#tipo_producto").val(data.tipo_producto);
            //$("#tipo_producto").change();
            $("#PROtipo_producto").val(data.tipo_producto).trigger("chosen:updated");
            //$("#tipo_medicamento").val(data.tipo_medicamento);
            //$("#tipo_medicamento").change();
            $("#PROtipo_medicamento").val(data.tipo_medicamento).trigger("chosen:updated");
            //$("#tipo_afectacion").val(data.tipo_afectacion);
            //$("#tipo_afectacion").change();
            $("#PROtipo_afectacion").val(data.tipo_afectacion).trigger("chosen:updated");

            $("#IdModalPro").modal();
        }, 'JSON');



    }

    function limpiar_camposPro() {
        $(".PROformulario").val("");
    }

    function CerrarModalPro() {
        $("#IdModalPro").modal("hide");
    }

    function EliminarPro() {
        swal({
            title: "Confirmacion",
            text: "Está seguro de Eliminar este Producto",
            icon: "warning",
            buttons: true,
            dangerMode: true}).then((willDelete) => {
            if (willDelete) {
                var $ident = $("#IdFilaPro").val()
                var $id = $("#" + $ident).attr("idpro")
                $.post("controlador/Cfarmacia.php", {accion: 'ELIMINAR_PRO', id: $id}, function (data) {
                    if (data == 1) {
                        LisPro();
                        swal("Dato Eliminado Correctamente ..", "Felicitaciones", "success");
                        return false;
                    }
                    if (data == 0) {
                        swal("Dato no Eliminado ..", "Error", "error");
                        return false;
                    }

                })
            }
        });
    }

    LisPro()
