<?php

require_once 'conexion.php';
date_default_timezone_set('America/Lima');

class Farmacia
{

    // FUNCIONES PARA EL MANTENEDOR LABORATORIO	   
    function ListarLaboratorio($nombre)
    {
        $ocado = new cado();
        $sql = "select * from farm_laboratorio where  nombre like '%$nombre%' order by nombre asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarLabxid($id)
    {
        $ocado = new cado();
        $sql = "select * from farm_laboratorio where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarLaboratorio($nombre)
    {
        $ocado = new cado();
        $sql = "select count(*) from farm_laboratorio where nombre='$nombre'";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarLaboratorio($nombre, $direccion, $tel1, $tel2)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into farm_laboratorio(nombre,direccion,telefono1,telefono2) values('$nombre','$direccion','$tel1','$tel2')";
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }

        return $return;
    }

    function ModificarLaboratorio($id, $nombre, $direccion, $tel1, $tel2)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update farm_laboratorio set nombre = '$nombre' , direccion='$direccion',telefono1='$tel1' ,telefono2='$tel2' where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    function EliminarLaboratorio($id)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "delete from farm_laboratorio  where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //Consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    // FUNCIONES PARA EL MANTENEDOR FAMILIA   
    function ListarFamilia($nombre)
    {
        $ocado = new cado();
        $sql = "select * from farm_familia where  nombre like '%$nombre%' order by nombre asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarFamiliaxid($id)
    {
        $ocado = new cado();
        $sql = "select * from farm_familia where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarFamilia($nombre)
    {
        $ocado = new cado();
        $sql = "select count(*) from farm_familia where nombre='$nombre'";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarFamilia($nombre)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into farm_familia(nombre) values('$nombre')";
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }

        return $return;
    }

    function ModificarFamilia($id, $nombre)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update farm_familia set nombre = '$nombre'  where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    function EliminarFamilia($id)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "delete from farm_familia  where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //Consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    // FUNCIONES PARA EL MANTENEDOR PRINCIPIO ACTIVO 
    function ListarPrincipio($nombre)
    {
        $ocado = new cado();
        $sql = "select * from farm_principio_activo where  nombre like '%$nombre%' order by nombre asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarPrincipioxid($id)
    {
        $ocado = new cado();
        $sql = "select * from farm_principio_activo where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarPrincipio($nombre)
    {
        $ocado = new cado();
        $sql = "select count(*) from farm_principio_activo where nombre='$nombre'";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarPrincipio($nombre)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into farm_principio_activo(nombre) values('$nombre')";
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }

        return $return;
    }

    function ModificarPrincipio($id, $nombre)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update farm_principio_activo set nombre = '$nombre'  where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    function EliminarPrincipio($id)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "delete from farm_principio_activo  where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //Consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    // FUNCIONES PARA EL MANTENEDOR PRODUCTO
    function ListarProducto($nombre)
    {
        $ocado = new cado();
        $sql = "SELECT pro.id,pro.codigo,pro.nombre,precio,precio_compra,codigodigemid,f.nombre,l.nombre,p.nombre,
            stock_min,stock_max,tipo_producto,tipo_medicamento, a.descripcion FROM farm_producto pro inner join farm_familia f 
            on f.id=pro.id_familia inner join farm_laboratorio l on l.id=pro.id_laboratorio
            inner join farm_principio_activo p on p.id=pro.id_principio inner join admin_tipo_afectacion_igv a on 
            a.id=pro.tipo_afectacion where  pro.nombre like '%$nombre%' and estado='0' order by pro.nombre asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarProductoxid($id)
    {
        $ocado = new cado();
        $sql = "select * from farm_producto where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarProducto($nombre)
    {
        $ocado = new cado();
        $sql = "select count(*) from farm_producto where nombre='$nombre' and estado='0'";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarProducto(
        $codigo,
        $nombre,
        $precio,
        $precio_compra,
        $codigodig,
        $familia,
        $laboratorio,
        $principio,
        $stock_min,
        $stock_max,
        $tipo_producto,
        $tipo_medicamento,
        $tipo_afectacion
    ) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into farm_producto(codigo,nombre,precio,precio_compra,codigodigemid,id_familia,id_laboratorio,id_principio,"
                . "stock_min,stock_max,tipo_producto,tipo_medicamento,tipo_afectacion,estado) values('$codigo','$nombre','$precio','$precio_compra',"
                . "'$codigodig','$familia','$laboratorio','$principio',
            '$stock_min','$stock_max','$tipo_producto','$tipo_medicamento','$tipo_afectacion','0')";
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            //            $return = 0;
            return $ex->getMessage();
        }

        return $return;
    }

    function ModificarProducto(
        $id,
        $codigo,
        $nombre,
        $precio,
        $precio_compra,
        $coddig,
        $familia,
        $laboratorio,
        $principio,
        $stock_min,
        $stock_max,
        $tipo_producto,
        $tipo_medicamento,
        $tipo_afectacion
    ) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update farm_producto set codigo='$codigo', nombre = '$nombre',precio='$precio',precio_compra='$precio_compra' ,"
                . "codigodigemid='$coddig',id_familia='$familia',id_laboratorio='$laboratorio',id_principio='$principio',"
                . "stock_min='$stock_min',stock_max='$stock_max',tipo_producto='$tipo_producto',tipo_medicamento='$tipo_medicamento',"
                . "tipo_afectacion='$tipo_afectacion' where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    function EliminarProducto($id)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "update  farm_producto set estado='1'  where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //Consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    //FUNCIONES PARA COMPRAS

    function RegistrarCompra(
        $detalles_compra,
        $fecha,
        $proveedor,
        $tipo_documento,
        $tipo_afectacion,
        $monto_sin_igv,
        $igv,
        $monto_igv,
        $total,
        $nota_credito,
        $tipo_compra,
        $nro_documento,
        $nro_dias
    ) {
        $ocado = new cado();
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $usuario = $_SESSION['S_iduser'];
            $date = date('d-m-Y H:i:s');
            $sql = "insert into farm_compra(fecha,id_usuario,id_proveedor,tipo_documento,tipo_afectacion,monto_sin_igv,igv,monto_igv,"
                . "total,nota_credito,fecha_sistema,tipo_compra,nro_documento,nro_dias) values('$fecha','$usuario','$proveedor',"
                . "'$tipo_documento','$tipo_afectacion',"
                . "'$monto_sin_igv','$igv','$monto_igv','$total','$nota_credito','$date','$tipo_compra','$nro_documento','$nro_dias');";

            foreach ($detalles_compra as $detalle) {

                $id_producto = $detalle['id_producto'];
                $cantidad = $detalle['cantidad'];
                $fecha_vencimiento = $detalle['fecha_vencimiento'];
                $bonificacion = $detalle['bonificacion'];
                $nro_lote = $detalle['nro_lote'];
                $precio_sin_igv = $detalle['precio_sin_igv'];
                $monto_igv = $detalle['monto_igv'];
                $subtotal = $detalle['subtotal'];
                $precio_anterior = $detalle['precio_anterior'];
                $id_lote = $this->LoteXnro_lote($nro_lote)->fetch();
                if ($id_lote[0] == '') {
                    $sql .= "insert into farm_lote(nro,id_producto,cantidad,fecha_vencimiento)values('$nro_lote','$id_producto','$cantidad','$fecha_vencimiento')";
                    $lote = "(select max(id) from farm_lote)";
                } else {
                    $sql .= "update farm_lote set nro='$nro_lote',id_producto='$id_producto',cantidad+='$cantidad',fecha_vencimiento='$fecha_vencimiento' where id=$id_lote[0]";

                    $lote = $id_lote[0];
                }


                $sql .= "insert into farm_compra_detalle(id_compra,id_producto,bonificacion,id_lote,fecha_vencimiento,cantidad,"
                    . "precio_sin_igv,monto_igv,subtotal,precio_compra_ant)values((select max(id) from farm_compra),'$id_producto',"
                    . "'$bonificacion',$lote,'$fecha_vencimiento','$cantidad',"
                    . "'$precio_sin_igv','$monto_igv','$subtotal','$precio_anterior')";
            }
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = "OK";
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            //            $return = 0;
            $return = $ex->getMessage();
        }

        return $return;
    }


    function ListarCompra($nombre)
    {
        $ocado = new cado();
        $sql = "SELECT c.fecha,u.nombre,c.id_proveedor,c.tipo_documento,ta.descripcion,c.monto_sin_igv,c.igv,c.monto_igv,"
            . "c.total ,c.id,c.nota_credito,c.fecha_sistema,c.tipo_compra,c.nro_documento,c.nro_dias from farm_compra c inner join conf_usuario u on c.id_usuario=u.id inner join"
            . " admin_tipo_afectacion_igv ta on ta.id=c.tipo_afectacion ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    // FUNCIONES PARA EL MANTENEDOR COMPRA_ETALLES

    function ListarCompraDetalles($compra)
    {
        $ocado = new cado();
        $sql = "SELECT p.nombre,c.* from farm_compra_detalle c inner join farm_producto p on c.id_producto=p.id where id_compra=$compra";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }
    function UltimaPrecioCompra($id)
    {
        $ocado = new cado();
        $sql = "SELECT * from  farm_compra_detalle where id_producto=$id";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }
    // FUNCIONES PARA EL MANTENEDOR LOTE
    function ListarLote($nombre)
    {
        $ocado = new cado();
        $sql = "SELECT l.nro,p.nombre,l.cantidad,l.fecha_vencimiento from farm_lote l inner join farm_producto p on l.id_producto=p.id "
            . "where l.nro like '%$nombre%' or p.nombre like '%$nombre%' or l.fecha_vencimiento like '%$nombre%'  ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarLotexid($id)
    {
        $ocado = new cado();
        $sql = "select * from farm_producto where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function LoteXnro_lote($nro_lote)
    {
        $ocado = new cado();
        $sql = "select id from farm_lote where  nro='$nro_lote' ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarLote($nombre)
    {
        $ocado = new cado();
        $sql = "select count(*) from farm_producto where nombre='$nombre' and estado='0'";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }




    //FUNCIONES PARA EL MANTENEDOR PROVEEDOR

    function Listarproveedor($nombre)
    {
        $ocado = new cado();
        $sql = "select * from farm_proveedor where  nombre like '%$nombre%' order by nombre asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarProveedorxid($id)
    {
        $ocado = new cado();
        $sql = "select * from farm_proveedor where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function Validarproveedor($nombre)
    {
        $ocado = new cado();
        $sql = "select count(*) from farm_proveedor where nombre='$nombre'";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function Registrarproveedor($nombre, $documento, $direccion, $contacto, $telefono, $email)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into farm_proveedor(nombre,documento,direccion,contacto,telefono,email) values('$nombre','$documento','$direccion','$contacto','$telefono','$email')";
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //            $return= $ex->getMessage();
        }

        return $return;
    }

    function Modificarproveedor($id, $nombre, $documento, $direccion, $contacto, $telefono, $email)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update farm_proveedor set nombre ='$nombre' , direccion='$direccion',telefono='$telefono' ,email='$email',contacto='$contacto',documento='$documento' where id = '$id'";
            $cn->prepare($sql)->execute();
            $cn->commit(); //consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //             $return= $ex->getMessage();
        }
        return $return;
    }

    function Eliminarproveedor($id)
    {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "delete from farm_proveedor  where id = $id";
            $cn->prepare($sql)->execute();
            $cn->commit(); //Consignar cambios
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }




    //FUNCIONES PARA VENTAS

    function RegistrarVenta(
        $detalles_venta,
        $fecha,
        $tipo_documento,
        $tipo_afectacion,
        $monto_sin_igv,
        $igv,
        $monto_igv,
        $total,
        $nro_documento
    ) {
        $ocado = new cado();
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $usuario = $_SESSION['S_iduser'];
            $date = date('d-m-Y H:i:s');
            $sql = "insert into farm_venta(fecha,fecha_sistema,id_usuario,tipo_documento,nro_documento,tipo_afectacion,monto_sin_igv,igv,monto_igv,"
                . "total) values('$fecha','$date','$usuario','$tipo_documento','$nro_documento','$tipo_afectacion',"
                . "'$monto_sin_igv','$igv','$monto_igv','$total');";

            foreach ($detalles_venta as $detalle) {

                $id_producto = $detalle['id_producto'];
                $cantidad = $detalle['cantidad'];
                $precio = $detalle['precio'];
                $monto_igv = $detalle['monto_igv'];
                $subtotal = $detalle['subtotal'];
                //                $id_lote = $this->LoteXnro_lote($nro_lote)->fetch();
                //                if ($id_lote[0] == '') {
                //                    $sql .= "insert into farm_lote(nro,id_producto,cantidad,fecha_vencimiento)values('$nro_lote','$id_producto','$cantidad','$fecha_vencimiento')";
                //                    $lote = "(select max(id) from farm_lote)";
                //                } else {
                //                    $sql .= "update farm_lote set nro='$nro_lote',id_producto='$id_producto',cantidad+='$cantidad',fecha_vencimiento='$fecha_vencimiento' where id=$id_lote[0]";
                //
                //                    $lote = $id_lote[0];
                //                }


                $sql .= "insert into farm_venta_detalle(id_venta,id_producto,cantidad,precio,monto_igv,subtotal)values((select max(id) from farm_venta),'$id_producto',"
                    . "'$cantidad','$precio','$monto_igv','$subtotal')";
            }
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = "OK";
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            //            $return = 0;
            $return = $ex->getMessage();
        }

        return $return;
    }


    function ListarVenta($nombre)
    {
        $ocado = new cado();
        $sql = "SELECT c.id,c.fecha,u.nombre,c.tipo_documento,c.nro_documento,ta.descripcion,c.monto_sin_igv,c.igv,c.monto_igv,"
            . "c.total,c.fecha_sistema from farm_venta c inner join conf_usuario u on c.id_usuario=u.id inner join"
            . " admin_tipo_afectacion_igv ta on ta.id=c.tipo_afectacion ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    // FUNCIONES PARA EL MANTENEDOR venta_ETALLES

    function ListarVentaDetalles($venta)
    {
        $ocado = new cado();
        $sql = "SELECT p.nombre,c.* from farm_venta_detalle c inner join farm_producto p on c.id_producto=p.id where id_venta=$venta";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }
}
