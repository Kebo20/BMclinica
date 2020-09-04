<?php

require_once '../cado/ClaseFarmacia.php';
date_default_timezone_set('America/Lima');
session_start();

$accion = $_POST["accion"];
//$accion = "LIS_VEN";
$ofarm = new Farmacia();
//LABORATORIO
if ($accion == "LIS_LAB") {
    $nombre = $_POST["buscar"];
    $ofarm = new Farmacia();
    $lista = $ofarm->ListarLaboratorio($nombre);
    $tbl = "";
    $i = 0;
    foreach ($lista as $lab) {
        $i++;
        $id = 'TblLab_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }

        $tbl .= "<tr id='$id' idlab='$lab[0]' nombre='$lab[1]' direccion='$lab[2]' tel1='$lab[3]' tel2='$lab[4]' $color onclick=\"PintarFilaLab('$id')\">"
                . "<td >$i</td>"
                . "<td >$lab[1]</td>"
                . "<td >$lab[2]</td>"
                . "<td align='center'>$lab[3]</td>"
                . "<td align='center'>$lab[4]</td>"
                . "</tr>";
    }

    echo $tbl;
}
if ($accion == 'LLENAR_LAB') {
    $id = $_POST['id'];
    $ofarm1 = new Farmacia();
    $listar = $ofarm1->ListarLabxid($id);
    echo json_encode($listar->fetch());
}
if ($accion == 'NUEVO_LAB') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $tel1 = $_POST['tel1'];
    $tel2 = $_POST['tel2'];
    $valor = $_POST['valor'];
    $ofarm2 = new Farmacia();
    $validar = $ofarm2->ValidarLaboratorio($nombre)->fetch();

    $can = $validar[0];
    // si el valor es igual a 1 insertamos
    if ($valor == 1) {
        if ($can == 0) {

            $insertar = $ofarm2->RegistrarLaboratorio($nombre, $direccion, $tel1, $tel2);
            echo $insertar;
        } else
            echo 2;exit;
    }
    // si el valor es igual a 2 modificamos
    if ($valor == 2) {
        $id = $_POST["id"];

        $modificar = $ofarm2->ModificarLaboratorio($id, $nombre, $direccion, $tel1, $tel2);
        echo $modificar;
    }
}
if ($accion == 'ELIMINAR_LAB') {
    $id = $_POST['id'];
    $ofarm3 = new Farmacia();

    $eliminar = $ofarm3->EliminarLaboratorio($id);
    echo $eliminar;
}



//FAMILIA
if ($accion == "LIS_FAM") {
    $nombre = $_POST["buscar"];
    $ofarm4 = new Farmacia();
    $lista = $ofarm4->ListarFamilia($nombre);
    $tbl = "";
    $i = 0;
    foreach ($lista as $fam) {
        $i++;
        $id = 'TblFam_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }

        $tbl .= "<tr id='$id' idfam='$fam[0]' nombre='$fam[1]'  $color onclick=\"PintarFilaFam('$id')\">"
                . "<td >$i</td>"
                . "<td >$fam[1]</td>"
                . "</tr>";
    }

    echo $tbl;
}

if ($accion == 'LLENAR_FAM') {
    $id = $_POST['id'];
    $ofarm5 = new Farmacia();
    $listar = $ofarm5->ListarFamiliaxid($id);
    echo json_encode($listar->fetch());
}
if ($accion == 'NUEVO_FAM') {
    $nombre = $_POST['nombre'];

    $valor = $_POST['valor'];
    $ofarm6 = new Farmacia();
    $validar = $ofarm6->ValidarFamilia($nombre)->fetch();

    $can = $validar[0];
    // si el valor es igual a 1 insertamos
    if ($valor == 1) {
        if ($can == 0) {

            $insertar = $ofarm6->RegistrarFamilia($nombre);
            echo $insertar;
        } else
            echo 2;exit;
    }
    // si el valor es igual a 2 modificamos
    if ($valor == 2) {
        $id = $_POST["id"];

        $modificar = $ofarm6->ModificarFamilia($id, $nombre);
        echo $modificar;
    }
}

