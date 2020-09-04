<table id="IdTblProv" border="1" bordercolor="#cccccc" >
    <thead>
        <tr style="font-size:14px">
            <Th >Nro</Th>
            <Th >Nombre</Th>
            <Th >Dirección</Th>
            <Th >Documento</Th>
            <Th >Contacto</Th>
            <Th >Teléfono </Th>
            <Th >Email</Th>

        </tr>
    </thead>
    <tbody id="TbodyProv" style="font-size:12px;"> </tbody>  	
</table>

<br>
<div class="row">
    <div class="col-lg-4 col-md-12">
        <div class="form-group">
            <!-- Simple Icon Button -->
            <button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="AbrirModalProv()"><i class="ft-plus"></i> Nuevo</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="LlenarDatosProv()"><i class="ft-edit-1"></i> Editar</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="EliminarProv()"><i class="ft-trash-2"></i> Eliminar</button>
        </div>
    </div>
    <div class="col-lg-5 col-md-12">
        <input type="text" class="form-control" onkeyup="LisProv()" placeholder="Buscar Laboratorio " id="TxtBuscarProv" >

    </div>
</div>


<div id="IdModalProv" class="modal fade" role="dialog" >

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                &nbsp; INGRESE PROVEEDOR </h4>

            </div>
            <div class="modal-body">
                <table  width="100%" style="font-size:13px; font-weight:bold;">
                    <tr style='display:none'>
                        <td>Id</td>
                        <td><input  type="text" id="id_prov" size="5" readonly="readonly" class="form-control"/></td>
                    </tr>

                    <tr>
                        <td><b>Nombre</b>
                            <input name ="nombre" type="text" id="PROVnombre"  class="form-control" value="" autocomplete="off"></td>
                    </tr>

                    <tr>
                        <td><b>Documento</b>
                            <input name ="documento" type="text" id="PROVdocumento"  class="form-control" value="" autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td><b>Dirección</b>
                            <input name ="direccion" type="text" id="PROVdireccion"  class="form-control" value="" autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td><b>Contacto</b>
                            <input name ="direccion" type="text" id="PROVcontacto"  class="form-control" value="" autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td><b>Teléfono</b>
                            <input type="text" id="PROVtelefono"  class="form-control numero" value="" autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td><b>Email</b>
                            <input  type="email" id="PROVemail"  class="form-control" value="" autocomplete="off"></td>
                    </tr>


                    <tr><td>&nbsp;</td></tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="BtnGrabarProv" class="btn bg-vino mr-1 mb-1" onClick="RegistrarProv()" > Grabar</button>
                <button type="button" class="btn bg-vino mr-1 mb-1" data-dismiss="modal"  > Cancelar</button>									
            </div>
        </div>
    </div>
</div>


<input type="hidden" id="IdFilaProv" value="0"  >
<input type="hidden" id="ValorProv" value="0"  >

<script >
    $(document).ready(function () {
        $("#IdModalProv").on('shown.bs.modal', function () {
            $(this).find('#nombre').focus();
        });
        $('#IdTblProv').fixheadertable({
            //caption	: 'Lista de Areas', 
            colratio: [15, 90, 130, 50, 50,50,30],
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

    function AbrirModalProv() {
        limpiar_camposProv();
        $("#ValorProv").val(1);
        $("#IdModalProv").modal()
    }

    function LisProv() {
        var $buscar = $("#TxtBuscarProv").val()
        $.post('controlador/Cfarmacia.php', {accion: "LIS_PROV", buscar: $buscar}, function (data) {
            $("#TbodyProv").html(data);
            $("#IdFilaProv").val(0);
        })
    }

    function PintarFilaProv($id) {
        var $idfilaanterior = $("#IdFilaProv").val()

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
        $("#IdFilaProv").val($id)

    }



    function RegistrarProv() {
        //validar_data();
        var $valor = $("#ValorProv").val();
        var $id = $("#id_prov").val();
        var $nombre = $("#PROVnombre").val().toUpperCase();
        var $direccion = $("#PROVdireccion").val();
        var $documento = $("#PROVdocumento").val();
        var $contacto = $("#PROVcontacto").val();
        var $telefono = $("#PROVtelefono").val();
        var $email = $("#PROVemail").val();


        if ($nombre == '') {
            swal("Ingrese Nombre ..", "Campo Obligatorio", "warning");
            $("#PROVnombre").focus();
            return false;
        }
        if ($direccion == '') {
            swal("Ingrese Dirección ..", "Campo Obligatorio", "warning");
            $("#PROVdireccion").focus();
            return false;
        }
        if ($documento == '') {
            swal("Ingrese Dirección .PROV.", "Campo Obligatorio", "warning");
            $("#PROVdocumento").focus();
            return false;
        }
        if ($contacto == '') {
            swal("Ingrese Dirección ..", "Campo Obligatorio", "warning");
            $("#PROVcontacto").focus();
            return false;
        }
        
        

        $("#BtnGrabarProv").prop("disabled", true);
        $.post("controlador/Cfarmacia.php", {accion: 'NUEVO_PROV', id: $id, nombre: $nombre,contacto:$contacto,documento:$documento, direccion: $direccion, telefono: $telefono, email: $email, valor: $valor}, function (data) {
       
            $("#BtnGrabarProv").prop("disabled", false);
//            alert(data);
            limpiar_camposProv();
            CerrarModalProv();
            if (data == 2) {
                swal("Nombre ya existe ..", "Error", "error");
                return false;
            }
            if (data == 1) {
                $("#IdFilaProv").val(0);
                swal("Datos registrados Correctamente ..", "Felicitaciones", "success");
                LisProv();
                CerrarModalProv();
                return false;
            }
            if (data == 0) {
                swal("Datos no registrados Correctamente ..", "Error", "error");
                return false;
            }

        })

    }

    function LlenarDatosProv() {
        $("#ValorProv").val(2)
        var $ident = $("#IdFilaProv").val()
        var $id = $("#" + $ident).attr("idprov")

        if ($ident == 0) {
            swal("Debe seleccionar un Registro", "Obligatorio", "warning");
            return false;
        }
        $.post("controlador/Cfarmacia.php", {accion: 'LLENAR_PROV', id: $id}, function (data) {
            $("#id_prov").val(data.id);
            $("#PROVnombre").val(data.nombre);
            $("#PROVdireccion").val(data.direccion);
            $("#PROVdocumento").val(data.documento);
            $("#PROVcontacto").val(data.contacto);
            $("#PROVtelefono").val(data.telefono);
            $("#PROVemail").val(data.email);
            $("#IdModalProv").modal();
        }, 'JSON')



    }

    function limpiar_camposProv() {
        $("#id_prov,#PROVnombre,#PROVdireccion,#PROVdocumento,#PROVtelefono,#PROVemail,#PROVcontacto").val("");
    }

    function CerrarModalProv() {
        $("#IdModalProv").modal("hide");
    }

    function EliminarProv() {
        swal({
            title: "Confirmacion",
            text: "Está seguro de Eliminar este Proveedor",
            icon: "warning",
            buttons: true,
            dangerMode: true}).then((willDelete) => {
            if (willDelete) {
                var $ident = $("#IdFilaProv").val()
                var $id = $("#" + $ident).attr("idprov")
                $.post("controlador/Cfarmacia.php", {accion: 'ELIMINAR_PROV', id: $id}, function (data) {
                    if (data == 1) {
                        LisProv();
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

    LisProv();
