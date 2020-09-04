<?php
include'cado/ClaseLogistica.php';

$olog = new Logistica();
$categorias = $olog->ListarCategoriaProducto("");
?>

<table id="IdTblLOGPRO" border="1" bordercolor="#cccccc" >
    <thead>
        <tr style="font-size:14px">
            <Th>N°</Th>
            <Th>Nombre</Th>
            <Th>Categoría</Th>
            <Th>Unidad</Th>
            <Th>Stock mín.</Th>
            <Th>Stock máx.</Th>
            <Th>Tipo de Producto</Th>


        </tr>
    </thead>
    <tbody id="TbodyLOGPRO" style="font-size:12px;"> </tbody>  	
</table>

<br>
<div class="row">
    <div class="col-lg-4 col-md-12">
        <div class="form-group">
            <!-- Simple Icon Button -->
            <button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="AbrirModalLOGPRO()"><i class="ft-plus"></i> Nuevo</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="LlenarDatosLOGPRO()"><i class="ft-edit-1"></i> Editar</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="EliminarLOGPRO()"><i class="ft-trash-2"></i> Eliminar</button>
        </div>
    </div>
    <div class="col-lg-5 col-md-12">
        <input type="text" class="form-control" onkeyup="LisLOGPRO()" placeholder="Buscar LOGPROducto" id="TxtBuscarLOGPRO" >

    </div>
</div>

<div id="IdModalLOGPRO" class="modal fade" role="dialog" >

    <div class="modal-dialog " >
        <div class="modal-content">
            <div class="modal-header">

                &nbsp; INGRESE PRODUCTO

            </div>
            <div class="modal-body">
                <table  width="100%" style="font-size:12px; font-weight:bold;">
                    <tr style='display:none'>
                        <td><b>Id</b>
                        <td><input style="width:95%" name ="id_LOGPRO" type="text" id="id_LOGPRO" size="5" readonly="readonly" class="form-control LOGPROformulario"/></td>

                        </td>

                    </tr>
                    <tr>
                        <td width="10%"><b>Nombre</b>
                            <input style="width:95%" name ="nombre" type="text" id="LOGPROnombre"  class="form-control LOGPROformulario" value="" autocomplete="off"></td>
                        <td width="10%"><b>Unidad</b>
                            <input style="width:95%" name ="nombre" type="text" id="LOGPROunidad"  class="form-control LOGPROformulario" value="" autocomplete="off"></td>


                    </tr>
                    <tr><td width="10%"><b>Categoría</b><br>
                            <select id="LOGPROcategoria" class="form-control LOGPROchosen-select LOGPROformulario"  style="height:30px;width:95%">
                                <option value="" > Seleccione</option>
                                <?php foreach ($categorias as $f) { ?>
                                    <option value="<?= $f[0] ?>"><?= $f[1] ?></option>
                                <?php } ?>
                            </select>
                        </td>

                        <td width="10%"><b>Tipo de Producto</b><br>
                            <select id="LOGPROtipo_producto" class="form-control LOGPROchosen-select LOGPROformulario" style="height:30px;width:95%" >
                                <option value="" > Seleccione </option>
                                <option value="prpducto" > Producto</option>
                                <option value="servicio" > Servicio</option>

                            </select>
                        </td>
                    </tr>

                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td width="10%"><b>Stock mínimo</b>
                            <input style="width:95%" name ="" type="text" id="LOGPROstock_min"  class="form-control LOGPROformulario numero" value="" autocomplete="off"></td>

                        <td width="10%"><b>Stock max</b>
                            <input style="width:95%" name ="" type="text" id="LOGPROstock_max"  class="form-control LOGPROformulario numero" value="" autocomplete="off"></td>





                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="BtnGrabarLOGPRO" class="btn bg-vino mr-1 mb-1" onClick="RegistrarLOGPRO()" > Grabar</button>
                <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"  > Cancelar</button>									
            </div>
        </div>
    </div>
</div>



<input type="hidden" id="IdFilaLOGPRO" value="0"  >
<input type="hidden" id="ValorLOGPRO" value="0"  >

