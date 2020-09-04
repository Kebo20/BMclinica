<?php

require_once '../cado/ClaseLogistica.php';
date_default_timezone_set('America/Lima');
session_start();

$accion = $_POST["accion"];
$olog = new Logistica();
//ALMACEN
if ($accion == "LIS_ALM") {
    $nombre = $_POST["buscar"];
    $lista = $olog->ListarAlmacen($nombre);
    $tbl = "";
    $i = 0;
    foreach ($lista as $alm) {
        $i++;
        $id = 'TblAlm_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }

        $tbl .= "<tr id='$id' idALM='$alm[0]'  $color onclick=\"PintarFilaALM('$id')\">"
                . "<td >$i</td>"
                . "<td >$alm[1]</td>"
                . "<td >$alm[2]</td>"
                . "<td align='center'>$alm[3]</td>"
                . "<td align='center'>$alm[7]</td>"
                . "<td align='center'>$alm[6]</td>"
                . "</tr>";
    }

    echo $tbl;
}
if ($accion == 'LLENAR_ALM') {
    $id = $_POST['id'];
    $listar = $olog->ListarAlmacenxid($id);
    echo json_encode($listar->fetch());
}
if ($accion == 'LISTAR_ALMxSUC') {
    $sucursal = $_POST['sucursal'];
    $tipo = $_POST['tipo'];
    $listar = $olog->ListarAlmacenxSucursal($sucursal, $tipo);
    $opt = "<option value=''>Seleccione</option>";
    foreach ($listar as $a) {

        $opt .= "<option value='$a[0]'>$a[1]</option>";
    }

    echo $opt;
}
if ($accion == 'NUEVO_ALM') {
    $nombre = $_POST['nombre'];
    $responsable = $_POST['responsable'];
    $correo = $_POST['correo'];
    $sucursal = $_POST['sucursal'];
    $tipo = $_POST['tipo'];
    $valor = $_POST['valor'];
    $validar = $olog->ValidarAlmacen($nombre)->fetch();

    $can = $validar[0];
    // si el valor es igual a 1 insertamos
    if ($valor == 1) {
        if ($can == 0) {

            $insertar = $olog->RegistrarAlmacen($nombre, $responsable, $correo, $sucursal, $tipo);
            echo $insertar;
        } else
            echo 2;exit;
    }
    // si el valor es igual a 2 modificamos
    if ($valor == 2) {
        $id = $_POST["id"];

        $modificar = $olog->ModificarAlmacen($id, $nombre, $responsable, $correo, $sucursal, $tipo);
        echo $modificar;
    }
}
if ($accion == 'ELIMINAR_ALM') {
    $id = $_POST['id'];

    $eliminar = $olog->EliminarAlmacen($id);
    echo $eliminar;
}
//CATEGORIA
if ($accion == "LIS_CAT") {
    $nombre = $_POST["buscar"];
    $lista = $olog->ListarCategoriaProducto($nombre);
    $tbl = "";
    $i = 0;
    foreach ($lista as $cat) {
        $i++;
        $id = 'TblCatPro_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }

        $tbl .= "<tr id='$id' idCATPRO='$cat[0]'  $color onclick=\"PintarFilaCATPRO('$id')\">"
                . "<td >$i</td>"
                . "<td >$cat[1]</td>"
                . "</tr>";
    }

    echo $tbl;
}
if ($accion == 'LLENAR_CAT') {
    $id = $_POST['id'];
    $listar = $olog->ListarCategoriaProductoxid($id);
    echo json_encode($listar->fetch());
}
if ($accion == 'NUEVO_CAT') {
    $nombre = $_POST['nombre'];

    $valor = $_POST['valor'];
    $validar = $olog->ValidarCategoriaProducto($nombre)->fetch();

    $can = $validar[0];
    // si el valor es igual a 1 insertamos
    if ($valor == 1) {
        if ($can == 0) {

            $insertar = $olog->RegistrarCategoriaProducto($nombre);
            echo $insertar;
        } else
            echo 2;exit;
    }
    // si el valor es igual a 2 modificamos
    if ($valor == 2) {
        $id = $_POST["id"];

        $modificar = $olog->ModificarCategoriaProducto($id, $nombre);
        echo $modificar;
    }
}
if ($accion == 'ELIMINAR_CAT') {
    $id = $_POST['id'];

    $eliminar = $olog->EliminarCategoriaProducto($id);
    echo $eliminar;
}
//PRODUCTO
if ($accion == "LIS_PRO") {
    $nombre = $_POST["buscar"];
    $lista = $olog->ListarProductoLog($nombre);
    $tbl = "";
    $i = 0;
    foreach ($lista as $pro) {
        $i++;
        $id = 'TblLogPro_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }

        $tbl .= "<tr id='$id' idLOGPRO='$pro[0]'  $color onclick=\"PintarFilaLOGPRO('$id')\">"
                . "<td >$i</td>"
                . "<td >$pro[1]</td>"
                . "<td >$pro[2]</td>"
                . "<td >$pro[3]</td>"
                . "<td >$pro[4]</td>"
                . "<td >$pro[5]</td>"
                . "<td >$pro[6]</td>"
                . "</tr>";
    }

    echo $tbl;
}

