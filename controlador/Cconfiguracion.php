<?php

require_once('../cado/ClaseConfiguracion.php');
date_default_timezone_set('America/Lima');
session_start();



controlador($_POST['accion']);

function controlador($accion) {

    $oconfiguracion = new Configuraciones();



    if ($accion == 'LIS_GRU_USU') {
        $tbl = '';
        $i = 0;
        $buscar = $_POST['buscar'];
        $listar = $oconfiguracion->LisGrupoUsuario($buscar);

        while ($fila = $listar->fetch()) {
            $i++;
            $id = 'TblGruUsu_' . $i;
            $grupo = $fila[1];
            if ($i % 2 == 0) {
                $color = "style=' background-color:#f5f5f5; height:30px'";
            } else {
                $color = "style='background-color:#ffffff; height:30px'";
            }
            $tbl .= "<tr id='$id' IdGruUsu='$fila[0]' nombre='$fila[1]' $color onclick=\"javascript:PintarFila('$id')\" >
				            <td align='center'>$i</td>
							<td  >&nbsp;&nbsp;$grupo</td>
				        </tr>";
        }
        echo $tbl;
    }
    //msi

    if ($accion == 'NUEVO_GRUPO') {
        $id = $_POST['id'];
        $nombre = mb_strtoupper(trim($_POST['nombre']), 'UTF-8');
        $valor = $_POST['valor'];
        $validar = $oconfiguracion->ValidarGrupo($nombre)->fetch();
        $can = $validar[0];
        //while($fila=$validar->fetch()){$can=$fila[0];}
        if ($valor == 1) {
            if ($can == 0) {
                $insertar = $oconfiguracion->RegistrarGrupo($nombre);
                echo $insertar;
            } else
                echo 2;exit;
        }
        if ($valor == 2) {
            $modificar = $oconfiguracion->ModificarGrupo($id, $nombre);
            echo $modificar;
        }
    }


    if ($accion == 'ELI_GRU_USU') {
        $id = $_POST['id'];
        $eliminar = $oconfiguracion->EliminarGrupo($id);
        echo $eliminar;
    }


    // MANTENEDOR DE USUARIOS

    if ($accion == 'LIS_USUARIO') {
        $tbl = '';
        $i = 0;
        $buscar = $_POST['buscar'];
        $listar = $oconfiguracion->LisUsuario($buscar);

        while ($fila = $listar->fetch()) {
            $i++;
            $id = 'TblUsu_' . $i;

            if ($fila[4]) {
                $check = "checked";
            } else {
                $check = "";
            }
            if ($i % 2 == 0) {
                $color = "style=' background-color:#f5f5f5; height:30px'";
            } else {
                $color = "style='background-color:#ffffff; height:30px'";
            }
            $tbl .= "<tr $color id='$id' onclick=\"javascript:PintarFilaUsuario('$id')\" idusu=$fila[0]  >
				            <td align='center' style='font-size:11px' >$i</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[1]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[2]</td>
							<td align='center' style='font-size:11px'>&nbsp;&nbsp;$fila[3]</td>
							<td align='center' ><input type='checkbox' $check disabled='disabled'  /></td>
				        </tr>";
        }
        echo $tbl;
    }

    if ($accion == "LLENAR_GRUPO") {
        $tbl = "";
        $id = $_POST['id'];
        $tbl = "<option value='0'></option>";
        $listar = $oconfiguracion->LisGrupoUsuario("");
        while ($fila = $listar->fetch()) {
            if ($id == $fila[0]) {
                $selec = "selected='selected'";
            } else {
                $selec = "";
            }
            $tbl .= "<option value='$fila[0]' $selec >$fila[1]</option>";
        }
        echo $tbl;
    }

    if ($accion == 'NUEVO_USUARIO') {
        $id = $_POST['id'];
        $usuario = mb_strtoupper(trim($_POST['usuario']), 'UTF-8');
        $login = mb_strtoupper(trim($_POST['login']), 'UTF-8');
        $estado = $_POST['estado'];
        $valor = $_POST['valor'];
        $tipo = $_POST['tipo'];
        $pass = $_POST['pass'];
        $validar = $oconfiguracion->ValidarUsuario($login)->fetch();
        //while($fila=$validar->fetch()){$can=$fila[0];}
        $can = $validar[0];
        if ($valor == 1) {
            if ($can == 0) {
                // si el valor es igual a 1 insertamos
                $insertar = $oconfiguracion->RegistrarUsuario($usuario, $login, $pass, $estado, $tipo);
                echo $insertar;
            } else
                echo 2;exit;
        }
        if ($valor == 2) {
            //if(strlen($_POST['pass'])==32){$pass=$_POST['pass'];}else{$pass=md5($_POST['pass']);}
            // si el valor es igual a 2 modificamos
            $modificar = $oconfiguracion->ModificarUsuario($id, $usuario, $login, $pass, $estado, $tipo);
            echo $modificar;
        }
    }

    if ($accion == 'LLENAR_USUARIO') {
        $id = $_POST['id'];
        $listar = $oconfiguracion->UsuarioXId($id);
        echo json_encode($listar->fetch());
    }

    // MANTENEDOR DE SERIES

    if ($accion == 'LIS_SERIE') {
        $tbl = '';
        $i = 0;

        $listar = $oconfiguracion->LisSerie();
        while ($fila = $listar->fetch()) {
            $i++;
            $id = 'TblSerie_' . $i;
            if ($i % 2 == 0) {
                $color = "style=' background-color:#f5f5f5; height:30px'";
            } else {
                $color = "style='background-color:#ffffff; height:30px'";
            }
            $tbl .= "<tr $color id='$id' onclick=\"javascript:PintarFilaSerie('$id')\" idserie=$fila[0]  >
				            <td align='center' style='font-size:11px' >$i</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[1]</td>
							<td align='center' style='font-size:11px'>$fila[2]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[3]</td>
				        </tr>";
        }
        echo $tbl;
    }

    if ($accion == "LLENAR_TIPODOC") {
        $tbl = "";
        $id = $_POST['id'];
        $tbl = "<option value='0'></option>";
        $listar = $oconfiguracion->LisTipoDoc();
        while ($fila = $listar->fetch()) {
            if ($id == $fila[0]) {
                $selec = "selected='selected'";
            } else {
                $selec = "";
            }
            $tbl .= "<option value='$fila[0]' $selec >$fila[2]</option>";
        }
        echo $tbl;
    }

    if ($accion == 'NUEVO_SERIE') {
        $id = $_POST['id'];
        $serie = mb_strtoupper(trim($_POST['serie']), 'UTF-8');
        $valor = $_POST['valor'];
        $tipo = explode('-', $_POST['tipo']);
        $nomenclatura = mb_strtoupper(trim($_POST['nom']), 'UTF-8');
        $val = $oconfiguracion->ValSer($serie, $nomenclatura)->fetch();
        $error = $val[0];

        if ($error > 0) {
            echo 2;
            exit;
        }
        if ($valor == 1) {
            // si el valor es igual a 1 insertamos
            $insertar = $oconfiguracion->RegistrarSerie(trim($tipo[0]), $serie, $nomenclatura);
            echo $insertar;
        }
        /* if ($valor==2){
          // si el valor es igual a 2 modificamos
          $modificar=$oconfiguracion->ModificarSerie($id,$tipo,$serie,$nomenclatura);
          echo $modificar;
          } */
    }

    // MANTENEDOR DE CAJAS

    if ($accion == 'LIS_CAJA') {
        $tbl = '';
        $i = 0;

        $listar = $oconfiguracion->LisCaja();
        while ($fila = $listar->fetch()) {
            $i++;
            $id = 'TblCaja_' . $i;
            if ($fila['estado'] == 0) {
                $est = 'HABILITADA';
            } else {
                $est = 'DESHABILITADA';
            }
            if ($i % 2 == 0) {
                $color = "style=' background-color:#f5f5f5; height:30px'";
            } else {
                $color = "style='background-color:#ffffff; height:30px'";
            }
            $tbl .= "<tr $color id='$id' onclick=\"javascript:PintarFilaCaja('$id')\" idcaja=$fila[0] nom='$fila[1]' est='$fila[4]' >
				            <td align='center' style='font-size:11px' >$i</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[1]</td>
							<td align='center' style='font-size:11px'>$fila[2]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[3]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$est</td>
							<td align='center' style='font-size:11px'>&nbsp;&nbsp;
							<img src='img/asignar.png' alt='Asignar Series' title='Asignar Series' height='25' width='25' style='cursor:pointer' 
							onclick=\"javascript:AbrirModalAsignar('$fila[0]')\">
							</td>
				        </tr>";
        }
        echo $tbl;
    }

    if ($accion == 'NUEVO_CAJA') {
        $id = $_POST['id'];
        $caja = mb_strtoupper(trim($_POST['caja']), 'UTF-8');
        $valor = $_POST['valor'];
        $est = $_POST['est'];
        $user = 'MELIAS'; //$_SESSION['S_user'];
        if ($valor == 1) {
            // si el valor es igual a 1 insertamos
            $insertar = $oconfiguracion->RegistrarCaja($caja, $est, $user);
            echo $insertar;
        }
        if ($valor == 2) {
            // si el valor es igual a 2 modificamos
            $modificar = $oconfiguracion->ModificarCaja($id, $caja, $est);
            echo $modificar;
        }
    }

    if ($accion == "LLE_TIPODOC") {
        $tbl = "";
        $id = $_POST['id'];
        $tbl = "<option value='0'></option>";
        $listar = $oconfiguracion->LisTipoDocCaja($id);
        while ($fila = $listar->fetch()) {
            $tbl .= "<option value='$fila[0]' >$fila[1]</option>";
        }
        echo $tbl;
    }

    if ($accion == "LLE_SERIES") {
        $tbl = "";
        $cod = $_POST['cod'];
        $tbl = "<option value='0'></option>";
        $listar = $oconfiguracion->LisSeriesCaja($cod);
        while ($fila = $listar->fetch()) {
            $tbl .= "<option value='$fila[0]' >$fila[2]</option>";
        }
        echo $tbl;
    }
    if ($accion == 'NUEVO_CAJA_SERIE') {
        $idcaja = $_POST['id'];
        $idserie = $_POST['idserie'];
        $cod = $_POST['cod'];
        $insertar = $oconfiguracion->RegistrarSeriesCaja($idcaja, $idserie, $cod);
        echo $insertar;
    }
    if ($accion == 'LIS_SERIE_CAJA') {
        $tbl = '';
        $i = 0;
        $idcaja = $_POST['idcaja'];
        $listar = $oconfiguracion->ListarSeriesCaja($idcaja);
        while ($fila = $listar->fetch()) {
            $i++;

            $tbl .= "<tr  id='$id' >
				            <td  style='font-size:11px' >$fila[0]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[1]</td>
							<td ' style='font-size:11px'>$fila[2]</td>
				        </tr>";
        }
        echo $tbl;
    }

    // MANTENEDOR DE ESPECIALIDADES

    if ($accion == 'LIS_ESP') {
        $tbl = '';
        $i = 0;
        $buscar = $_POST['buscar'];
        $listar = $oconfiguracion->LisEsp($buscar);
        while ($fila = $listar->fetch()) {
            $i++;
            $id = 'TblEsp_' . $i;
            if ($i % 2 == 0) {
                $color = "style=' background-color:#f5f5f5; height:30px'";
            } else {
                $color = "style='background-color:#ffffff; height:30px'";
            }
            $tbl .= "<tr $color id='$id' onclick=\"javascript:PintarFilaEsp('$id')\" idesp=$fila[0] nom='$fila[1]' est='$fila[2]' >
				            <td align='center' style='font-size:11px' >$i</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[1]</td>
				        </tr>";
        }
        echo $tbl;
    }
    if ($accion == 'NUEVO_ESP') {
        $id = $_POST['id'];
        $nombre = mb_strtoupper(trim($_POST['nombre']), 'UTF-8');
        $valor = $_POST['valor'];
        if ($valor == 1) {
            // si el valor es igual a 1 insertamos
            $insertar = $oconfiguracion->RegistrarEsp($nombre);
            echo $insertar;
        }
        if ($valor == 2) {
            // si el valor es igual a 2 modificamos
            $modificar = $oconfiguracion->ModificarEsp($id, $nombre);
            echo $modificar;
        }
    }
    if ($accion == 'ELI_ESP') {
        $id = $_POST['id'];
        $eliminar = $oconfiguracion->EliminarEsp($id);
        echo $eliminar;
    }

    // MANTENEDOR DE MEDICOS

    if ($accion == 'LIS_MED') {
        $tbl = '';
        $i = 0;
        $buscar = $_POST['buscar'];
        $listar = $oconfiguracion->LisMedico($buscar);
        //echo $listar;exit;
        while ($fila = $listar->fetch()) {
            $i++;
            $id = 'TblMed_' . $i;
            if ($i % 2 == 0) {
                $color = "style=' background-color:#f5f5f5; height:30px'";
            } else {
                $color = "style='background-color:#ffffff; height:30px'";
            }
            $tbl .= "<tr $color id='$id' onclick=\"javascript:PintarFilaMed('$id')\" idmed='$fila[0]' idper='$fila[6]'  >
				            <td align='center' style='font-size:11px' >$i</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[1]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[2]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[3]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[4]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[5]</td>
							<td style='font-size:11px' align='center'>
							<img src='img/agregar.png' alt='Agregar Especialidad' title='Agregar Especialidad' 
							height='20' width='20' style='cursor:pointer' 
							onclick=\"javascript:AbrirModalMedEsp('$fila[0]','$fila[1]')\">
							</td>
				        </tr>";
        }
        echo $tbl;
    }
    if ($accion == 'NUEVO_MEDICO') {
        $id = $_POST['id'];
        $idper = $_POST['idper'];
        $dni_ant = $_POST['dni_ant'];
        $dni = $_POST['dni'];
        $valor = $_POST['valor'];
        $pat = mb_strtoupper(trim($_POST['pat']), 'UTF-8');
        $mat = mb_strtoupper(trim($_POST['mat']), 'UTF-8');
        $nom = mb_strtoupper(trim($_POST['nom']), 'UTF-8');
        $fec_nac = $_POST['fec_nac'];
        $sexo = $_POST['sexo'];
        $dir = mb_strtoupper(trim($_POST['dir']), 'UTF-8');
        $foto = $_POST['foto'];
        $cmp = $_POST['cmp'];
        $comision = $_POST['comision'];
        $tel = $_POST['tel'];


        if ($valor == 1) {
            // si el valor es igual a 1 insertamos
            $insertar = $oconfiguracion->RegistrarMedico($idper, $cmp, $comision, $tel);
            echo $insertar;
        }
        if ($valor == 2) {
            // si el valor es igual a 2 modificamos
            $modificar = $oconfiguracion->ModificarMedico($id, $idper, $cmp, $comision, $tel);
            echo $modificar;
        }
    }



    if ($accion == "LLE_ESP") {
        $tbl = "";
        $tbl = "<option value='0'></option>";
        $listar = $oconfiguracion->LisEsp('');
        while ($fila = $listar->fetch()) {
            $tbl .= "<option value='$fila[0]' >$fila[1]</option>";
        }
        echo $tbl;
    }
    if ($accion == 'LIS_MED_ESP') {
        $tbl = '';
        $i = 0;
        $idmed = $_POST['idmed'];
        $listar = $oconfiguracion->LisMedEsp($idmed);
        //echo $listar;exit;
        while ($fila = $listar->fetch()) {
            $i++;
            $id = 'TblMed_' . $i;
            if ($i % 2 == 0) {
                $color = "style=' background-color:#f5f5f5; height:30px'";
            } else {
                $color = "style='background-color:#ffffff; height:30px'";
            }
            $tbl .= "<tr $color id='$id' >
				            <td align='center' style='font-size:11px' >$i</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[1]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[2]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;
							<img src='img/delete.png' alt='Eliminar Especialidad' title='Eliminar Especialidad' 
							height='20' width='20' style='cursor:pointer' 
							onclick=\"javascript:EliminarMedEsp('$fila[0]','$fila[3]')\">
							</td>
				        </tr>";
        }
        echo $tbl;
    }

    if ($accion == 'LLENAR_MED') {
        $idmed = $_POST['idmed'];
        $listar = $oconfiguracion->MedXId($idmed);
        echo json_encode($listar->fetch());
    }

    if ($accion == 'NUEVO_MED_ESP') {
        $idmed = $_POST['idmed'];
        $idesp = $_POST['idesp'];
        $rne = $_POST['rne'];

        // si el valor es igual a 1 insertamos
        $insertar = $oconfiguracion->RegistrarMedEsp($idmed, $idesp, $rne);
        echo $insertar;
    }
    if ($accion == 'ELI_MED_ESP') {
        $id = $_POST['id'];
        // si el valor es igual a 1 insertamos
        $eliminar = $oconfiguracion->EliminarMedEsp($id);
        echo $eliminar;
    }

    // MANTENEDOR DE PACIENTES

    if ($accion == 'LIS_PAC') {
        $tbl = '';
        $i = 0;
        $buscar = $_POST['buscar'];
        $listar = $oconfiguracion->LisPaciente($buscar);
        //echo $listar;exit;
        while ($fila = $listar->fetch()) {
            $i++;
            $id = 'TblPac_' . $i;
            if ($i % 2 == 0) {
                $color = "style=' background-color:#f5f5f5; height:30px'";
            } else {
                $color = "style='background-color:#ffffff; height:30px'";
            }
            $tbl .= "<tr $color id='$id' onclick=\"javascript:PintarFilaPac('$id')\" idpac='$fila[0]' idperpac='$fila[5]'  >
				            <td align='center' style='font-size:11px' >$i</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[1]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[2]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[3]</td>
							<td style='font-size:11px'>&nbsp;&nbsp;$fila[4]</td>
				        </tr>";
        }
        echo $tbl;
    }

    if ($accion == 'NUEVO_PAC') {
        $id = $_POST['id'];
        $idper = $_POST['idper'];
        $dni_ant = $_POST['dni_ant'];
        $dni = $_POST['dni'];
        $valor = $_POST['valor'];
        $pat = mb_strtoupper(trim($_POST['pat']), 'UTF-8');
        $mat = mb_strtoupper(trim($_POST['mat']), 'UTF-8');
        $nom = mb_strtoupper(trim($_POST['nom']), 'UTF-8');
        $fec_nac = $_POST['fec_nac'];
        $sexo = $_POST['sexo'];
        $dir = mb_strtoupper(trim($_POST['dir']), 'UTF-8');
        $correo = $_POST['correo'];
        $resp = mb_strtoupper(trim($_POST['resp']), 'UTF-8');
        $tel_resp = $_POST['tel_resp'];
        $tel = $_POST['tel'];


        if ($valor == 1) {
            // si el valor es igual a 1 insertamos
            $insertar = $oconfiguracion->RegistrarPaciente($idper, $tel, $correo, $resp, $tel_resp);
            echo $insertar;
        }
        if ($valor == 2) {
            // si el valor es igual a 2 modificamos
            $modificar = $oconfiguracion->ModificarPaciente($id, $idper, $tel, $correo, $resp, $tel_resp);
            echo $modificar;
        }
    }

    if ($accion == 'LLENAR_PAC') {
        $idpac = $_POST['idpac'];
        $listar = $oconfiguracion->PacXId($idpac);
        echo json_encode($listar->fetch());
    }


    //PRODUCTO
    if ($accion == "LIS_SUC") {
        $nombre = $_POST["buscar"];
        $lista = $oconfiguracion->ListarSucursal($nombre);
        $tbl = "";
        $i = 0;
        foreach ($lista as $suc) {
            $i++;
            $id = 'TblSuc_' . $i;
            if ($i % 2 == 0) {
                $color = "style=' background-color:#f5f5f5; height:30px'";
            } else {
                $color = "style='background-color:#ffffff; height:30px'";
            }

            $tbl .= "<tr id='$id' idSUC='$suc[0]'  $color onclick=\"PintarFilaSUC('$id')\">"
                    . "<td >$i</td>"
                    . "<td align='center'><img width='50px' height='50px' src='controlador/archivos/$suc[3]'></td>"
                    . "<td >$suc[4]</td>"
                    . "<td >$suc[1]</td>"
                    . "<td >$suc[5]</td>"
                    . "<td >$suc[6]</td>"
                    . "<td >$suc[2]</td>"
                    . "<td >$suc[7]</td>"
                    . "<td >$suc[9]</td>"
                    . "</tr>";
        }

        echo $tbl;
    }
    if ($accion == 'LLENAR_SUC') {
        $id = $_POST['id'];
        $listar = $oconfiguracion->ListarSucursalxid($id);
        echo json_encode($listar->fetch());
    }
    if ($accion == 'NUEVO_SUC') {
        $nombre = $_POST['nombre'];
        $responsable = $_POST['responsable'];
        $ruc = $_POST['ruc'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $celular_responsable = $_POST['celular_responsable'];

        $valor = $_POST['valor'];
        $validar = $oconfiguracion->ValidarSucursal($nombre)->fetch();

        $can = $validar[0];

        // si el valor es igual a 1 insertamos
        if ($valor == 1) {
            if ($can == 0) {

                //VERIFICAR SI SE ENVIA ARCHIVO
                if (($_FILES['logo']['name'] != "")) {

                    $nombre_archivo = $_FILES['logo']['name'];
                    $tipo_archivo = $_FILES['logo']['type'];
                    $tamano_archivo = $_FILES['logo']['size'];
                    $path = "archivos";
                    //VERIFICAR SI SE SUBIO SIN ERROR
                    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                        //CREAR CARPETA SI NO EXISTE
                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }
                        // SI SE MUEVE A LA CARPTEA CORRECTAMENTE REGISTRAMOS
                        if (move_uploaded_file($_FILES['logo']['tmp_name'], $path . "/" . $nombre_archivo)) {
                            $insertar = $oconfiguracion->RegistrarSucursal($nombre, $responsable, $nombre_archivo, $ruc, $direccion, $telefono, $correo, $celular_responsable);
                            echo $insertar;
                        } else {
                            echo "error al mover el archivo";
                        }
                    } else {
                        echo $_FILES['logo']['error'];
                    }
                } else {
                    echo "sin archivo";
                }
            } else
                echo 2;exit;
        }
        // si el valor es igual a 2 modificamos
        if ($valor == 2) {
            $id = $_POST["id"];
            //VERIFICAR SI SE ENVIA ARCHIVO
            if (($_FILES['logo']['name'] != "")) {

                $nombre_archivo = $_FILES['logo']['name'];
                $tipo_archivo = $_FILES['logo']['type'];
                $tamano_archivo = $_FILES['logo']['size'];
                $path = "archivos";
                //VERIFICAR SI SE SUBIO SIN ERROR
                if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {

                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }
                    // SI SE MUEVE A LA CARPTEA CORRECTAMENTE MODIFICAMOS
                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $path . "/" . $nombre_archivo)) {

                        $modificar = $oconfiguracion->ModificarSucursal($id, $nombre, $responsable, $nombre_archivo, $ruc, $direccion, $telefono, $correo, $celular_responsable);

                        echo $modificar;
                    } else {
                        echo "error al mover el archivo";
                    }
                } else {
                    echo $_FILES['logo']['error'];
                }
            } else {
                //MODIFICAMOS SIN LOGO
                $modificar = $oconfiguracion->ModificarSucursalsinLogo($id, $nombre, $responsable, $ruc, $direccion, $telefono, $correo, $celular_responsable);

                echo $modificar;
            }
        }
    }
    if ($accion == 'ELIMINAR_SUC') {
        $id = $_POST['id'];

        $eliminar = $oconfiguracion->EliminarSucursal($id);
        $listar = $oconfiguracion->ListarSucursalxid($id);
        $sucursal=$listar->fetch();
        unlink("archivos/".$sucursal[3]);
        echo $eliminar;
    }
}

?>