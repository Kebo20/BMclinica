<?php
   require_once('conexion.php');
   
   class Accesos{
	   
   function Acceso($user,$pass){
		$ocado=new cado();
		$sql="select u.*,ca.nom_caja,c.codigo_ingreso,ca.id idcaja,g.nombre nom_grupo from conf_usuario u 
                                              left join caja_fondos c on u.id=c.id_user and c.activo=1
		                                      left join conf_caja ca on c.id_caja=ca.id 
											  inner join conf_usuario_grupo g on u.id_grupo_usuario=g.id
	where CONVERT(varchar(100),DECRYPTBYPASSPHRASE('PassUsuario',pass))='$pass' and usuario='$user' and u.estado=0";
		$ejecutar=$ocado->ejecutar($sql);
		return $ejecutar;
	 }
   
 }
 $ocado2=new cado();
   $ocado2->Conectar();
?>