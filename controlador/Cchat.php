<?php

require_once '../cado/ClaseChat.php';
date_default_timezone_set('America/Lima');
session_start();

$accion = $_POST["accion"];

$ochat = new Chat();

if ($accion == "LIS_CHAT") {
    $emisor = $_SESSION['S_user'];
    $receptor = $_POST["receptor"];
    $lista = $ochat->ListarMensajes($emisor, $receptor);
    $chat = "";
    foreach ($lista as $mensaje) {
        if ($mensaje[5]=="archivo") {
            
             if ($mensaje[1] == $emisor) {
            $chat .= "<div class='chat' >
    <div class='chat-avatar'>
        <a class='avatar m-0'>
            <img src='app-assets/images/portrait/small/avatar-s-11.png' alt='avatar' height='36' width='36' />
        </a>
    </div>
    <div class='chat-body'>
        <div class='chat-message'>
            <p class='mensaje'><a href='controlador/archivoschat/$mensaje[4]'><i class='ft ft-download'></i>$mensaje[4]</a></p>
            <span class='chat-time'>$mensaje[3]</span>
        </div> 
    </div>
</div>";
        } else {
            $chat .= "<div class='chat chat-left' >
    <div class='chat-avatar'>
        <a class='avatar m-0'>
            <img src='app-assets/images/portrait/small/avatar-s-26.png' alt='avatar' height='36' width='36' />
        </a>
    </div>
    <div class='chat-body'>
        <div class='chat-message'>
            <p class='mensaje'><a href='controlador/archivoschat/$mensaje[4]'><i class='ft ft-download'></i>$mensaje[4]</a></p>
            <span class='chat-time'>$mensaje[3]</span>
        </div> 
    </div>
</div>";
        }
            
        }else{
            
            
             if ($mensaje[1] == $emisor) {
            $chat .= "<div class='chat' >
    <div class='chat-avatar'>
        <a class='avatar m-0'>
            <img src='app-assets/images/portrait/small/avatar-s-11.png' alt='avatar' height='36' width='36' />
        </a>
    </div>
    <div class='chat-body'>
        <div class='chat-message'>
            <p class='mensaje'>$mensaje[4]</p>
            <span class='chat-time'>$mensaje[3]</span>
        </div> 
    </div>
</div>";
        } else {
            $chat .= "<div class='chat chat-left' >
    <div class='chat-avatar'>
        <a class='avatar m-0'>
            <img src='app-assets/images/portrait/small/avatar-s-26.png' alt='avatar' height='36' width='36' />
        </a>
    </div>
    <div class='chat-body'>
        <div class='chat-message'>
            <p class='mensaje'>$mensaje[4]</p>
            <span class='chat-time'>$mensaje[3]</span>
        </div> 
    </div>
</div>";
        }
            
        }
       
    }

    echo $chat;
}
if ($accion == "LIS_USUARIOS") {

    $buscar = $_POST["buscar"];
    $lista = $ochat->LisUsuarioChat($buscar);
    $chat = "";
    $i = 0;
    foreach ($lista as $u) {
        $i += 1;
        $chat .= "    <li id='contacto_$i' class='contacto'>
                            <div class='d-flex align-items-center' onclick=\"ActivarChat('$u[2]','contacto_$i');\">
                                <div class='avatar m-0 mr-50'><img src='app-assets/images/portrait/small/avatar-s-11.png' height='36' width='36' alt='sidebar user image'>
                                    <span class='avatar-status-away'></span>
                                </div>
                                <div class='chat-sidebar-name'   >
                                    <h6 class='mb-0'>$u[1]</h6><span class='text-muted'><b>$u[2]</b></span>
                                </div>
                            </div>
                        </li>";
    }

    echo $chat;
}


if ($accion == 'NUEVO_CHAT') {
    $emisor = $_SESSION['S_user'];
    $receptor = $_POST["receptor"];
    $mensaje = $_POST["mensaje"];
    $insertar = $ochat->RegistrarMensaje($emisor, $receptor, $mensaje);
    echo $insertar;
}

if ($accion == 'NUEVO_CHAT2') {


    $emisor = $_SESSION['S_user'];
    $receptor = $_POST["receptor"];

    if (($_FILES['file']['name']!="")) {

        $nombre_archivo = $_FILES['file']['name'];
        $tipo_archivo = $_FILES['file']['type'];
        $tamano_archivo = $_FILES['file']['size'];
        $path = "archivoschat";

        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if (move_uploaded_file($_FILES['file']['tmp_name'], $path . "/" . $nombre_archivo)) {
                $insertar = $ochat->RegistrarMensaje($emisor, $receptor,$nombre_archivo, "archivo");
                echo $insertar;
            } else {
                echo "error al mover el archivo";
                
            }
        } else {
            echo $_FILES['file']['error'];
        }
    } else {
        $mensaje = $_POST["mensaje"];
        $insertar = $ochat->RegistrarMensaje($emisor, $receptor, $mensaje, "mensaje");
        echo $insertar;
    }

//    
//datos del arhivo
//compruebo si las características del archivo son las que deseo
//    if (!((strpos($tipo_archivo, "docx") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 100000))) {
//        echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr>"
//        . "<td><li>Se permiten archivos .gif o .jpg<br>"
//        . "<li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
//    } else {
//    }
//
//    $insertar = $ochat->RegistrarMensaje($emisor, $receptor, $mensaje, $archivo);
//    echo $insertar;
}