<script >
    $(document).ready(function () {
        $("#IdModalLOGPRO").on('shown.bs.modal', function () {
            $(this).find('#codigo').focus();
        });
        $('#IdTblLOGPRO').fixheadertable({
            //caption	: 'Lista de Areas', 
            colratio: [5, 10, 15, 15, 15, 15, 15],
            height: 500,
            width: '100%',
            zebra: true,
            sortable: false,
            sortedColId: 3,
            pager: false,
            rowsPerPage: 10,
            resizeCol: false,
        });

        $('.LOGPROchosen-select').chosen({allow_single_deselect: true});
        $(this).find('.chosen-container').css({width: "95%"});
        $('.numero').on("keypress", function () {
            if (event.keyCode > 47 && event.keyCode < 60 || event.keyCode == 46) {

            } else {
                event.preventDefault();
            }

        });
    });

    function AbrirModalLOGPRO() {
        limpiar_camposLOGPRO();
        $("#ValorLOGPRO").val(1);
        $("#IdModalLOGPRO").modal()
    }

    function LisLOGPRO() {
        var $buscar = $("#TxtBuscarLOGPRO").val()
        $.post('controlador/Clogistica.php', {accion: "LIS_PRO", buscar: $buscar}, function (data) {
            $("#TbodyLOGPRO").html(data);
            $("#IdFilaLOGPRO").val(0);
        })
    }

    function PintarFilaLOGPRO($id) {
        var $idfilaanterior = $("#IdFilaLOGPRO").val()

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
        $("#IdFilaLOGPRO").val($id)

    }



    function RegistrarLOGPRO() {
        //validar_data();
        var $valor = $("#ValorLOGPRO").val();
        var $id = $("#id_LOGPRO").val();
        var $nombre = $("#LOGPROnombre").val();
        var $categoria = $("#LOGPROcategoria").val();
        var $stock_min = $("#LOGPROstock_min").val();
        var $stock_max = $("#LOGPROstock_max").val();
        var $tipo_producto = $("#LOGPROtipo_producto").val();
        var $unidad = $("#LOGPROunidad").val();


        if ($nombre == '') {
            swal("Ingrese Nombre ..", "Campo Obligatorio", "warning");
            $("#LOGPROnombre").focus();
            return false;
        }

     
        if ($categoria == '') {
            swal("Seleccione una categoría ..", "Campo Obligatorio", "warning");
            $("#LOGPROcategoria").focus();
            return false;
        }
        if ($stock_min == '') {
            swal("Ingrese stock mínimo ..", "Campo Obligatorio", "warning");
            $("#LOGPROstock_min").focus();
            return false;
        }
        if ($stock_max == '') {
            swal("Ingrese stock máximo ..", "Campo Obligatorio", "warning");
            $("#LOGPROstock_max").focus();
            return false;
        }
        if ($tipo_producto == '') {
            swal("Seleccione un tipo de producto ..", "Campo Obligatorio", "warning");
            $("#LOGPROtipo_producto").focus();
            return false;
        }
        if ($unidad == '') {
            swal("Inserte una unidad..", "Campo Obligatorio", "warning");
            $("#LOGPROunidad").focus();
            return false;
        }


        $("#BtnGrabarLOGPRO").prop("disabled", true);
        $.post("controlador/Clogistica.php", {accion: 'NUEVO_PRO', id: $id, nombre: $nombre,
            stock_min: $stock_min, stock_max: $stock_max, unidad: $unidad,
            tipo_producto: $tipo_producto, categoria: $categoria,
             valor: $valor}, function (data) {
//            alert(data);
            $("#BtnGrabarLOGPRO").prop("disabled", false);
            if (data == 2) {
                swal("Nombre ya existe ..", "Error", "error");
                return false;
            }
            if (data == 1) {
                $("#IdFilaLOGPRO").val(0);
                swal("Datos registrados Correctamente ..", "Felicitaciones", "success");
                LisLOGPRO();
                CerrarModalLOGPRO();
                return false;
            }
            if (data == 0) {
                swal("Datos no registrados Correctamente ..", "Error", "error");
                return false;
            }

        })

    }

    function LlenarDatosLOGPRO() {
        $("#ValorLOGPRO").val(2)
        var $ident = $("#IdFilaLOGPRO").val()
        var $id = $("#" + $ident).attr("idLOGPRO")

        if ($ident == 0) {
            swal("Debe seleccionar un Registro", "Obligatorio", "warning");
            return false;
        }
        $.post("controlador/Clogistica.php", {accion: 'LLENAR_PRO', id: $id}, function (data) {
            $("#id_LOGPRO").val(data.id);
            $("#LOGPROnombre").val(data.nombre);
            $("#LOGPROcategoria").val(data.id_categoria).trigger("chosen:updated");
            $("#LOGPROtipo_producto").val(data.tipo_producto).trigger("chosen:updated");
            $("#LOGPROstock_min").val(data.stock_min);
            $("#LOGPROstock_max").val(data.stock_max);
            $("#LOGPROunidad").val(data.unidad);

            $("#LOGPROtipo_producto").val(data.tipo_producto).trigger("chosen:updated");



            $("#IdModalLOGPRO").modal();
        }, 'JSON');



    }

    function limpiar_camposLOGPRO() {
        $(".LOGPROformulario").val("");
        $("#LOGPROcategoria").val("").trigger("chosen:updated");
        $("#LOGPROtipo_producto").val("").trigger("chosen:updated");
    }

    function CerrarModalLOGPRO() {
        $("#IdModalLOGPRO").modal("hide");
    }

    function EliminarLOGPRO() {
        swal({
            title: "Confirmacion",
            text: "Está seguro de Eliminar este producto",
            icon: "warning",
            buttons: true,
            dangerMode: true}).then((willDelete) => {
            if (willDelete) {
                var $ident = $("#IdFilaLOGPRO").val()
                var $id = $("#" + $ident).attr("idLOGPRO")
                $.post("controlador/Clogistica.php", {accion: 'ELIMINAR_PRO', id: $id}, function (data) {
                    if (data == 1) {
                        LisLOGPRO();
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

    LisLOGPRO();