if ($accion == "LISTAR_PRO_OC") {
    $lista = $olog->ListarProductoLog("");
    $tbl = "<option value=''>Seleccione</option>";
    $i = 0;
    foreach ($lista as $pro) {
        
        $tbl.="<option value='$pro[0]'>$pro[2]</option>";
    }

    echo $tbl;
}


if ($accion == 'LLENAR_PRO') {
    $id = $_POST['id'];
    $listar = $olog->ListarProductoLogxid($id);
    echo json_encode($listar->fetch());
}
if ($accion == 'NUEVO_PRO') {
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $unidad = $_POST['unidad'];
    $stock_min = $_POST['stock_min'];
    $stock_max = $_POST['stock_max'];
    $tipo_producto = $_POST['tipo_producto'];

    $valor = $_POST['valor'];
    $validar = $olog->ValidarProductoLog($nombre)->fetch();

    $can = $validar[0];
    // si el valor es igual a 1 insertamos
    if ($valor == 1) {
        if ($can == 0) {

            $insertar = $olog->RegistrarProductoLog($nombre, $categoria, $unidad, $stock_min, $stock_max, $tipo_producto);
            echo $insertar;
        } else
            echo 2;exit;
    }
    // si el valor es igual a 2 modificamos
    if ($valor == 2) {
        $id = $_POST["id"];

        $modificar = $olog->ModificarProductoLog($id, $nombre, $categoria, $unidad, $stock_min, $stock_max, $tipo_producto);
        echo $modificar;
    }
}
if ($accion == 'ELIMINAR_PRO') {
    $id = $_POST['id'];

    $eliminar = $olog->EliminarProductoLog($id);
    echo $eliminar;
}



//Orden de Compra

if ($accion == "NUEVO_ORD_COM") {

    $detalles_orden_compra = json_decode($_POST["orden_compra"], true);
    $fecha = $_POST['fecha'];
    $nro = $_POST['nro'];
    $sucursal = $_POST['sucursal'];
    $tipo = $_POST['tipo'];
    $almacen = $_POST['almacen'];
    $referencia = $_POST['referencia'];
    $tipo_producto = $_POST['tipo_producto'];
    $valor = $_POST['valor'];
    $validar = $olog->ValidarOrdenCompra($nro)->fetch();

    $can = $validar[0];
    // si el valor es igual a 1 insertamos
    if ($valor == 1) {
        if ($can == 0) {

            $insertar = $olog->RegistrarOrdenCompra($detalles_orden_compra, $nro, $fecha, $sucursal, $tipo, $almacen, $referencia, $tipo_producto);
            echo $insertar;
        } else
            echo 2;exit;
    }
    // si el valor es igual a 2 modificamos
    if ($valor == 2) {
        $id = $_POST["id"];
        $modificar = $olog->ModificarOrdenCompra($id, $detalles_orden_compra, $nro, $fecha, $sucursal, $tipo, $almacen, $referencia, $tipo_producto);
        echo $modificar;
    }
}

