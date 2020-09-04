
<link  rel="stylesheet" type="text/css"  href="assets/css/select2.min.css" />

<script src="assets/js/select2.full.min.js"   type="text/javascript"></script>
<table id="IdTblVen"  border="1" bordercolor="#cccccc" >
    <thead>
        <tr style="font-size:14px">
            <Th>Nro</Th>
            <Th>Fecha de venta</Th>
            <Th>Fecha </Th>
            <Th>Usuario</Th>
            <Th>Tipo de documento</Th>
            <Th>Nro documento</Th>
            <Th>Tipo de afectación</Th>
            <Th>Monto sin IGV</Th>
            <Th>IGV</Th>
            <Th>Monto IGV</Th>
            <Th>Total</Th>
            <Th>Detalles</Th>
        </tr>
    </thead>
    <tbody id="IdCuerpoVen" style="font-size:12px;">  </tbody>  
</table>




<div id="ModalDetallesVenta" class="modal fade" role="dialog" >

    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header"  id="NomMed">

                <h2><b> Detalle venta</h2>&nbsp;  

            </div>
            <div class="modal-body">
             
                <table id="IdTblDV" border="1" bordercolor="#cccccc">
                    <thead>
                    <th width="10%">Nro</th>
                    <th width="10%">Producto</th>
                    <th width="10%">Cantidad</th>
                    <th width="10%">Precio</th>
                    <th width="10%">Monto IGV</th>
                    <th width="10%">Subtotal</th>
                    </thead>
                    <tbody id="CuerpoDetallesVenta"></tbody>
                </table>
            </div>
          
        </div>
    </div>
</div>

<input type="hidden" id="IdFilaVen" value="0"  >
<input type="hidden" id="ValorVen" value="0"  >
<input type="hidden" id="dni_ant" value="0"  >

<script>

    $(document).ready(function () {
      
        $('#IdTblVen').fixheadertable({
            colratio: [10, 20, 20, 20, 20, 20, 20,20, 20, 20, 20,20],
            height: 500,
            width: '100%',
            zebra: true,
            sortable: false,
            sortedColId: 3,
            pager: false,
            rowsPerPage: 10,
            resizeCol: false,
        });

        $('#IdTblDV').fixheadertable({
            colratio: [10, 20, 20, 20, 20, 20],
            height: 200,
            width: '100%',
            zebra: true,
            sortable: false,
            sortedColId: 3,
            pager: false,
            rowsPerPage: 10,
            resizeCol: false,
        });

//        $("#TxtBuscarMed").keypress(function (e) {
//            if (e.which == 13) {
//                LisMed()
//            }
//        })
    
    });

    function PintarFilaVen($id) {
        var $idfilaanterior = $("#IdFilaVen").val()

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
            "background-color": "#D2E0f2",
            "color": "#4c4e7e"
        })
        $("#IdFilaVen").val($id)


    }

    function LisVen() {
//        $buscar = $("#TxtBuscarMed").val();
        //$("#IdCuerpoMed").html("<tr><td colspan='7'> Cargando ..</td></tr>");
        $.post('controlador/Cfarmacia.php', {accion: "LIS_VEN", buscar: ""}, function (data) {
            $("#IdCuerpoVen").html(data);
            $("#IdFilaVen").val(0);
            console.log(data);
        })
    }

    function AbrirModalDetalles($id_venta) {
//        $("#NomMed").text("ASIGNAR ESPECIALIDAD: " + $nom_med);
        
        $.post('controlador/Cfarmacia.php', {accion: "LIS_VENTA_DETALLE", venta: $id_venta}, function (data) {
            $("#CuerpoDetallesVenta").html(data);
        })
        $("#ModalDetallesVenta").modal();
    }


    LisVen();
</script>





