<?php

require_once('conexion.php');

class Logistica {

    // FUNCIONES PARA EL MANTENEDOR ALMACÉN	   
    function ListarAlmacen($nombre) {
        $ocado = new cado();
        $sql = "select a.*,s.nombre from log_almacen a inner join conf_sucursal s on s.id=a.id_sucursal where  a.nombre like '%$nombre%' and a.estado=0 order by a.nombre asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarAlmacenxid($id) {
        $ocado = new cado();
        $sql = "select * from log_almacen where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarAlmacenxSucursal($sucursal,$tipo) {
        $ocado = new cado();
        $sql = "select * from log_almacen where  id_sucursal=$sucursal and tipo='$tipo';";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarAlmacen($nombre) {
        $ocado = new cado();
        $sql = "select count(*) from log_almacen where nombre='$nombre' and estado=0";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarAlmacen($nombre, $responsable, $correo, $sucursal,$tipo) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into log_almacen(nombre,responsable,correo,id_sucursal,estado,tipo) values"
                    . "('$nombre','$responsable','$correo','$sucursal',0,'$tipo')";
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

    function ModificarAlmacen($id, $nombre, $responsable, $correo, $sucursal,$tipo) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update log_almacen set nombre = '$nombre' , responsable='$responsable',correo='$correo' ,"
                    . "id_sucursal='$sucursal',tipo='$tipo' where id = $id";
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

    function EliminarAlmacen($id) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "update log_almacen set estado=1 where id = $id";
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
    function ListarProductoLog($nombre) {
        $ocado = new cado();
        $sql = "select * from log_producto where  nombre like '%$nombre%' and estado=0 order by nombre asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarProductoLogxid($id) {
        $ocado = new cado();
        $sql = "select * from log_producto where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarProductoLog($nombre) {
        $ocado = new cado();
        $sql = "select count(*) from log_producto where nombre='$nombre' and estado=0";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarProductoLog($nombre, $categoria, $unidad, $stock_min, $stock_max, $tipo_producto) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into log_producto(nombre,id_categoria,unidad,stock_min,stock_max,tipo_producto,estado) "
                    . "values('$nombre','$categoria','$unidad','$stock_min','$stock_max','$tipo_producto',0)";
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
//            $return = 0;
            $return = $ex->getMessage();
        }

        return $return;
    }

    function ModificarProductoLog($id, $nombre, $categoria, $unidad, $stock_min, $stock_max, $tipo_producto) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update log_producto set nombre = '$nombre',unidad= '$unidad',id_categoria='$categoria',stock_min='$stock_min',stock_max='$stock_max', "
                    . "tipo_producto='$tipo_producto' where id = $id";
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

    function EliminarProductoLog($id) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "update log_producto set estado=1 where id = $id";
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

    // FUNCIONES PARA EL MANTENEDOR CATEGORÍA	   
    function ListarCategoriaProducto($nombre) {
        $ocado = new cado();
        $sql = "select * from log_categoria_producto where  nombre like '%$nombre%' and estado=0 order by nombre asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarCategoriaProductoxid($id) {
        $ocado = new cado();
        $sql = "select * from log_categoria_producto where  id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarCategoriaProducto($nombre) {
        $ocado = new cado();
        $sql = "select count(*) from log_categoria_producto where nombre='$nombre' and estado=0";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarCategoriaProducto($nombre) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into log_categoria_producto(nombre,estado) values('$nombre',0)";
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

    function ModificarCategoriaProducto($id, $nombre) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update log_categoria_producto set nombre = '$nombre'  where id = $id";
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

    function EliminarCategoriaProducto($id) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "update log_categoria_producto set estado=1 where id = $id";
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

    //FUNCIONES PARA ORDEN DE COMPRA

    function RegistrarOrdenCompra($detalles_orden_compra, $nro, $fecha, $sucursal, $tipo, $almacen, $referencia, $tipo_producto) {
        $ocado = new cado();
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $usuario = $_SESSION['S_iduser'];
            $date = date('d-m-Y H:i:s');
            $sql = "insert into log_orden_compra(numero,fecha,id_sucursal,tipo,id_almacen,referencia,tipo_producto,id_usuario,fecha_sistema,estado) "
                    . "values('$nro','$fecha','$sucursal','$tipo','$almacen','$referencia','$tipo_producto','$usuario','$date','pendiente');";

            foreach ($detalles_orden_compra as $detalle) {

                $id_producto = $detalle['id_producto'];
                $cantidad = $detalle['cantidad'];
                $unidad = $detalle['unidad'];
                $despachado = $detalle['despachado'];
                $pendiente = $detalle['pendiente'];

                $sql .= "insert into log_orden_compra_detalle(id_orden_compra,id_producto,cantidad,unidad,despachado,pendiente)"
                        . "values((select max(id) from log_orden_compra),'$id_producto','$cantidad','$unidad','$despachado','$pendiente')";
            }
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
//            $return = $ex->getMessage();
        }

        return $return;
    }

    function ModificarOrdenCompra($id, $detalles_orden_compra, $nro, $fecha, $sucursal, $tipo, $almacen, $referencia, $tipo_producto) {
        $ocado = new cado();
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $usuario = $_SESSION['S_iduser'];
            $date = date('d-m-Y H:i:s');
            $sql = "update  log_orden_compra set numero='$nro' , fecha='$fecha', id_sucursal='$sucursal' , tipo='$tipo',id_almacen='$almacen',"
                    . "referencia='$referencia',tipo_producto='$tipo_producto',id_usuario='$usuario',fecha_sistema='$date' "
                    . "where id='$id';  ";

            $sql .= " delete from log_orden_compra_detalle where id_orden_compra='$id' ";

            foreach ($detalles_orden_compra as $detalle) {

                $id_producto = $detalle['id_producto'];
                $cantidad = $detalle['cantidad'];
                $unidad = $detalle['unidad'];
                $despachado = $detalle['despachado'];
                $pendiente = $detalle['pendiente'];

                $sql .= "insert into log_orden_compra_detalle(id_orden_compra,id_producto,cantidad,unidad,despachado,pendiente)"
                        . "values('$id','$id_producto','$cantidad','$unidad','$despachado','$pendiente')";
            }
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
//            $return = $ex->getMessage();
        }

        return $return;
    }

    function ValidarOrdenCompra($numero) {
        $ocado = new cado();
        $sql = "select count(*) from log_orden_compra where  numero='$numero' ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarOrdenCompra($where) {
        $ocado = new cado();
        $sql = "select o.id,s.nombre,o.fecha,o.numero,a.nombre,o.estado from log_orden_compra o "
                . "  inner join conf_sucursal  s on s.id=o.id_sucursal  inner join log_almacen a"
                . " on a.id=o.id_almacen $where ;";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarOrdenCompraxId($id) {
        $ocado = new cado();
        $sql = "select * from log_orden_compra where id=$id ;";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function EstadoOrdenCompra($id, $estado) {

        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "update  log_orden_compra set estado='$estado' where id='$id' ;";
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

    function ListarOrdenComprDetallesLog($id) {
        $ocado = new cado();
        $sql = "select o.*,p.nombre from log_orden_compra_detalle o inner join log_producto p on p.id=o.id_producto where id_orden_compra=$id ;";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }
    function ListarOrdenComprDetallesFarm($id) {
        $ocado = new cado();
        $sql = "select o.*,p.nombre from log_orden_compra_detalle o inner join farm_producto p on p.id=o.id_producto  where id_orden_compra=$id ;";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

}
