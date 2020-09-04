<table id="IdTblFam" border="1" bordercolor="#cccccc" >
    <thead>
        <tr style="font-size:14px">
            <Th>Nro</Th>
            <Th>Nombre</Th>

        </tr>
    </thead>
    <tbody id="TbodyFam" style="font-size:12px;"> </tbody>  	
</table>

<br>
<div class="row">
    <div class="col-lg-4 col-md-12">
        <div class="form-group">
            <!-- Simple Icon Button -->
            <button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="AbrirModalFam()"><i class="ft-plus"></i> Nuevo</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="LlenarDatosFam()"><i class="ft-edit-1"></i> Editar</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="EliminarFam()"><i class="ft-trash-2"></i> Eliminar</button>
        </div>
    </div>
    <div class="col-lg-5 col-md-12">
        <input type="text" class="form-control" onkeyup="LisFam()" placeholder="Buscar Familia" id="TxtBuscarFam" >

    </div>
</div>


<div id="IdModalFam" class="modal fade" role="dialog" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                &nbsp; INGRESE FAMILIA </h4>

            </div>
            <div class="modal-body">
                <table  width="100%" style="font-size:13px; font-weight:bold;">
                    <tr style='display:none'>
                        <td>Id</td>
                        <td><input name ="id_fam" type="text" id="id_fam" size="5" readonly="readonly" class="form-control"/></td>
                    </tr>

                    <tr>
                        <td><b>Nombre</b>
                            <input name ="nombre" type="text" id="FAMnombre"  class="form-control" value="" autocomplete="off"></td>
                    </tr>




                    <tr><td>&nbsp;</td></tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="BtnGrabarFam" class="btn bg-vino mr-1 mb-1" onClick="RegistrarFam()" > Grabar</button>
                <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"  > Cancelar</button>									
            </div>
        </div>
    </div>
</div>


<input type="hidden" id="IdFilaFam" value="0"  >
<input type="hidden" id="ValorFam" value="0"  >

<script >
    $(document).ready(function () {
        $("#IdModalFam").on('shown.bs.modal', function () {
            $(this).find('#nombre').focus();
        });
        $('#IdTblFam').fixheadertable({
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

    function AbrirModalFam() {
        limpiar_camposFam();
        $("#ValorFam").val(1);
        $("#IdModalFam").modal()
    }

    function LisFam() {
        var $buscar = $("#TxtBuscarFam").val()
        $.post('controlador/Cfarmacia.php', {accion: "LIS_FAM", buscar: $buscar}, function (data) {
            $("#TbodyFam").html(data);
            $("#IdFilaFam").val(0);
        })
    }

    function PintarFilaFam($id) {
        var $idfilaanterior = $("#IdFilaFam").val()

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
        $("#IdFilaFam").val($id)

    }



    function RegistrarFam() {
        //validar_data();
        var $valor = $("#ValorFam").val();
        var $id = $("#id_fam").val();
        var $nombre = $("#FAMnombre").val();


        if ($nombre == '') {
            swal("Ingrese Nombre ..", "Campo Obligatorio", "warning");
            $("#nombre").focus();
            return false;
        }


        $("#BtnGrabarFam").prop("disabled", true);
        $.post("controlador/Cfarmacia.php", {accion: 'NUEVO_FAM', id: $id, nombre: $nombre, valor: $valor}, function (data) {
//            alert(data)
            $("#BtnGrabarFam").prop("disabled", false);
            if (data == 2) {
                swal("Nombre ya existe ..", "Error", "error");
                return false;
            }
            if (data == 1) {
                $("#IdFilaFam").val(0);
                swal("Datos registrados Correctamente ..", "Felicitaciones", "success");
                LisFam();
                CerrarModalFam();
                return false;
            }
            if (data == 0) {
                swal("Datos no registrados Correctamente ..", "Error", "error");
                return false;
            }

        })

    }

    function LlenarDatosFam() {
        $("#ValorFam").val(2)
        var $ident = $("#IdFilaFam").val()
        var $id = $("#" + $ident).attr("idfam")

        if ($ident == 0) {
            swal("Debe seleccionar un Registro", "Obligatorio", "warning");
            return false;
        }
        $.post("controlador/Cfarmacia.php", {accion: 'LLENAR_FAM', id: $id}, function (data) {
            $("#id_fam").val(data.id);
            $("#FAMnombre").val(data.nombre);

            $("#IdModalFam").modal()
        }, 'JSON')



    }

    function limpiar_camposFam() {
        $("#id_fam,#FAMnombre").val("");
    }

    function CerrarModalFam() {
        $("#IdModalFam").modal("hide");
    }

    function EliminarFam() {
        swal({
            title: "Confirmacion",
            text: "Está seguro de Eliminar esta familia",
            icon: "warning",
            buttons: true,
            dangerMode: true}).then((willDelete) => {
            if (willDelete) {
                var $ident = $("#IdFilaFam").val()
                var $id = $("#" + $ident).attr("idfam")
                $.post("controlador/Cfarmacia.php", {accion: 'ELIMINAR_FAM', id: $id}, function (data) {
                    if (data == 1) {
                        LisFam();
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

    LisFam();
