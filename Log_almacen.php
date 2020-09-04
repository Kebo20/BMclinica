<?php
include('cado/ClaseConfiguracion.php');
$oconf = new Configuraciones();
$sucursales = $oconf->ListarSucursal("");
?>

<table id="IdTblALM" border="1" bordercolor="#cccccc" >
    <thead>
        <tr style="font-size:14px">
            <Th >Nro</Th>
            <Th >Nombre</Th>
            <Th >Responsable</Th>
            <Th >Correo</Th>
            <Th >Sucursal</Th>
            <Th >Tipo</Th>

        </tr>
    </thead>
    <tbody id="TbodyALM" style="font-size:12px;"> </tbody>  	
</table>

<br>
<div class="row">
    <div class="col-lg-4 col-md-12">
        <div class="form-group">
            <!-- Simple Icon Button -->
            <button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="AbrirModalALM()"><i class="ft-plus"></i> Nuevo</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="LlenarDatosALM()"><i class="ft-edit-1"></i> Editar</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="EliminarALM()"><i class="ft-trash-2"></i> Eliminar</button>
        </div>
    </div>
    <div class="col-lg-5 col-md-12">
        <input type="text" class="form-control" onkeyup="LisALM()" placeholder="Buscar ALMacén " id="TxtBuscarALM" >

    </div>
</div>


<div id="IdModalALM" class="modal fade" role="dialog" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4> &nbsp; INGRESE ALMACÉN </h4>

            </div>
            <div class="modal-body">
                <table  width="100%" style="font-size:13px; font-weight:bold;">
                    <tr style='display:none'>
                        <td>Id</td>
                        <td><input name ="id_ALM" type="text" id="id_ALM" size="5" readonly="readonly" class="form-control"/></td>
                    </tr>

                    <tr>
                        <td><b>Nombre</b>
                            <input  type="text" id="ALMnombre"  class="form-control" value="" autocomplete="off"></td>
                    </tr>

                    <tr>
                        <td><b>Responsable</b>
                            <input  type="text" id="ALMresponsable"  class="form-control" value="" autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td><b>Correo</b>
                            <input name ="tel1" type="text" id="ALMcorreo"  class="form-control" value="" autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td><b>Sucursal</b>

                            <select id='ALMsucursal' class='ALMchosen-select'>
                                <option value=''>Seleccione</option>
                                <?php foreach ($sucursales as $s) { ?>
                                    <option value='<?= $s[0] ?>'><?= $s[1] ?></option>
                                <?php } ?>
                            </select>
                    </tr>
                    <tr width='100%'>
                        <td><b>Tipo</b>

                            <select id='ALMid_cmb_tipo' class='ALMchosen-select'>
                                <option value=''>Seleccione</option>

                                <option value='logística'>Logística</option>
                                <option value='farmacia'>Farmacia</option>

                            </select>
                    </tr>


                    <tr><td>&nbsp;</td></tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="BtnGrabarALM" class="btn bg-vino mr-1 mb-1" onClick="RegistrarALM()" > Grabar</button>
                <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"  > Cancelar</button>									
            </div>
        </div>
    </div>
</div>


<input type="hidden" id="IdFilaALM" value="0"  >
<input type="hidden" id="ValorALM" value="0"  >

