<link  rel="stylesheet" type="text/css"  href="assets/css/select2.min.css" />
<script src="assets/js/select2.full.min.js"   type="text/javascript"></script>
<?php
include 'cado/ClaseFarmacia.php';

$ofarmacia = new Farmacia();
$productos = $ofarmacia->ListarProducto("");
$proveedores = $ofarmacia->Listarproveedor("");
session_start();
?>
<div class="modal-body">

    <table  width="100%" style="font-size:12px; font-weight:bold;">
        

        <tr>
            <td  width="20%"><b>Fecha</b><input  type="date" id="EVfecha"  class="form-control" value="" style="width:95%" 
                                                 autocomplete="off" ></td>

            <td width="20%"><b>Tipo de documento</b>
                <select id="EVtipo_documento" class="form-control EVchosen-select" onchange="EVChangeTipoDoc()" style="width:95%" >
                    <option value="">Seleccione</option>
                    <option value="FA">FA</option>
                    <option value="BV">BV</option>
                    <option value="FA">FA</option>
                    <option value="DI">DI</option>
                    <option value="GR">GR</option>
                </select></td>
            <td width="20%"><b>N° de documento</b>
                <input type="text" id="EVnro_documento"  style="text-transform:uppercase;width:95%" class="form-control numero" value="" 
                       autocomplete="off" ></td>

            <td width="20%">
                <b>Afecto</b>

                <input type="radio" id="EVafecto" name="EVtipo_afectacion" onclick="EVClickAfecto()" class=" formulario" value="1" onchange="EVllenarIGV()">
                <b>Inafecto</b>
                <input type="radio" id="EVinafecto" onclick="EVClickInafecto()" name="EVtipo_afectacion" class=" formulario" value="2" onchange="EVllenarIGV()">
            </td>

        </tr>
        <tr>


<!--            <td width="20%">
        <b>IGV</b>

        <input type="checkbox" id="igv_detalle" class=""  onclick="listar();ClickIGV()">

    </td>-->

        </tr>

    </table>
    <hr>
    <table  width="100%" class="" style="font-size:12px; font-weight:bold;">


        <tr>
            <td  width="25%"><b>Producto</b><br>
                <select id="EVid_cmb_pro" class="form-control EVchosen-select" onchange="EVChangeProducto()" style="width: 95%" >
                    <option value="">Seleccione producto</option>
                    <?php foreach ($productos as $p) { ?>
                        <option id='<?= "EVpro_" . $p[0] ?>' nombre_producto='<?= $p[2] ?>'  value="<?= $p[0] ?>"><?= $p[2] . " - " . $p[7] ?></option>
                    <?php } ?>
                </select>
            </td>

            <td width="25%"><b>Precio(S/.)</b>
                <input type="text" id="EVprecio" readonly="" style="width:95%" class="form-control numero" value="" 
                       autocomplete="off"></td>
            <td width="20%"><b>Cantidad</b>
                <input type="number" id="EVcantidad"  style="width:95%" class="form-control numero" value="" 
                       autocomplete="off"></td>

            <td width="5%"> 
                <br>
                <button type="button" id="EVBtnGrabarSerie" style="width:95%" class="btn btn-xs bg-vino " onClick="EVAñadirDetalle()"><i class='ft-plus'></i></button><td>

        </tr>





    </table>


</div>
<div class="row" >
    <div class="col-9 pl-2" >
        <table id="IdTblVD" style="text-align:right;" border="1" bordercolor="#cccccc" >
            <thead>
                <tr style="font-size:13px">
                    <Th></Th>
                    <Th>Nro</Th>
                    <Th>Producto</Th>
                    <Th>Cant.</Th>
                    <Th>Prec. sin igv</Th>
                    <Th>Monto IGV</Th>
                    <Th>Subotal</Th>

                </tr>
            </thead>
            <tbody id="IdCuerpoVD" style="font-size:12px;">  </tbody>  
        </table>
    </div>
    <div class="col-3 pl-2" >
        <table  width="100%" style="font-size:18px; font-weight:bold;">

            <tr>
                <td><b>Monto sin IGV(S/.)</b><input  id="EVmonto_sin_igv" disabled="" style="font-size:16px; text-align:right;width:95%" class="form-control" autocomplete="off" ></td>


            </tr>
            <tr>
                <td colspan=""><b>Monto IGV(S/.)</b><input disabled="" id="EVmonto_igv_total" style="font-size:16px;text-align:right;  width:95%" class="form-control" autocomplete="off"></td>
            </tr>
            <tr>
                <td colspan=""><b>IGV</b><input disabled="" id="EVigv" style="font-size:16px;text-align:right;  width:95%" class="form-control" autocomplete="off"></td>
            </tr>


            <tr>
                <td colspan=""><b>Total(S/.)</b><input disabled="" id="EVtotal" style="font-size:16px;text-align:right;  width:95%" class="form-control" autocomplete="off"></td>
            </tr>

        </table>
    </div>