if ($accion == 'ELIMINAR_FAM') {
    $id = $_POST['id'];
    $ofarm7 = new Farmacia();

    $eliminar = $ofarm7->EliminarFamilia($id);
    echo $eliminar;
}


//PRINCIPIO ACTIVO
if ($accion == "LIS_PRIN") {
    $nombre = $_POST["buscar"];
    $ofarm8 = new Farmacia();
    $lista = $ofarm8->ListarPrincipio($nombre);
    $tbl = "";
    $i = 0;
    foreach ($lista as $prin) {
        $i++;
        $id = 'TblPrin_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }

        $tbl .= "<tr id='$id' idprin='$prin[0]' nombre='$prin[1]'  $color onclick=\"PintarFilaPrin('$id')\">"
                . "<td >$i</td>"
                . "<td >$prin[1]</td>"
                . "</tr>";
    }

    echo $tbl;
}

if ($accion == 'LLENAR_PRIN') {
    $id = $_POST['id'];
    $ofarm9 = new Farmacia();
    $listar = $ofarm9->ListarPrincipioxid($id);
    echo json_encode($listar->fetch());
}
if ($accion == 'NUEVO_PRIN') {
    $nombre = $_POST['nombre'];

    $valor = $_POST['valor'];
    $ofarm10 = new Farmacia();
    $validar = $ofarm10->ValidarPrincipio($nombre)->fetch();

    $can = $validar[0];
    // si el valor es igual a 1 insertamos
    if ($valor == 1) {
        if ($can == 0) {

            $insertar = $ofarm10->RegistrarPrincipio($nombre);
            echo $insertar;
        } else
            echo 2;exit;
    }
    // si el valor es igual a 2 modificamos
    if ($valor == 2) {
        $id = $_POST["id"];

        $modificar = $ofarm10->ModificarPrincipio($id, $nombre);
        echo $modificar;
    }
}

if ($accion == 'ELIMINAR_PRIN') {
    $id = $_POST['id'];
    $ofarm11 = new Farmacia();

    $eliminar = $ofarm11->EliminarPrincipio($id);
    echo $eliminar;
}

//PRODUCTO

if ($accion == "LIS_PRO") {
    $nombre = $_POST["buscar"];
    $ofarm12 = new Farmacia();
    $lista = $ofarm12->ListarProducto($nombre);
    $tbl = "";
    $i = 0;
    foreach ($lista as $pro) {
        $i++;
        $id = 'TblPro_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }

        $tbl .= "<tr id='$id' idpro='$pro[0]' nombre='$pro[2]'  $color onclick=\"PintarFilaPro('$id')\">"
                . "<td >$i</td>"
                . "<td >$pro[1]</td>"
                . "<td >$pro[2]</td>"
                . "<td >$pro[3]</td>"
                . "<td >$pro[4]</td>"
                . "<td >$pro[5]</td>"
                . "<td >$pro[6]</td>"
                . "<td >$pro[7]</td>"
                . "<td >$pro[8]</td>"
                . "<td >$pro[9]</td>"
                . "<td >$pro[10]</td>"
                . "<td >$pro[11]</td>"
                . "<td >$pro[12]</td>"
                . "<td >$pro[13]</td>"
                . "</tr>";
    }

    echo $tbl;
}


if ($accion == "LISTAR_PRO_OC") {
    $lista = $ofarm->ListarProducto("");
    $tbl = "<option value=''>Seleccione</option>";
    $i = 0;
    foreach ($lista as $pro) {
        
        $tbl.="<option value='$pro[0]'>$pro[2]</option>";
    }

    echo $tbl;
}

