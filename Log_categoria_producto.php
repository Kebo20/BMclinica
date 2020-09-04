<?php

?>

<table id="IdTblCATPRO" border="1" bordercolor="#cccccc" >
    <thead>
        <tr style="font-size:14px">
            <Th >Nro</Th>
            <Th >Nombre</Th>
            

        </tr>
    </thead>
    <tbody id="TbodyCATPRO" style="font-size:12px;"> </tbody>  	
</table>

<br>
<div class="row">
    <div class="col-lg-4 col-md-12">
        <div class="form-group">
            <!-- Simple Icon Button -->
            <button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="AbrirModalCATPRO()"><i class="ft-plus"></i> Nuevo</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="LlenarDatosCATPRO()"><i class="ft-edit-1"></i> Editar</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="EliminarCATPRO()"><i class="ft-trash-2"></i> Eliminar</button>
        </div>
    </div>
    <div class="col-lg-5 col-md-12">
        <input type="text" class="form-control" onkeyup="LisCATPRO()" placeholder="Buscar categoría " id="TxtBuscarCATPRO" >

    </div>
</div>


<div id="IdModalCATPRO" class="modal fade" role="dialog" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4> &nbsp; INGRESE CATEGORÍA DE PRODUCTO </h4>

            </div>
            <div class="modal-body">
                <table  width="100%" style="font-size:13px; font-weight:bold;">
                    <tr style='display:none'>
                        <td>Id</td>
                        <td><input  type="text" id="id_CATPRO" size="5" readonly="readonly" class="form-control"/></td>
                    </tr>

                    <tr>
                        <td><b>Nombre</b>
                            <input  type="text" id="CATPROnombre"  class="form-control" value="" autocomplete="off"></td>
                    </tr>

                    <tr><td>&nbsp;</td></tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="BtnGrabarCATPRO" class="btn bg-vino mr-1 mb-1" onClick="RegistrarCATPRO()" > Grabar</button>
                <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"  > Cancelar</button>									
            </div>
        </div>
    </div>
</div>


<input type="hidden" id="IdFilaCATPRO" value="0"  >
<input type="hidden" id="ValorCATPRO" value="0"  >

<script >
    $(document).ready(function () {
        $("#IdModalCATPRO").on('shown.bs.modal', function () {
            $(this).find('#CATPROnombre').focus();
        });
        $('#IdTblCATPRO').fixheadertable({
            //caption	: 'Lista de Areas', 
            colratio: [15, 150],
            height: 500,
            width: '100%',
            zebra: true,
            sortable: false,
            sortedColId: 3,
            pager: false,
            rowsPerPage: 10,
            resizeCol: false,
        });

   
    });

    function AbrirModalCATPRO() {
        limpiar_camposCATPRO();
        $("#ValorCATPRO").val(1);
        $("#IdModalCATPRO").modal();
    }

    function LisCATPRO() {
        var $buscar = $("#TxtBuscarCATPRO").val()
        $.post('controlador/Clogistica.php', {accion: "LIS_CAT", buscar: $buscar}, function (data) {
            $("#TbodyCATPRO").html(data);
            $("#IdFilaCATPRO").val(0);
        })
    }

    function PintarFilaCATPRO($id) {
        var $idfilaanterior = $("#IdFilaCATPRO").val()

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
        $("#IdFilaCATPRO").val($id)

    }



    function RegistrarCATPRO() {
        //validar_data();
        var $valor = $("#ValorCATPRO").val();
        var $id = $("#id_CATPRO").val();
        var $nombre = $("#CATPROnombre").val();


        if ($nombre == '') {
            swal("Ingrese Nombre ..", "Campo Obligatorio", "warning");
            $("#CATPROnombre").focus();
            return false;
        }
        

        $("#BtnGrabarCATPRO").prop("disabled", true);
        $.post("controlador/Clogistica.php", {accion: 'NUEVO_CAT', id: $id, nombre: $nombre, valor: $valor}, function (data) {
//            alert(data)
            $("#BtnGrabarCATPRO").prop("disabled", false);
            if (data == 2) {
                swal("Nombre ya existe ..", "Error", "error");
                return false;
            }
            if (data == 1) {
                $("#IdFilaCATPRO").val(0);
                swal("Datos registrados Correctamente ..", "Felicitaciones", "success");
                LisCATPRO();
                CerrarModalCATPRO();
                return false;
            }
            if (data == 0) {
                swal("Datos no registrados Correctamente ..", "Error", "error");
                return false;
            }

        })

    }

    function LlenarDatosCATPRO() {
        $("#ValorCATPRO").val(2)
        var $ident = $("#IdFilaCATPRO").val()
        var $id = $("#" + $ident).attr("idCATPRO")

        if ($ident == 0) {
            swal("Debe seleccionar un Registro", "Obligatorio", "warning");
            return false;
        }
        $.post("controlador/Clogistica.php", {accion: 'LLENAR_CAT', id: $id}, function (data) {
            $("#id_CATPRO").val(data.id);
            $("#CATPROnombre").val(data.nombre);
            $("#IdModalCATPRO").modal();
        }, 'JSON');



    }

    function limpiar_camposCATPRO() {
        $("#id_CATPRO,#CATPROnombre").val("");
     
    }

    function CerrarModalCATPRO() {
        $("#IdModalCATPRO").modal("hide");
    }

    function EliminarCATPRO() {
        swal({
            title: "Confirmacion",
            text: "Está seguro de Eliminar este Laboratorio",
            icon: "warning",
            buttons: true,
            dangerMode: true}).then((willDelete) => {
            if (willDelete) {
                var $ident = $("#IdFilaCATPRO").val()
                var $id = $("#" + $ident).attr("idCATPRO")
                $.post("controlador/Clogistica.php", {accion: 'ELIMINAR_CAT', id: $id}, function (data) {
                    if (data == 1) {
                        LisCATPRO();
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

    LisCATPRO();
