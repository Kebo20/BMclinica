<?php
//sesion_start();
?>

<table id="IdTblSUC" border="1" bordercolor="#cccccc" >
    <thead>
        <tr style="font-size:14px">
            <Th >Nro</Th>
            <Th >Logo</Th>
            <Th >RUC</Th>
            <Th >Nombre</Th>

            <Th >Dirección</Th>
            <Th >Teléfono</Th>
            <Th >Responsable</Th>
            <Th >Correo</Th>
            <Th >Celular</Th>

        </tr>
    </thead>
    <tbody id="TbodySUC" style="font-size:12px;"> </tbody>  	
</table>

<br>
<div class="row">
    <div class="col-lg-4 col-md-12">
        <div class="form-group">
            <!-- Simple Icon Button -->
            <button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="AbrirModalSUC()"><i class="ft-plus"></i> Nuevo</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="LlenarDatosSUC()"><i class="ft-edit-1"></i> Editar</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="EliminarSUC()"><i class="ft-trash-2"></i> Eliminar</button>
        </div>
    </div>
    <div class="col-lg-5 col-md-12">
        <input type="text" class="form-control" onkeyup="LisSUC()" placeholder="Buscar sucursal " id="TxtBuscarSUC" >

    </div>
</div>


<div id="IdModalSUC" class="modal fade" role="dialog" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4> &nbsp; INGRESE SUCURSAL </h4>

            </div>
            <form id='SUCform' >
                <div class="modal-body">


                    <table  width="100%" style="font-size:13px; font-weight:bold;">
                        <tr style='display:none'>
                            <td>Id</td>
                            <td><input name ="id" type="text" id="id_SUC" size="5" readonly="readonly" class="form-control"/></td>
                        </tr>

                        <tr >
                            <td width="50%"><b>RUC</b>
                                <input  type="text" width="95%" name="ruc" id='SUCruc' class="form-control" value="" autocomplete="off"></td>
                            <td width="50%"><b>Logo</b>
                                <input  type="file" width="95%" accept="image/gif,image/jpeg,image/jpg,image/png"  name="logo" id='SUClogo' class="form-control" value="" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td><b>Nombre</b>
                                <input  type="text" width="95%" name="nombre" id='SUCnombre' class="form-control" value="" autocomplete="off"></td>
                            <td><b>Direccion</b>
                                <input  type="text" width="95%" name="direccion" id='SUCdireccion' class="form-control" value="" autocomplete="off"></td>

                        </tr>

                        <tr>
                            <td><b>Correo</b>
                                <input  type="text" width="95%" name="correo" id='SUCcorreo' class="form-control" value="" autocomplete="off"></td>

                            <td><b>Teléfono</b>
                                <input  type="text" width="95%" name="telefono" id='SUCtelefono' class="form-control" value="" autocomplete="off"></td>
                        </tr>

                        <tr>
                            <td><b>Responsable</b>
                                <input  type="text" width="95%" name="responsable" id='SUCresponsable' class="form-control" value="" autocomplete="off"></td>
                            <td><b>Celular</b>
                                <input  type="text" width="95%" name="celular_responsable" id='SUCcelular' class="form-control" value="" autocomplete="off"></td>
                        <input type="hidden" name='accion'  value="NUEVO_SUC"  >
                        <input type="hidden" name='valor' id="ValorSUC" value="0"  >

                        </tr>


                        <tr><td>&nbsp;</td></tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="BtnGrabarSUC" class="btn bg-vino mr-1 mb-1"  > Grabar</button>
                    <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"  > Cancelar</button>									
                </div>
            </form>
        </div>
    </div>
</div>


<input type="hidden" id="IdFilaSUC" value="0"  >