if ($accion == 'NUEVO_PRO') {
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $precio = $_POST['precio'];
    $precio_compra = $_POST['precio_compra'];
    $stock_min = $_POST['stock_min'];
    $stock_max = $_POST['stock_max'];
    $familia = $_POST['familia'];
    $laboratorio = $_POST['laboratorio'];
    $principio = $_POST['principio'];
    $tipo_producto = $_POST['tipo_producto'];
    $tipo_medicamento = $_POST['tipo_medicamento'];
    $coddig = $_POST['codigodig'];
    $tipo_afectacion = $_POST['tipo_afectacion'];


    $valor = $_POST['valor'];
    $ofarm12 = new Farmacia();
    $validar = $ofarm12->ValidarProducto($nombre)->fetch();

    $can = $validar[0];
    // si el valor es igual a 1 insertamos
    if ($valor == 1) {
        if ($can == 0) {

            $insertar = $ofarm12->RegistrarProducto($codigo, $nombre, $precio, $precio_compra, $coddig, $familia,
                    $laboratorio, $principio, $stock_min, $stock_max, $tipo_producto, $tipo_medicamento, $tipo_afectacion);
            echo $insertar;
        } else
            echo 2;exit;
    }
    // si el valor es igual a 2 modificamos
    if ($valor == 2) {
        $id = $_POST["id"];

        $modificar = $ofarm12->ModificarProducto($id, $codigo, $nombre, $precio, $precio_compra, $coddig, $familia,
                $laboratorio, $principio, $stock_min, $stock_max, $tipo_producto, $tipo_medicamento, $tipo_afectacion);
        echo $modificar;
    }
}

if ($accion == 'LLENAR_PRO') {
    $id = $_POST['id'];
    $ofarm13 = new Farmacia();
    $listar = $ofarm13->ListarProductoxid($id);
    echo json_encode($listar->fetch());
}

if ($accion == 'ELIMINAR_PRO') {
    $id = $_POST['id'];
    $ofarm14 = new Farmacia();

    $eliminar = $ofarm14->EliminarProducto($id);
    echo $eliminar;
}


//LOTES

if ($accion == "LIS_LOTE") {
    $nombre = $_POST["buscar"];
    $lista = $ofarm->ListarLote($nombre);
    $tbl = "";
    $i = 0;
    foreach ($lista as $l) {
        $i++;
        $id = 'TblLote_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }

        $tbl .= "<tr id='$id' idlote='$l[0]' $color onclick=\"PintarFilaLote('$id')\">"
                . "<td >$l[0]</td>"
                . "<td >$l[1]</td>"
                . "<td >$l[2]</td>"
                . "<td >$l[3]</td>"
                . "</tr>";
    }

    echo $tbl;
}
//if ($_GET = "lote") {
//
//    $id_lote = $ofarm->LoteXproductoYvencimiento("19", "2020-04-07")->fetch();
//
//    echo $id_lote[0];
//}


//Compras

if ($accion == "NUEVO_COM") {

    $detalles_compra = json_decode($_POST["compra"], true);
    $fecha = $_POST['fecha'];
    $proveedor = $_POST['proveedor'];
    $tipo_documento = $_POST['tipo_documento'];
    $tipo_afectacion = $_POST['tipo_afectacion'];
    $monto_sin_igv = $_POST['monto_sin_igv'];
    $igv = $_POST['igv'];
    $monto_igv = $_POST['monto_igv'];
    $total = $_POST['total'];
    $nota_credito = $_POST['nota_credito'];
    $tipo_compra = $_POST['tipo_compra'];
    $nro_dias = $_POST['nro_dias'];
    $nro_documento = $_POST['nro_documento'];
    $insertar = $ofarm->RegistrarCompra($detalles_compra, $fecha, $proveedor, $tipo_documento, $tipo_afectacion, $monto_sin_igv,
            $igv, $monto_igv, $total, $nota_credito,$tipo_compra,$nro_documento,$nro_dias);

    echo $insertar;
}

