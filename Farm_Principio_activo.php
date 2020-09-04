<table id="IdTblPrin" border="1" bordercolor="#cccccc" >
    <thead>
        <tr style="font-size:14px">
            <Th>Nro</Th>
            <Th>Nombre</Th>

        </tr>
    </thead>
    <tbody id="TbodyPrin" style="font-size:12px;"> </tbody>  	
</table>

<br>
<div class="row">
    <div class="col-lg-4 col-md-12">
        <div class="form-group">
            <!-- Simple Icon Button -->
            <button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="AbrirModalPrin()"><i class="ft-plus"></i> Nuevo</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="LlenarDatosPrin()"><i class="ft-edit-1"></i> Editar</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="EliminarPrin()"><i class="ft-trash-2"></i> Eliminar</button>
        </div>
    </div>
    <div class="col-lg-5 col-md-12">
        <input type="text" class="form-control" onkeyup="LisPrin()" placeholder="Buscar Principio activo" id="TxtBuscarPrin" >

    </div>
</div>


<div id="IdModalPrin" class="modal fade" role="dialog" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                &nbsp; INGRESE PRINCIPIO ACTIVO </h4>

            </div>
            <div class="modal-body">
                <table  width="100%" style="font-size:13px; font-weight:bold;">
                    <tr style='display:none'>
                        <td>Id</td>
                        <td><input name ="id_prin" type="text" id="id_prin" size="5" readonly="readonly" class="form-control"/></td>
                    </tr>

                    <tr>
                        <td><b>Nombre</b>
                            <input name ="nombre" type="text" id="PRINnombre"  class="form-control" value="" autocomplete="off"></td>
                    </tr>




                    <tr><td>&nbsp;</td></tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="BtnGrabarPrin" class="btn bg-vino mr-1 mb-1" onClick="RegistrarPrin()" > Grabar</button>
                <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"  > Cancelar</button>									
            </div>
        </div>
    </div>
</div>


<input type="hidden" id="IdFilaPrin" value="0"  >
<input type="hidden" id="ValorPrin" value="0"  >

<script >
    $(document).ready(function () {
        $("#IdModalPrin").on('shown.bs.modal', function () {
            $(this).find('#nombre').focus();
        });
        $('#IdTblPrin').fixheadertable({
            //caption	: 'Lista de Areas', 
            colratio: [15, 130],
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

    function AbrirModalPrin() {
        limpiar_camposPrin();
        $("#ValorPrin").val(1);
        $("#IdModalPrin").modal()
    }

    function LisPrin() {
        var $buscar = $("#TxtBuscarPrin").val()
        $.post('controlador/Cfarmacia.php', {accion: "LIS_PRIN", buscar: $buscar}, function (data) {
            $("#TbodyPrin").html(data);
            $("#IdFilaPrin").val(0);
        })
    }

    function PintarFilaPrin($id) {
        var $idfilaanterior = $("#IdFilaPrin").val()

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
        $("#IdFilaPrin").val($id)

    }



    function RegistrarPrin() {
        //validar_data();
        var $valor = $("#ValorPrin").val();
        var $id = $("#id_prin").val();
        var $nombre = $("#PRINnombre").val();


        if ($nombre == '') {
            swal("Ingrese Nombre ..", "Campo Obligatorio", "warning");
            $("#PRINnombre").focus();
            return false;
        }


        $("#BtnGrabarPrin").prop("disabled", true);
        $.post("controlador/Cfarmacia.php", {accion: 'NUEVO_PRIN', id: $id, nombre: $nombre, valor: $valor}, function (data) {
//            alert(data)
            $("#BtnGrabarPrin").prop("disabled", false);
            if (data == 2) {
                swal("Nombre ya existe ..", "Error", "error");
                return false;
            }
            if (data == 1) {
                $("#IdFilaPrin").val(0);
                swal("Datos registrados Correctamente ..", "Felicitaciones", "success");
                LisPrin();
                CerrarModalPrin();
                return false;
            }
            if (data == 0) {
                swal("Datos no registrados Correctamente ..", "Error", "error");
                return false;
            }

        })

    }

    function LlenarDatosPrin() {
        $("#ValorPrin").val(2)
        var $ident = $("#IdFilaPrin").val()
        var $id = $("#" + $ident).attr("idPrin")

        if ($ident == 0) {
            swal("Debe seleccionar un Registro", "Obligatorio", "warning");
            return false;
        }
        $.post("controlador/Cfarmacia.php", {accion: 'LLENAR_PRIN', id: $id}, function (data) {
            $("#id_prin").val(data.id);
            $("#PRINnombre").val(data.nombre);

            $("#IdModalPrin").modal()
        }, 'JSON')



    }

    function limpiar_camposPrin() {
        $("#id_prin,#PRINnombre").val("");
    }

    function CerrarModalPrin() {
        $("#IdModalPrin").modal("hide");
    }

    function EliminarPrin() {
        swal({
            title: "Confirmacion",
            text: "Está seguro de Eliminar este principio activo",
            icon: "warning",
            buttons: true,
            dangerMode: true}).then((willDelete) => {
            if (willDelete) {
                var $ident = $("#IdFilaPrin").val()
                var $id = $("#" + $ident).attr("idprin")
                $.post("controlador/Cfarmacia.php", {accion: 'ELIMINAR_PRIN', id: $id}, function (data) {
                    if (data == 1) {
                        LisPrin();
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

    LisPrin();