<script >
    $(document).ready(function () {
        $("#IdModalSUC").on('shown.bs.modal', function () {
            $(this).find('#SUCruc').focus();
        });
        $('#IdTblSUC').fixheadertable({
            //caption	: 'Lista de Areas', 
            colratio: [20, 50, 30, 90, 60, 50, 50, 50, 50],
            height: 500,
            width: '100%',
            zebra: true,
            sortable: false,
            sortedColId: 3,
            pager: false,
            rowsPerPage: 10,
            resizeCol: false,
        });

//        $('.SUCchosen-select').chosen({allow_single_deselect: true});
//        $(this).find('.chosen-container').css({width: "100%"});
    });

    function AbrirModalSUC() {
        limpiar_camposSUC();
        $("#ValorSUC").val(1);
        $("#IdModalSUC").modal();
    }

    function LisSUC() {
        var $buscar = $("#TxtBuscarSUC").val()
        $.post('controlador/Cconfiguracion.php', {accion: "LIS_SUC", buscar: $buscar}, function (data) {
            $("#TbodySUC").html(data);
            $("#IdFilaSUC").val(0);
        })
    }

    function PintarFilaSUC($id) {
        var $idfilaanterior = $("#IdFilaSUC").val()

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
        $("#IdFilaSUC").val($id)

    }

    $(document).on('submit', '#SUCform', function (e) {

        e.preventDefault();

        var $nombre = $("#SUCnombre").val();
        var $logo = $("#SUClogo").val();
        var $responsable = $("#SUCresponsable").val();
        var $direccion = $("#SUCdireccion").val();
        var $correo = $("#SUCcorreo").val();
        var $ruc = $("#SUCruc").val();

        if ($ruc == '') {
            swal("Ingrese un ruc ..", "Campo Obligatorio", "warning");
            $("#SUCruc").focus();
            return false;
        }
        if ($logo == '') {
            swal("Seleccione un logo ..", "Campo Obligatorio", "warning");
            $("#SUClogo").focus();
            return false;
        }
        if ($nombre == '') {
            swal("Ingrese Nombre ..", "Campo Obligatorio", "warning");
            $("#SUCnombre").focus();
            return false;
        }
        if ($direccion == '') {
            swal("Ingrese una dirección ..", "Campo Obligatorio", "warning");
            $("#SUCdireccion").focus();
            return false;
        }
        if ($responsable == '') {
            swal("Ingrese responsable ..", "Campo Obligatorio", "warning");
            $("#SUCresponsable").focus();
            return false;
        }

        var fileName = $("#SUClogo").val();

        var ext = fileName.split('.');
        // ahora obtenemos el ultimo valor despues el punto
        // obtenemos el length por si el archivo lleva nombre con mas de 2 puntos
        ext = ext[ext.length - 1];

        switch (ext) {
            case 'jpg':
                break;
            case 'JPG':
                break;
            case 'png':
                break;
            case 'PNG':
                break;
            case 'svg':
                break;
            case 'SVG':
                break;
            case 'jpeg':
                break;
            case 'JPEG':
                break;

            default:
                swal("Seleccione una imagen", "Formato no admitido", "warning");
                $("#SUClogo").focus();
                $("#SUClogo").val() = ''; // reset del valor
                        break;
                return false;
        }

        $("#BtnGrabarSUC").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: 'controlador/Cconfiguracion.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#BtnGrabarSUC").prop("disabled", false);
                LisSUC();
                CerrarModalSUC();
                console.log(data);
                if (data == 2) {
                    swal("Nombre ya existe ..", "Error", "error");
                    return false;
                } else
                if (data == 1) {
                    $("#IdFilaSUC").val(0);
                    swal("Datos registrados Correctamente ..", "Felicitaciones", "success");

                    return false;
                } else
                if (data == 0) {
                    swal("Datos no registrados Correctamente ..", "Error", "error");
                    return false;
                } else {
                    swal("Datos no registrados Correctamente ..", "Error", data);
                    return false;
                }


            }
        });
    }
    );



    function LlenarDatosSUC() {
        $("#ValorSUC").val(2)
        var $ident = $("#IdFilaSUC").val()
        var $id = $("#" + $ident).attr("idSUC")

        if ($ident == 0) {
            swal("Debe seleccionar un Registro", "Obligatorio", "warning");
            return false;


        }
        $.post("controlador/Cconfiguracion.php", {accion: 'LLENAR_SUC', id: $id}, function (data) {
            $("#id_SUC").val(data.id);
            $("#SUCnombre").val(data.nombre);
            $("#SUCruc").val(data.ruc);
//            $("#SUClogo").val(data.logo);
            $("#SUCresponsable").val(data.responsable);
            $("#SUCcorreo").val(data.correo);
            $("#SUCdireccion").val(data.direccion);
            $("#SUCtelefono").val(data.telefono);
            $("#SUCcelular").val(data.celular_responsable);

            $("#IdModalSUC").modal();
        }, 'JSON');



    }

    function limpiar_camposSUC() {
        $("#SUCform").trigger("reset");
        ;

    }

    function CerrarModalSUC() {
        $("#IdModalSUC").modal("hide");
    }

    function EliminarSUC() {
        swal({
            title: "Confirmacion",
            text: "Está seguro de Eliminar este Laboratorio",
            icon: "warning",
            buttons: true,
            dangerMode: true}).then((willDelete) => {
            if (willDelete) {
                var $ident = $("#IdFilaSUC").val()
                var $id = $("#" + $ident).attr("idSUC")
                $.post("controlador/Cconfiguracion.php", {accion: 'ELIMINAR_SUC', id: $id}, function (data) {
                    if (data == 1) {
                        LisSUC();
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

    LisSUC();