if ($accion == "LIS_COM") {
    $nombre = $_POST["buscar"];

    $lista = $ofarm->ListarCompra($nombre);
    $tbl = "";
    $i = 0;
    foreach ($lista as $c) {
        $i++;
        $id = 'TblCom_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }
        if ($c[10]=="0") {
            $nota_credito="<input disabled type='checkbox' >";
        }else if($c[10]=="1"){
            $nota_credito="<input disabled type='checkbox' checked >";

        }else{
            $nota_credito= "";
        }
        
        $tbl .= "<tr id='$id' idcom='$c[9]'  $color onclick=\"PintarFilaCompra('$id')\">"
                . "<td >$i</td>"
                . "<td >$c[0]</td>"
                . "<td >$c[11]</td>"
                . "<td >$c[1]</td>"
                . "<td >$c[2]</td>"
                . "<td >$c[3]</td>"
                . "<td >$c[13]</td>"
                . "<td >$c[4]</td>"
                . "<td >S/". ($c[5])."</td>"
                . "<td>".$c[6][1].$c[6][2]."%</td>"
                . "<td >S/ $c[7]</td>"
                . "<td >S/ $c[8]</td>"
                //. "<td >$nota_credito</td>"
               
                . "<td >$c[12]</td>"
               
                . "<td >$c[14]</td>"
                . "<td style='font-size:11px' align='center'>
			<img src='img/agregar.png' alt='Detalles' title='Agregar Especialidad' 
			height='20' width='20' style='cursor:pointer' 
			onclick=\"javascript:AbrirModalDetalles('$c[9]')\">
		</td>"
                . "</tr>";
    }

    echo $tbl;
}
if ($accion == "LIS_COMPRA_DETALLE") {
    $compra = $_POST["compra"];

    $lista = $ofarm->ListarCompraDetalles($compra);
    $tbl = "";
    $i = 0;
    foreach ($lista as $c) {
        $i++;
        $id = 'TblComD_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }

        if ($c[4] == "0") {
            $bonificacion = "<input disabled type='checkbox' >";
        } else if($c[4] == "1") {
            $bonificacion = "<input disabled type='checkbox' checked >";
        }else{
            $bonificacion = "";
        }
        $tbl .= "<tr id='$id' style='height:20px'  $color onclick=\"PintarFilaCompra('$id')\">"
                . "<td >$i</td>"
                . "<td >$c[0]</td>"
                . "<td >$bonificacion</td>"
                . "<td >$c[5]</td>"
                . "<td >$c[6]</td>"
                . "<td >$c[7]</td>"
                . "<td >S/.".$c[8]."</td>"
                . "<td >$c[9]</td>"
                . "<td >S/.".$c[10]."</td>"
                . "<td >S/.".$c[11]."</td>"
                . "</tr>";
    }

    echo $tbl;
    
    


}

if ($accion == 'PRECIO_COMPRA_ULTIMO') {
    $id = $_POST['id'];
    
    $listar = $ofarm->UltimaPrecioCompra($id);
    echo json_encode($listar->fetch());
}
    //PROVEEDOR
if ($accion == "LIS_PROV") {
    $nombre = $_POST["buscar"];
    
    $lista = $ofarm->Listarproveedor($nombre);
    $tbl = "hola";
    $i = 0;
    foreach ($lista as $lab) {
        $i++;
        $id = 'TblProv_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }

        $tbl .= "<tr id='$id' idprov='$lab[0]' $color onclick=\"PintarFilaProv('$id')\">"
                . "<td >$i</td>"
                . "<td >$lab[1]</td>"
                . "<td >$lab[2]</td>"
                . "<td align='center'>$lab[3]</td>"
                . "<td align='center'>$lab[4]</td>"
                . "<td align='center'>$lab[5]</td>"
                . "<td align='center'>$lab[6]</td>"
                . "</tr>";
    }

    echo $tbl;
}
if ($accion == 'LLENAR_PROV') {
    $id = $_POST['id'];
    $listar = $ofarm->ListarProveedorxid($id);
    echo json_encode($listar->fetch());
}
if ($accion == 'NUEVO_PROV') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $contacto = $_POST['contacto'];
    $documento = $_POST['documento'];
    $email = $_POST['email'];
    $valor = $_POST['valor'];
    $validar = $ofarm->Validarproveedor($nombre)->fetch();

    $can = $validar[0];
    // si el valor es igual a 1 insertamos
    if ($valor == 1) {
        if ($can == 0) {

            $insertar = $ofarm->Registrarproveedor($nombre, $documento, $direccion, $contacto, $telefono, $email);
            echo $insertar;
        } else
            echo 2;exit;
    }
    // si el valor es igual a 2 modificamos
    if ($valor == 2) {
        $id = $_POST["id"];

        $modificar = $ofarm->Modificarproveedor($id, $nombre, $documento, $direccion, $contacto, $telefono, $email);
        echo $modificar;
    }
    
}
if ($accion == 'ELIMINAR_PROV') {
    $id = $_POST['id'];

    $eliminar = $ofarm->Eliminarproveedor($id);
    echo $eliminar;
}


