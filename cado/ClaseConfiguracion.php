<?php

require_once('conexion.php');

class Configuraciones {

    // FUNCIONES PARA EL MANTENEDOR GRUPO USUARIO	   
    function LisGrupoUsuario($nombre) {
        $ocado = new cado();
        $sql = "select * from conf_usuario_grupo where estado=0 and nombre like '$nombre%' order by nombre asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarGrupo($nombre) {
        $ocado = new cado();
        $sql = "select count(*) from conf_usuario_grupo where nombre='$nombre'";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarGrupo($nombre) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into conf_usuario_grupo(nombre,estado) values('$nombre',0)";
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

    function ModificarGrupo($id, $nombre) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update conf_usuario_grupo set nombre = '$nombre' where id = $id";
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

    function EliminarGrupo($id) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "update conf_usuario_grupo set estado = 1 where id = $id";
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

    // FUNCIONES PARA EL MANTENEDOR DE USUARIO	   
    function LisUsuario($nombre) {
        $ocado = new cado();
        $sql = "select * from conf_usuario where estado=0 and nombre like '$nombre%' order by nombre asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarUsuario($user) {
        $ocado = new cado();
        $sql = "select count(*) from conf_usuario where usuario='$user'";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarUsuario($usuario, $login, $pass, $estado, $tipo) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into conf_usuario(nombre,usuario,pass,estado,id_grupo_usuario,user_activo) 
                values('$usuario','$login',ENCRYPTBYPASSPHRASE('PassUsuario','$pass'),'$estado','$tipo',0)";
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

    function ModificarUsuario($id, $usuario, $login, $pass, $estado, $idgrupo_usu) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "update conf_usuario set nombre = '$usuario',usuario='$login',pass=ENCRYPTBYPASSPHRASE('PassUsuario','$pass'),
		           estado=$estado,id_grupo_usuario='$idgrupo_usu'
		        where id = $id";
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

    function UsuarioXId($id) {
        $ocado = new cado();
        $sql = "select id,nombre,usuario,Cast(DecryptByPassPhrase('PassUsuario', pass) As varchar(max))pass,id_grupo_usuario,estado 
		  from conf_usuario where id=$id";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

// FUNCIONES PARA EL MANTENEDOR DE SERIE
    function LisSerie() {
        $ocado = new cado();
        $sql = "select s.id,t.descripcion,s.tipo_doc,s.serie
		  from conf_serie s inner join conf_tipo_documento t on s.cod_sunat=t.cod_sunat
		  order by s.cod_sunat asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function LisTipoDoc() {
        $ocado = new cado();
        $sql = "select id,cod_sunat,cod_sunat+' - '+descripcion  from conf_tipo_documento order by cod_sunat asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValSer($serie, $tipo_doc) {
        $ocado = new cado();
        $sql = "select count(*) from conf_serie  where serie='$serie' and tipo_doc='$tipo_doc'";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarSerie($cod_sunat, $serie, $tipo_doc) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into conf_serie(cod_sunat,tipo_doc,serie,correlativo) values('$cod_sunat','$tipo_doc','$serie',0)";
            //echo $sql;exit;
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

// FUNCIONES PARA EL MANTENEDOR DE CAJA
    function LisCaja() {
        $ocado = new cado();
        $sql = "select id,nom_caja,convert(varchar(10),fec_crea,103)fecha,user_crea,estado,activa
		      from conf_caja ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarCaja($caja, $est, $user) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into conf_caja(nom_caja,fec_crea,user_crea,estado,activa)
		            values('$caja',GETDATE(),'$user','$est',0)";
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

    function ModificarCaja($id, $caja, $est) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "update conf_caja set nom_caja = '$caja',estado=$est  where id = $id";
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

    function LisTipoDocCaja($idcaja) {
        $ocado = new cado();
        $sql = "select d.cod_sunat,d.descripcion from conf_tipo_documento d inner join conf_serie s on d.cod_sunat=s.cod_sunat
           where d.cod_sunat not in(select ca.cod_sunat from conf_caja_series ca where ca.id_caja=$idcaja)
           group by d.cod_sunat,d.descripcion
           order by d.cod_sunat asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function LisSeriesCaja($cod) {
        $ocado = new cado();
        $sql = "select id,cod_sunat,tipo_doc+' - '+serie ser from conf_serie where cod_sunat='$cod' ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarSeriesCaja($idcaja) {
        $ocado = new cado();
        $sql = "select  c.nom_caja,cs.cod_sunat,s.tipo_doc+' - '+s.serie ser
		        from conf_caja_series cs inner join conf_caja c on cs.id_caja=c.id 
		                                 inner join conf_serie s on cs.id_serie=s.id
		       where id_caja=$idcaja ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarSeriesCaja($idcaja, $idserie, $cod) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into conf_caja_series(id_caja,id_serie,cod_sunat)
		            values('$idcaja',$idserie,'$cod')";
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

//FUNCIONES PARA EL MANTENEDOR ESPECIALIDADES
    function LisEsp($nombre) {
        $ocado = new cado();
        $sql = "select  * from conf_especialidad where estado=0 and nombre like '$nombre%' order by nombre asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarEsp($nombre) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into conf_especialidad(nombre,estado) values('$nombre',0)";
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    function ModificarEsp($id, $nombre) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "update conf_especialidad set nombre = '$nombre'  where id = $id";
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

    function EliminarEsp($id) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "update conf_especialidad set estado =1 where id = $id";
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

// FUNCIONES PARA EL MANTENEDOR DE MEDICOS	   
    function LisMedico($nombre) {
        $ocado = new cado();
        $sql = "select med.id,apePaterno+' '+apeMaterno+' '+preNombres medico,nuDni,med.cmp,med.telefono,desDireccion,med.id_persona
		        from conf_medico med inner join webservice_persona per on med.id_persona=per.id
				where estado=0 and apePaterno+' '+apeMaterno+' '+preNombres like '$nombre%' ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarMedico($idper, $cmp, $comision, $tel) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql_validar = "select count(*) from conf_medico where id_persona=$idper";
            $cmd = $cn->prepare($sql_validar);
            $cmd->execute();
            $validar = $cmd->fetch();
            if ($validar[0] > 0) {
                $cn->rollBack();
                $cn = null;
                $return = 2;
            } else {
                $sql = "insert into conf_medico(id_persona,cmp,comision_medico,telefono,estado) 
                values($idper,'$cmp','$comision','$tel',0)";
                $cn->prepare($sql)->execute();
                $cn->commit();
                $cn = null;
                $return = 1;
            }
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    function ModificarMedico($idmed, $idper, $cmp, $comision, $tel) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "update conf_medico set cmp='$cmp',comision_medico='$comision',telefono='$tel'
		              where id = $idmed";
            //echo $sql;exit;
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
        }
        return $return;
    }

    function EliminarMedico($id) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "update conf_medico set estado =1 where id = $id";
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

    function MedXId($idmed) {
        $ocado = new cado();
        $sql = "select med.id,apePaterno,apeMaterno,preNombres,nuDni,med.cmp,med.telefono,desDireccion,med.id_persona,per.feNacimiento,
	          per.sexo,med.comision_medico,per.foto
		        from conf_medico med inner join webservice_persona per on med.id_persona=per.id
			  where med.id=$idmed ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function LisMedEsp($idmed) {
        $ocado = new cado();
        $sql = "select me.id,e.nombre,me.rne,me.id_medico from conf_medico m inner join conf_medico_especialidad me on m.id=me.id_medico
	                                    inner join conf_especialidad e on me.id_especialidad=e.id
			  where m.id=$idmed ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarMedEsp($idmed, $idesp, $rne) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql_validar = "select count(*) from conf_medico_especialidad where id_especialidad=$idesp";
            $cmd = $cn->prepare($sql_validar);
            $cmd->execute();
            $validar = $cmd->fetch();
            if ($validar[0] > 0) {
                $cn->rollBack();
                $cn = null;
                $return = 2;
            } else {
                $sql = "insert into conf_medico_especialidad (id_medico,id_especialidad,rne) values ($idmed,$idesp,'$rne')";
                $cn->prepare($sql)->execute();
                $cn->commit();
                $cn = null;
                $return = 1;
            }
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    function EliminarMedEsp($id) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "delete from conf_medico_especialidad where id=$id";
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

    // FUNCIONES PARA EL MANTENEDOR DEPACIENTES	   
    function LisPaciente($nombre) {
        $ocado = new cado();
        $sql = "select med.id,apePaterno+' '+apeMaterno+' '+preNombres paci,nuDni,sexo,convert(varchar(10),feNacimiento,103)
		,med.id_persona
		        from conf_paciente med inner join webservice_persona per on med.id_persona=per.id
				where  apePaterno+' '+apeMaterno+' '+preNombres like '$nombre%' ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarPaciente($idper, $tel, $correo, $resp, $tel_resp) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql_validar = "select count(*) from conf_paciente where id_persona=$idper";
            $cmd = $cn->prepare($sql_validar);
            $cmd->execute();
            $validar = $cmd->fetch();
            if ($validar[0] > 0) {
                $cn->rollBack();
                $cn = null;
                $return = 2;
            } else {
                $sql = "insert into conf_paciente(id_persona,telefono,correo,familiar_responsable,telefono_familiar) 
                values($idper,'$tel','$correo','$resp','$tel_resp')";
                $cn->prepare($sql)->execute();
                $cn->commit();
                $cn = null;
                $return = 1;
            }
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
            //return $ex->getMessage();
        }
        return $return;
    }

    function PacXId($idpac) {
        $ocado = new cado();
        $sql = "select med.id,apePaterno,apeMaterno,preNombres,nuDni,med.telefono,desDireccion,med.id_persona,per.feNacimiento,
	          per.sexo,med.correo,familiar_responsable,telefono_familiar,depaDireccion,provDireccion,distDireccion,
			  estatura,estadoCivil,DATEDIFF(YY,convert(datetime,feNacimiento,103),getdate())-(CASE
              WHEN DATEADD(YY,DATEDIFF(YEAR,feNacimiento,GETDATE()),feNacimiento)>GETDATE() THEN 1 ELSE 0 END) as Edad
		        from conf_paciente med inner join webservice_persona per on med.id_persona=per.id
			  where med.id=$idpac ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ModificarPaciente($id, $idper, $tel, $correo, $resp, $tel_resp) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "update conf_paciente set telefono='$tel',correo='$correo',familiar_responsable='$resp',telefono_familiar='$tel_resp'
		        where id = $idper";
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
        }
        return $return;
    }

    
    
    // FUNCIONES PARA EL MANTENEDOR SUCURSAL	   
    function ListarSucursal($nombre) {
        $ocado = new cado();
        $sql = "select * from conf_sucursal where  nombre like '%$nombre%' and estado=0 order by nombre asc";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ListarSucursalxid($id) {
        $ocado = new cado();
        $sql = "select * from conf_sucursal where id=$id ";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function ValidarSucursal($nombre) {
        $ocado = new cado();
        $sql = "select count(*) from conf_sucursal where nombre='$nombre' and estado=0";
        $ejecutar = $ocado->ejecutar($sql);
        return $ejecutar;
    }

    function RegistrarSucursal($nombre,$responsable,$logo,$ruc,$direccion, $telefono, $correo,$celular_responsable) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction();
            $sql = "insert into conf_sucursal(nombre,responsable,logo,ruc,direccion,telefono,correo,celular_responsable,estado)"
                    . " values('$nombre','$responsable','$logo','$ruc','$direccion','$telefono','$correo','$celular_responsable',0)";
            $cn->prepare($sql)->execute();
            $cn->commit();
            $cn = null;
            $return = 1;
        } catch (PDOException $ex) {
            $cn->rollBack();
            $cn = null;
            $return = 0;
//            $return =$ex->getMessage();
        }

        return $return;
    }

    function ModificarSucursal($id, $nombre,$responsable,$logo,$ruc,$direccion, $telefono, $correo,$celular_responsable) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update conf_sucursal set nombre = '$nombre' ,responsable='$responsable',logo='$logo',ruc='$ruc' ,"
                    . "direccion='$direccion',telefono='$telefono' ,correo='$correo',"
                    . "celular_responsable='$celular_responsable' where id = $id";
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
    function ModificarSucursalsinLogo($id, $nombre,$responsable,$ruc,$direccion, $telefono, $correo,$celular_responsable) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una transacción
            $sql = "update conf_sucursal set nombre = '$nombre' ,responsable='$responsable',ruc='$ruc' ,"
                    . "direccion='$direccion',telefono='$telefono' ,correo='$correo',"
                    . "celular_responsable='$celular_responsable' where id = $id";
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

    function EliminarSucursal($id) {
        try {
            $ocado = new cado();
            $cn = $ocado->conectar();
            $cn->beginTransaction(); //inicia una trasacción
            $sql = "update conf_sucursal set estado=1 where id = $id";
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

    
}

?>