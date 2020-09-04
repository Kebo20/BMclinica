

<link  rel="stylesheet" type="text/css"  href="assets/css/select2.min.css" />

<script src="assets/js/select2.full.min.js"   type="text/javascript"></script>
<table id="IdTblCom"  border="1" bordercolor="#cccccc" >
    <thead>
        <tr style="font-size:14px">
            <Th>Nro</Th>
            <Th>Fecha de compra</Th>
            <Th>Fecha </Th>
            <Th>Usuario</Th>
            <Th>Proveedor</Th>
            <Th>Tipo de documento</Th>
            <Th>N° documento</Th>
            <Th>Tipo de afectación</Th>
            <Th>Monto sin IGV</Th>
            <Th>IGV</Th>
            <Th>Monto IGV</Th>
            <Th>Total</Th>
            <Th>Tipo de compra</Th>
            <Th>N° dias</Th>
            <Th>Detalles</Th>
        </tr>
    </thead>
    <tbody id="IdCuerpoCom" style="font-size:12px;">  </tbody>  
</table>



<div id="ModalDetallesCompra" class="modal fade" role="dialog" >

    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <div class="modal-header"  id="NomMed">

                <h2><b> Detalle compra</h2>&nbsp;  

            </div>
            <div class="modal-body">
             
                <table id="IdTblDC"  border="1" bordercolor="#cccccc"  >
                    <thead>
                    <th >Nro</th>
                    <th >Producto</th>
                    <th >Bonificación</th>
                    <th >Vencimiento</th>
                    <th >Lote</th>
                    <th >Cantidad</th>
                    <th >Precio</th>
                    <th >Monto IGV</th>
                    <th >Subtotal</th>
                    <th >Precio anterior</th>
                    </thead>
                    <tbody id="CuerpoDetallesCompra"></tbody>
                </table>
            </div>
          
        </div>
    </div>
</div>

<input type="hidden" id="IdFilaCom" value="0"  >
<input type="hidden" id="ValorCom" value="0"  >
<input type="hidden" id="dni_ant" value="0"  >

<script>

    $(document).ready(function () {
      
        $('#IdTblCom').fixheadertable({
            colratio: [10, 20, 20, 20, 15, 15, 20,30, 30, 10, 30,30,20,15,10],
            height: 500,
            width: '100%',
            zebra: true,
            sortable: false,
            sortedColId: 3,
            pager: false,
            rowsPerPage: 10,
            resizeCol: false,
        });

             $('#IdTblDC').fixheadertable({
            colratio: [10, 10, 10, 10, 10, 10, 10,10, 10, 10],
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

    function PintarFilaCom($id) {
        var $idfilaanterior = $("#IdFilaCom").val()

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
        $("#IdFilaCom").val($id)


    }

    function LisCom() {
//        $buscar = $("#TxtBuscarMed").val();
        //$("#IdCuerpoMed").html("<tr><td colspan='7'> Cargando ..</td></tr>");
        $.post('controlador/Cfarmacia.php', {accion: "LIS_COM", buscar: ""}, function (data) {
            $("#IdCuerpoCom").html(data);
            $("#IdFilaCom").val(0);
            
        });
    }

    function AbrirModalDetalles($id_compra) {
        
        $.post('controlador/Cfarmacia.php', {accion: "LIS_COMPRA_DETALLE", compra: $id_compra}, function (data) {
            $("#CuerpoDetallesCompra").html(data);
        });
        $("#ModalDetallesCompra").modal();
    }


    LisCom();
</script>