//Compras

if ($accion == "NUEVO_VEN") {

    $detalles_venta = json_decode($_POST["venta"], true);
    $fecha = $_POST['fecha'];
    $tipo_documento = $_POST['tipo_documento'];
    $tipo_afectacion = $_POST['tipo_afectacion'];
    $monto_sin_igv = $_POST['monto_sin_igv'];
    $igv = $_POST['igv'];
    $monto_igv = $_POST['monto_igv'];
    $total = $_POST['total'];
    $nro_documento = $_POST['nro_documento'];
    $insertar = $ofarm->RegistrarVenta($detalles_venta, $fecha, $tipo_documento, $tipo_afectacion,
                                       $monto_sin_igv, $igv, $monto_igv, $total, $nro_documento);

    echo $insertar;
}

if ($accion == "LIS_VEN") {
//    $nombre = $_POST["buscar"];

    $lista = $ofarm->ListarVenta("");
    $tbl = "";
    $i = 0;
    foreach ($lista as $c) {
        $i++;
        $id = 'TblVen_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }
     
        
        $tbl .= "<tr id='$id' idven='$c[0]'  $color onclick=\"PintarFilaVenta('$id')\">"
                . "<td >$i</td>"
                . "<td >$c[1]</td>"
                . "<td >$c[2]</td>"
                . "<td >$c[3]</td>"
                . "<td >$c[4]</td>"
                . "<td >$c[5]</td>"
                . "<td >".(double)$c[6]."</td>"
                . "<td >".(double)$c[7]."</td>"
                . "<td >$c[8]</td>"
                . "<td >$c[9]</td>"
                . "<td >$c[10]</td>"
               
               
                . "<td style='font-size:11px' align='center'>
			<img src='img/agregar.png' alt='Detalles' title='Agregar Especialidad' 
			height='20' width='20' style='cursor:pointer' 
			onclick=\"javascript:AbrirModalDetalles('$c[0]')\">
		</td>"
                . "</tr>";
    }

    echo $tbl;
}
if ($accion == "LIS_VENTA_DETALLE") {
    $venta = $_POST["venta"];

    $lista = $ofarm->ListarVentaDetalles($venta);
    $tbl = "";
    $i = 0;
    foreach ($lista as $c) {
        $i++;
        $id = 'TblVenD_' . $i;
        if ($i % 2 == 0) {
            $color = "style=' background-color:#f5f5f5; height:30px'";
        } else {
            $color = "style='background-color:#ffffff; height:30px'";
        }

        $tbl .= "<tr id='$id' style='height:20px'  $color onclick=\"PintarFilaVenta('$id')\">"
                . "<td width='5%%'>$i</td>"
                . "<td width='10%'>$c[0]</td>"
                . "<td width='10%'>$c[3]</td>"
                . "<td width='10%'>$c[4]</td>"
                . "<td width='10%'>$c[5]</td>"
                . "<td width='10%'>".(double)$c[6]."</td>"
               
             
                . "</tr>";
    }

    echo $tbl;
    
    


}