<script >
    $(document).ready(function () {
        $("#IdModalALM").on('shown.bs.modal', function () {
            $(this).find('#ALMnombre').focus();
        });
        $('#IdTblALM').fixheadertable({
            //caption	: 'Lista de Areas', 
            colratio: [15, 90, 130, 50, 50,50],
            height: 500,
            width: '100%',
            zebra: true,
            sortable: false,
            sortedColId: 3,
            pager: false,
            rowsPerPage: 10,
            resizeCol: false,
        });

        $('.ALMchosen-select').chosen({allow_single_deselect: true});
        $(this).find('.chosen-container').css({width: "100%"});
    });

    function AbrirModalALM() {
        limpiar_camposALM();
        $("#ValorALM").val(1);
        $("#IdModalALM").modal();
    }

    function LisALM() {
        var $buscar = $("#TxtBuscarALM").val()
        $.post('controlador/Clogistica.php', {accion: "LIS_ALM", buscar: $buscar}, function (data) {
            $("#TbodyALM").html(data);
            $("#IdFilaALM").val(0);
        })
    }

    function PintarFilaALM($id) {
        var $idfilaanterior = $("#IdFilaALM").val()

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
        $("#IdFilaALM").val($id)

    }



    function RegistrarALM() {
        //validar_data();
        var $valor = $("#ValorALM").val();
        var $id = $("#id_ALM").val();
        var $nombre = $("#ALMnombre").val();
        var $responsable = $("#ALMresponsable").val();
        var $correo = $("#ALMcorreo").val();
        var $tipo = $("#ALMid_cmb_tipo").val();
        var $sucursal = $("#ALMsucursal").val();


        if ($nombre == '') {
            swal("Ingrese Nombre ..", "Campo Obligatorio", "warning");
            $("#ALMnombre").focus();
            return false;
        }
        if ($responsable == '') {
            swal("Ingrese responsable ..", "Campo Obligatorio", "warning");
            $("#ALMresponsable").focus();
            return false;
        }
        if ($sucursal == '') {
            swal("Seleccione sucursal ..", "Campo Obligatorio", "warning");
            $("#ALMsucursal").focus();
            return false;
        }
        if ($tipo == '') {
            swal("Seleccione un tipo ..", "Campo Obligatorio", "warning");
            $("#ALMid_cmb_tipo").focus();
            return false;
        }

        $("#BtnGrabarALM").prop("disabled", true);
        $.post("controlador/Clogistica.php", {accion: 'NUEVO_ALM', id: $id, nombre: $nombre, responsable: $responsable,
            correo: $correo, sucursal: $sucursal,tipo:$tipo, valor: $valor}, function (data) {
//            alert(data)
            $("#BtnGrabarALM").prop("disabled", false);
            if (data == 2) {
                swal("Nombre ya existe ..", "Error", "error");
                return false;
            }
            if (data == 1) {
                $("#IdFilaALM").val(0);
                swal("Datos registrados Correctamente ..", "Felicitaciones", "success");
                LisALM();
                CerrarModalALM();
                return false;
            }
            if (data == 0) {
                swal("Datos no registrados Correctamente ..", "Error", "error");
                return false;
            }

        })

    }

    function LlenarDatosALM() {
        $("#ValorALM").val(2)
        var $ident = $("#IdFilaALM").val()
        var $id = $("#" + $ident).attr("idALM")

        if ($ident == 0) {
            swal("Debe seleccionar un Registro", "Obligatorio", "warning");
            return false;
        }
        $.post("controlador/Clogistica.php", {accion: 'LLENAR_ALM', id: $id}, function (data) {
            $("#id_ALM").val(data.id);
            $("#ALMnombre").val(data.nombre);
            $("#ALMresponsable").val(data.responsable);
            $("#ALMcorreo").val(data.correo);
            setTimeout(function () {
                $("#ALMsucursal").val(data.id_sucursal).trigger('chosen:updated');
            }, 200);
            setTimeout(function () {
                $("#ALMid_cmb_tipo").val(data.tipo).trigger('chosen:updated');
            }, 200);

            $("#IdModalALM").modal();
        }, 'JSON')



    }

    function limpiar_camposALM() {
        $("#id_ALM,#ALMnombre,#ALMresponsable,#ALMcorreo").val("");
        setTimeout(function () {
            $("#ALMsucursal").val("").trigger('chosen:updated');
        }, 200);
        setTimeout(function () {
            $("#ALMid_cmb_tipo").val("").trigger('chosen:updated');
        }, 200);
    }

    function CerrarModalALM() {
        $("#IdModalALM").modal("hide");
    }

    function EliminarALM() {
        swal({
            title: "Confirmacion",
            text: "Está seguro de Eliminar este Laboratorio",
            icon: "warning",
            buttons: true,
            dangerMode: true}).then((willDelete) => {
            if (willDelete) {
                var $ident = $("#IdFilaALM").val()
                var $id = $("#" + $ident).attr("idALM")
                $.post("controlador/Clogistica.php", {accion: 'ELIMINAR_ALM', id: $id}, function (data) {
                    if (data == 1) {
                        LisALM();
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

    LisALM();