if ($accion == "LIS_ORD_COM") {
    $nro = $_POST["nro"];
    $fecha = $_POST["fecha"];
    $estado = $_POST["estado"];
    $almacen = $_POST["almacen"];

    $where = array();
    $where2 = "";
    if ($nro != "" || $fecha != "" || $estado != "" || $almacen != "") {
        $where2 = " where ";
    }
    if ($nro != "") {
        $where[] = " o.numero='$nro' ";
    }
    if ($fecha != "") {
        $where[] = " o.fecha='$fecha'";
    }
    if ($estado != "") {
        $where[] = " o.estado='$estado'";
    }
    if ($almacen != "") {

        $where[] = " o.id_almacen='$almacen'";
    }



    $where2 .= implode(" and ", $where);

    $lista = $olog->ListarOrdenCompra($where2);
    $tbl = "";
    $i = 0;
    foreach ($lista as $o) {
        $i++;
        $id = 'TblOC_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }
        $estado = "$o[5]";
        if ($o[5] == "pendiente") {
            $estado = "<btn class='btn bg-green text-white' >$o[5]</btn>";
        }
        if ($o[5] == "anulada") {
            $estado = "<btn class='btn bg-red text-white' >$o[5]</btn>";
        }
        if ($o[5] == "finalizada") {
            $estado = "<btn class='btn bg-blue text-white' >$o[5]</btn>";
        }

        $tbl .= "<tr id='$id' idOC='$o[0]'  $color onclick=\"PintarFilaOC('$id')\">"
                . "<td >$i</td>"
                . "<td >$o[1]</td>"
                . "<td >$o[2]</td>"
                . "<td >$o[3]</td>"
                . "<td >$o[4]</td>"
                . "<td align='center' >$estado</td>"
                . "</tr>";
    }

    echo $tbl;
}


if ($accion == "LIS_ORD_COMxnro") {
    $nro = $_POST["nro"];


    $where = array();
    $where2 = "";
    if ($nro != "") {
        $where2 = " where ";
    }
    if ($nro != "") {
        $where[] = " o.numero='$nro' ";
    }


    $where2 .= implode(" and ", $where);

    $lista = $olog->ListarOrdenCompra($where2);
    $tbl = "";
    $i = 0;
    foreach ($lista as $o) {
        $i++;
        $id = 'TblECOC_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }


        $tbl .= "<tr id='$id' idECOC='$o[0]' tipoECOC=''  $color onclick=\"PintarFilaECOC('$id')\">"
                . "<td >$i</td>"
                . "<td >$o[3]</td>"
                . "<td >$o[2]</td>"
                . "</tr>";
    }

    echo $tbl;
}


if ($accion == 'LLENAR_ORD_COM') {
    $id = $_POST['id'];
    $listar = $olog->ListarOrdenCompraxId($id);
    echo json_encode($listar->fetch());
}
if ($accion == 'LLENAR_ORD_COM_DET') {
    $id = $_POST['id'];

    $orden_compra = $olog->ListarOrdenCompraxId($id)->fetch();

    $tipo = $orden_compra["tipo"];
    if ($tipo == "logística") {
        $listar = $olog->ListarOrdenComprDetallesLog($id);
    }
    if ($tipo == "farmacia") {
        $listar = $olog->ListarOrdenComprDetallesFarm($id);
    }

    echo json_encode($listar->fetchAll());
}
if ($accion == 'ESTADO_ORD_COM') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    $actualizar = $olog->EstadoOrdenCompra($id, $estado);
    echo $actualizar;
}

