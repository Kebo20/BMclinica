<?php

require_once 'conexion.php';
date_default_timezone_set('America/Lima');
class Chat {
    
    function ListarMensajes($emisor,$receptor) {
        $ocado = new cado();
        $sql = "select * from chat where (emisor='$emisor' and receptor='$receptor') or (emisor='$receptor' and receptor='$emisor')";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }
    
    
    function RegistrarMensaje($emisor,$receptor,$mensaje,$tipo) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $date = date('d-m-Y H:i');
            $sql = "insert into chat(emisor,receptor,mensaje,fecha,tipo) values('$emisor','$receptor','$mensaje','$date','$tipo')";
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
    
    
     function LisUsuarioChat($buscar){
		  $ocado=new cado();
                  $usuario=$_SESSION['S_user'];
		  $sql="select * from conf_usuario where estado=0 and  usuario !='$usuario' and nombre like '%$buscar%' ";
		  $ejecutar=$ocado->ejecutar($sql);
		  return $ejecutar;
	}
}