</div>
<br>
<div class="row"  >

    <div class="col-lg-8 col-md-12 " >
        <div class="form-group" >
            &nbsp;&nbsp;
            <button type="button" class="btn bg-vino cambio-color mr-1 mb-1" onClick="EVguardar()"><i class="ft-save" ></i> Guardar</button>
            <button type="button" class="btn  bg-vino mr-1 mb-1" onClick="EVcancelar()" ><i class="fa fa-crosshairs"></i>Cancelar</button>
        </div>
    </div>

</div>






<!--<input type="hidden" id="IdFilaMed" value="0"  >
<input type="hidden" id="ValorMed" value="0"  >
<input type="hidden" id="dni_ant" value="0"  >-->

<script>

    $(document).ready(function () {
        $("#EVfecha").focus();
        $('#IdTblVD').fixheadertable({
            colratio: [5, 15, 15, 15, 15, 15, 15],
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

        $('.EVchosen-select').chosen({allow_single_deselect: true});
        $(this).find('.chosen-container').css({width: "95%"});

        $('.numero').on("keypress", function () {
            if (event.keyCode > 47 && event.keyCode < 60 || event.keyCode == 46) {

            } else {
                event.preventDefault();
            }

        });
        $("#EVmonto_igv_total").val("0.00");
        $("#EVmonto_sin_igv").val("0.00");
        $("#EVtotal").val("0.00");
        $("#EVigv").val("0.00");
    });


</script>


<script>
    //DETALLE_venta
    var venta = new Array();



    function EVllenarIGV() {
        if ($('input:radio[name=EVtipo_afectacion]:checked').val() == "1") {
            $("#igv").val("0.18");
            $('input:radio[name=EVtipo_afectacion]:checked').val()
        }
        ;
        if ($('input:radio[name=EVtipo_afectacion]:checked').val() == "2") {
            $("#EVigv").val("0.00");
        }
        ;


        EVlistar();

    }

    function EVlistar() {
        $("#IdCuerpoVD").html("");
        console.log("");
        var EVstotal = 0;

        for (var i = 0; i < venta.length; i++) {


//Calculo del IGV
//.toFixed(2) RECORTA A DOS DECIMALES SIN REDONDEAR INCLUIDO ENTEROS .00

            venta[i].monto_igv = (Math.round(venta[i].precio * (0.18) * 100) / 100).toFixed(2);
            venta[i].subtotal = (Math.round((parseFloat(venta[i].precio * venta[i].cantidad)) * 100) / 100).toFixed(2);




            $("#IdCuerpoVD").append("<tr><td class='text-left'><a class='btn text-left' onclick='EVeliminar(" + i + ")'>\n\
            <icon class='ft-trash'> </icon></a></td><td>" + parseInt(i + 1) + "</td>\n\
            <td>" + venta[i].nombre_producto + "</td>\n\
            <td> " + venta[i].cantidad + "</td></td>\n\
            <td>S/. " + venta[i].precio + "</td>\n\
            <td>S/. " + venta[i].monto_igv + "</td>\n\
            <td>S/. " + venta[i].subtotal + "</td></tr>");


            EVstotal += parseFloat(venta[i].subtotal);

            console.log(venta[i]);

        }

        $("#EVmonto_sin_igv").val((Math.round(EVstotal * 100) / 100).toFixed(2));
        EVmonto_sin_igv = $("#EVmonto_sin_igv").val();
        EVigv = $("#EVigv").val();
        $("#EVmonto_igv_total").val((Math.round((EVmonto_sin_igv * EVigv) * 100) / 100).toFixed(2));
        EVmonto_igv_total = $("#EVmonto_igv_total").val();
        EVtotal = (Math.round((parseFloat(EVmonto_igv_total) + parseFloat(EVmonto_sin_igv)) * 100) / 100).toFixed(2);

        $("#EVtotal").val(EVtotal);


    }


    function EVAñadirDetalle() {


        if ($("#EVid_cmb_pro").val() == "") {
            swal("Campo requerido", "Seleccione un producto", "warning");
            $("#EVid_cmb_pro").focus();
            return false;

        }


        if ($("#EVcantidad").val() == "") {
            swal("Campo requerido", "Inserte una cantidad", "warning");
            $("#EVcantidad").focus();
            return false;

        }


        var EVid_producto = $("#EVid_cmb_pro").val();
        var EVseleccionado = $("#EVid_cmb_pro").val();

        var EVnombre_producto = $("#EVpro_" + EVseleccionado).attr("nombre_producto");

        var EVcantidad = $("#EVcantidad").val();
        var EVprecio = Math.round(parseFloat($("#EVprecio").val() * (100 / 118)) * 100) / 100;



        EVmonto_igv = "";
        EVsubtotal = "";
//        console.log(venta.length)

        for (var i = 0; i < venta.length; i++) {

            if (venta[i].id_producto == EVid_producto) {
                venta[i].cantidad = parseInt(venta[i].cantidad) + parseInt(EVcantidad);
//                EVlistar();

                $("#EVcantidad").val("");
                setTimeout(function () {
                    $("#EVid_cmb_pro").trigger('chosen:open');
                }, 200);
                return false;
            }
        }

        var EVdetalle = {id_producto: EVid_producto, nombre_producto: EVnombre_producto, cantidad: EVcantidad, precio: EVprecio, monto_igv: EVmonto_igv, subtotal: EVsubtotal};

        venta.push(EVdetalle);



        EVlistar();

        $("#EVcantidad").val("");
        setTimeout(function () {
            $("#EVid_cmb_pro").trigger('chosen:open');
        }, 200);


    }


    function EVeliminar(id) {

        venta.splice(id, 1);
        EVlistar();
    }

    function EVguardar() {

        if (venta.length == 0) {
            swal("Vacío", "Inserte datos", "warning");
            return false;
        }
        if ($("#EVfecha").val() == "") {
            swal("Campo requerido", "Inserte fecha", "warning");
            $("#EVfecha").focus();
            return false;

        }

        if ($("#EVtipo_documento").val() == "") {
            swal("Campo requerido", "Seleccione un tipo de documento", "warning");
            $("#EVtipo_documento").focus();
            return false;

        }
        if ($("#EVnro_documento").val() == "") {
            swal("Campo requerido", "Inserte número de documento", "warning");
            $("#EVnro_documento").focus();
            return false;

        }



        $.post("controlador/Cfarmacia.php", {

            accion: "NUEVO_VEN",
            venta: JSON.stringify(venta),
            fecha: $("#EVfecha").val(),
            tipo_documento: $("#EVtipo_documento").val(),
            nro_documento: $("#EVnro_documento").val(),
            tipo_afectacion: $("input:radio[name=EVtipo_afectacion]:checked").val(),
            monto_igv: $("#EVmonto_igv_total").val(),
            igv: $("#EVigv").val(),
            monto_sin_igv: $("#EVmonto_sin_igv").val(),
            total: $("#EVtotal").val()
        }, function (data) {
            EVcancelar();
            if (data.indexOf("OK") > -1) {
                swal("Correcto", "venta registrada correctamente", "success");
            } else {
                swal("Error", "venta no registrada ", "error");
            }

            console.log(data);

        });



    }


    function EVcancelar() {
        venta = new Array();


        $("#EVmonto_igv_total").val("0.00");
        $("#EVnro_documento").val("");

        $("#EVcantidad").val("");


        $("#EVmonto_sin_igv").val("0.00");

        $("#EVtotal").val("0.00");
        $("#EVfecha").val("");
        $("#EVigv").val("");
        setTimeout(function () {
            $("#EVid_cmb_pro").val("").trigger('chosen:updated');
        }, 200);

        setTimeout(function () {
            $("#EVtipo_documento").val("").trigger('chosen:updated');
        }, 200);

        EVlistar();

    }



    $("#EVfecha").keypress(function (e) {
        if (e.which == 13) {


            setTimeout(function () {
                $("#EVtipo_documento").trigger('chosen:open');
            }, 200);
        }
    });





    function EVChangeTipoDoc() {
        $("#EVnro_documento").focus();
    }

    $("#EVnro_documento").keypress(function (e) {
        if (e.which == 13) {
            $("#EVafecto").focus();
        }
    });

    function EVClickAfecto() {
        setTimeout(function () {
            $("#EVid_cmb_pro").trigger('chosen:open');
        }, 200);
    }

    function EVClickInafecto() {
        setTimeout(function () {
            $("#EVid_cmb_pro").trigger('chosen:open');
        }, 200);
    }



    function EVClickIGV() {
        setTimeout(function () {
            $("#EVid_cmb_pro").trigger('chosen:open');
        }, 200);
    }

    function EVChangeProducto() {
        $.post("controlador/Cfarmacia.php", {accion: "LLENAR_PRO", id: $("#EVid_cmb_pro").val()}, function (data) {

            $("#EVprecio").val(data.precio);
console.log(data);
        }, "JSON");

        $("#EVcantidad").focus();

    }


    $("#EVcantidad").keypress(function (e) {
        if (e.which == 13) {
            EVAñadirDetalle();
        }
    })



    $(document).keydown(function (tecla) {


        if (tecla.ctrlKey && tecla.keyCode == 83) {
            tecla.preventDefault();
            EVguardar();
        }

    });


</script>