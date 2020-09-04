<table id="IdTblLab" border="1" bordercolor="#cccccc" >
    <thead>
        <tr style="font-size:14px">
            <Th >Nro</Th>
            <Th >Nombre</Th>
            <Th >Dirección</Th>
            <Th >Teléfono #1</Th>
            <Th >Teléfono #2</Th>

        </tr>
    </thead>
    <tbody id="TbodyLab" style="font-size:12px;"> </tbody>  	
</table>

<br>
<div class="row">
    <div class="col-lg-4 col-md-12">
        <div class="form-group">
            <!-- Simple Icon Button -->
            <button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="AbrirModalLab()"><i class="ft-plus"></i> Nuevo</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="LlenarDatosLab()"><i class="ft-edit-1"></i> Editar</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="EliminarLab()"><i class="ft-trash-2"></i> Eliminar</button>
        </div>
    </div>
    <div class="col-lg-5 col-md-12">
        <input type="text" class="form-control" onkeyup="LisLab()" placeholder="Buscar Laboratorio " id="TxtBuscarLab" >

    </div>
</div>


<div id="IdModalLab" class="modal fade" role="dialog" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                &nbsp; INGRESE LABORATORIO </h4>

            </div>
            <div class="modal-body">
                <table  width="100%" style="font-size:13px; font-weight:bold;">
                    <tr style='display:none'>
                        <td>Id</td>
                        <td><input name ="id_lab" type="text" id="id_lab" size="5" readonly="readonly" class="form-control"/></td>
                    </tr>

                    <tr>
                        <td><b>Nombre</b>
                            <input name ="nombre" type="text" id="LABnombre"  class="form-control" value="" autocomplete="off"></td>
                    </tr>

                    <tr>
                        <td><b>Dirección</b>
                            <input name ="direccion" type="text" id="LABdireccion"  class="form-control" value="" autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td><b>Teléfono #1</b>
                            <input name ="tel1" type="text" id="LABtel1"  class="form-control" value="" autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td><b>Teléfono #2</b>
                            <input name ="tel2" type="text" id="LABtel2"  class="form-control" value="" autocomplete="off"></td>
                    </tr>


                    <tr><td>&nbsp;</td></tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="BtnGrabarLab" class="btn bg-vino mr-1 mb-1" onClick="RegistrarLab()" > Grabar</button>
                <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"  > Cancelar</button>									
            </div>
        </div>
    </div>
</div>


<input type="hidden" id="IdFilaLab" value="0"  >
<input type="hidden" id="ValorLab" value="0"  >

<script >
    $(document).ready(function () {
        $("#IdModalLab").on('shown.bs.modal', function () {
            $(this).find('#nombre').focus();
        });
        $('#IdTblLab').fixheadertable({
            //caption	: 'Lista de Areas', 
            colratio: [15, 90, 130, 50, 50],
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

    function AbrirModalLab() {
        limpiar_camposLab();
        $("#ValorLab").val(1);
        $("#IdModalLab").modal();
    }

    function LisLab() {
        var $buscar = $("#TxtBuscarLab").val()
        $.post('controlador/Cfarmacia.php', {accion: "LIS_LAB", buscar: $buscar}, function (data) {
            $("#TbodyLab").html(data);
            $("#IdFilaLab").val(0);
        })
    }

    function PintarFilaLab($id) {
        var $idfilaanterior = $("#IdFilaLab").val()

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
        $("#IdFilaLab").val($id)

    }



    function RegistrarLab() {
        //validar_data();
        var $valor = $("#ValorLab").val();
        var $id = $("#id_lab").val();
        var $nombre = $("#LABnombre").val();
        var $direccion = $("#LABdireccion").val();
        var $tel1 = $("#LABtel1").val();
        var $tel2 = $("#LABtel2").val();


        if ($nombre == '') {
            swal("Ingrese Nombre ..", "Campo Obligatorio", "warning");
            $("#LABnombre").focus();
            return false;
        }
        if ($direccion == '') {
            swal("Ingrese Dirección ..", "Campo Obligatorio", "warning");
            $("#LABlogin").focus();
            return false;
        }

        $("#BtnGrabarLab").prop("disabled", true);
        $.post("controlador/Cfarmacia.php", {accion: 'NUEVO_LAB', id: $id, nombre: $nombre, direccion: $direccion, tel1: $tel1, tel2: $tel2, valor: $valor}, function (data) {
//            alert(data)
            $("#BtnGrabarLab").prop("disabled", false);
            if (data == 2) {
                swal("Nombre ya existe ..", "Error", "error");
                return false;
            }
            if (data == 1) {
                $("#IdFilaLab").val(0);
                swal("Datos registrados Correctamente ..", "Felicitaciones", "success");
                LisLab();
                CerrarModalLab();
                return false;
            }
            if (data == 0) {
                swal("Datos no registrados Correctamente ..", "Error", "error");
                return false;
            }

        })

    }

    function LlenarDatosLab() {
        $("#ValorLab").val(2)
        var $ident = $("#IdFilaLab").val()
        var $id = $("#" + $ident).attr("idlab")

        if ($ident == 0) {
            swal("Debe seleccionar un Registro", "Obligatorio", "warning");
            return false;
        }
        $.post("controlador/Cfarmacia.php", {accion: 'LLENAR_LAB', id: $id}, function (data) {
            $("#id_lab").val(data.id);
            $("#LABnombre").val(data.nombre);
            $("#LABdireccion").val(data.direccion);
            $("#LABtel1").val(data.telefono1);
            $("#LABtel2").val(data.telefono2);
            $("#IdModalLab").modal()
        }, 'JSON')



    }

    function limpiar_camposLab() {
        $("#id_lab,#LABnombre,#LABdireccion,#LABtel1,#LABtel2").val("");
    }

    function CerrarModalLab() {
        $("#IdModalLab").modal("hide");
    }

    function EliminarLab() {
        swal({
            title: "Confirmacion",
            text: "Está seguro de Eliminar este Laboratorio",
            icon: "warning",
            buttons: true,
            dangerMode: true}).then((willDelete) => {
            if (willDelete) {
                var $ident = $("#IdFilaLab").val()
                var $id = $("#" + $ident).attr("idlab")
                $.post("controlador/Cfarmacia.php", {accion: 'ELIMINAR_LAB', id: $id}, function (data) {
                    if (data == 1) {
                        LisLab();
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

    LisLab();
