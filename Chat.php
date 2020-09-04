<?php include("cado/ClaseChat.php"); ?>
<!-- BEGIN: Content-->

<div class="sidebar-left">
    <div class="sidebar">
        <!-- app chat user profile left sidebar start -->
        <div class="chat-user-profile">
            <header class="chat-user-profile-header text-center border-bottom">
                <span class="chat-profile-close">
                    <i class="ft-x"></i>
                </span>
                <div class="my-2">

                    <img src="app-assets/images/portrait/small/avatar-s-11.png" class="round mb-1" alt="user_avatar" height="100" width="100">

                    <h5 class="mb-0">John Doe</h5>
                    <span>Designer</span>
                </div>
            </header>
            <div class="chat-user-profile-content">
                <div class="chat-user-profile-scroll">
                    <h6 class="text-uppercase mb-1">ABOUT</h6>
                    <p class="mb-2">It is a long established fact that a reader will be distracted by the readable content .</p>
                    <h6>PERSONAL INFORAMTION</h6>
                    <ul class="list-unstyled mb-2">
                        <li class="mb-25">email@gmail.com</li>
                        <li>+1(789) 950 -7654</li>
                    </ul>
                    <h6 class="text-uppercase mb-1">CHANNELS</h6>
                    <ul class="list-unstyled mb-2">
                        <li><a href="javascript:void(0);"># Devlopers</a></li>
                        <li><a href="javascript:void(0);"># Designers</a></li>
                    </ul>
                    <h6 class="text-uppercase mb-1">SETTINGS</h6>
                    <ul class="list-unstyled">
                        <li class="mb-50 "><a href="javascript:void(0);" class="d-flex align-items-center"><i class="ft-tag mr-50"></i>
                                Add
                                Tag</a></li>
                        <li class="mb-50 "><a href="javascript:void(0);" class="d-flex align-items-center"><i class="ft-star mr-50"></i>
                                Important Contact</a>
                        </li>
                        <li class="mb-50 "><a href="javascript:void(0);" class="d-flex align-items-center"><i class="ft-image mr-50"></i>
                                Shared
                                Documents</a></li>
                        <li class="mb-50 "><a href="javascript:void(0);" class="d-flex align-items-center"><i class="ft-trash-2 mr-50"></i>
                                Deleted
                                Documents</a></li>
                        <li><a href="javascript:void(0);" class="d-flex align-items-center"><i class="ft-x-circle mr-50"></i> Blocked
                                Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- app chat user profile left sidebar ends -->
        <!-- app chat sidebar start -->
        <div class="chat-sidebar card">
            <span class="chat-sidebar-close">
                <i class="ft-x"></i>
            </span>
            <div class="chat-sidebar-search">
                <div class="d-flex align-items-center">
                    <div class="chat-sidebar-profile-toggle">
                        <div class="avatar">
                            <img src="app-assets/images/portrait/small/avatar-s-11.png" class="cursor-pointer" alt="user_avatar" height="36" width="36">
                        </div>
                    </div>
                    <fieldset class="form-group position-relative has-icon-left mx-75 mb-0">
                        <input type="text" class="form-control round" id="chat-search" onkeyup="ListarUsuariosChat($(this).val())" placeholder="Buscar">
                        <div class="form-control-position">
                            <i class="ft-search text-dark"></i>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="chat-sidebar-list-wrapper pt-2">

                <h6 class="px-2 pt-2 pb-25 mb-0">CONTACTOS<i class="ft-plus float-right cursor-pointer"></i></h6>
                <?php
                $ochat = new Chat();
                $usuarios = $ochat->LisUsuarioChat("");
                ?>
                <ul id="chat-contactos" class="chat-sidebar-list">
                    <?php foreach ($usuarios as $u) { ?>
                        <li >
                            <div class="d-flex align-items-center" onclick="ActivarChat('<?= $u[2] ?>', '');">
                                <div class="avatar m-0 mr-50"><img src="app-assets/images/portrait/small/avatar-s-11.png" height="36" width="36" alt="sidebar user image">
                                    <span class="avatar-status-away"></span>
                                </div>
                                <div class="chat-sidebar-name"   >
                                    <h6 class="mb-0"><?= $u[1] ?></h6><span class="text-muted"><b><?= $u[2] ?></b></span>
                                </div>
                            </div>
                        </li>
                    <?php } ?> 
                </ul>
            </div>
        </div>
        <!-- app chat sidebar ends -->

    </div>
</div>
<div class="content-right">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- app chat overlay -->
            <div class="chat-overlay"></div>
            <!-- app chat window start -->
            <section class="chat-window-wrapper">
                <div class="chat-start">
                    <span class="ft-message-square chat-sidebar-toggle chat-start-icon font-large-3 p-3 mb-1"></span>
                    <h4 class="d-none d-lg-block py-50 text-bold-500">Seleccione un contacto para iniciar el chat</h4>
                    <button class="btn btn-light-primary chat-start-text chat-sidebar-toggle d-block d-lg-none py-50 px-1">Start
                        Conversation!</button>
                </div>
                <div class="chat-area d-none">
                    <div class="chat-header">
                        <header class="d-flex justify-content-between align-items-center px-1 py-75">
                            <div class="d-flex align-items-center">
                                <div class="chat-sidebar-toggle d-block d-lg-none mr-1"><i class="ft-align-justify font-large-1 cursor-pointer"></i>
                                </div>
                                <div class="avatar chat-profile-toggle m-0 mr-1">
                                    <img src="app-assets/images/portrait/small/avatar-s-26.png" class="cursor-pointer" alt="avatar" height="36" width="36" />
                                    <span class="avatar-status-busy"></span>
                                </div>
                                <h6 class="mb-0" id="chat-nombre-receptor">Elizabeth Elliott</h6>
                            </div>
                            <div class="chat-header-icons">
                                <span class="chat-icon-favorite">
                                    <i class="ft-star font-medium-5 cursor-pointer"></i>
                                </span>
                                <span class="dropdown">
                                    <i class="ft-more-vertical font-medium-4 ml-25 cursor-pointer dropdown-toggle nav-hide-arrow cursor-pointer" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                    </i>
                                    <span class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="JavaScript:void(0);"><i class="ft-tag mr-25"></i> Pin to top</a>
                                        <a class="dropdown-item" href="JavaScript:void(0);"><i class="ft-trash-2 mr-25"></i> Delete chat</a>
                                        <a class="dropdown-item" href="JavaScript:void(0);"><i class="ft-x-circle mr-25"></i> Block</a>
                                    </span>
                                </span>
                            </div>
                        </header>
                    </div>
                    <!-- chat card start -->
                    <div class="card chat-wrapper shadow-none mb-0">
                        <div class="card-content">
                            <div class="card-body chat-container">
                                <div class="chat-content">

                                    <!--<div class="badge badge-pill badge-light-secondary my-1">Yesterday</div>-->

                                </div>
                            </div>
                        </div>
                        <div class="card-footer chat-footer px-2 py-1 pb-0 custom-file">

                            <form class="d-flex align-items-center" id="form-chat" onsubmit="/*EnviarMensaje();*/" action="javascript:void(0);">
                                <!--<i class="ft-user cursor-pointer"></i>-->
                                <i id="paperclip" ver="oculto" class="ft-paperclip ml-1 cursor-pointer" onclick="archivo();"></i>
                                &nbsp;
                                <fieldset id="fielset" class="form-group d-none" style="width: 100%;" >
                                    <div class="custom-file" style="height: 10px">
                                        <input type="file" name="file" id="chat-file"  class="custom-file-input">
                                        <label id="chat-nombre-file" class="custom-file-label" for="chat-file" aria-describedby="chat-file">Selecciona un archivo</label>
                                    </div>
                                </fieldset>
                                <!--ocultar o ver input file-->
                                <script>
                                    function archivo() {
                                        
                                        if ($("#paperclip").attr("ver") == "oculto") {
                                            $("#fielset").removeClass("d-none");
//                                            $("#paperclip").attr("ver", "");
                                            $("#paperclip").attr("ver", "visible");
                                            $("#chat-mensaje").addClass("d-none");
                                            return false;
                                        }
                                        if ($("#paperclip").attr("ver") == "visible") {
                                            $("#fielset").addClass("d-none");
                                            $("#paperclip").attr("ver", "oculto");
                                            $("#chat-mensaje").removeClass("d-none");
                                            return false;
                                        }
                                        
                                    }
                                </script>
                                <input type="hidden" name="receptor" id="chat-activo">
                                <input type="hidden" name="accion" value="NUEVO_CHAT2">

                                <input type="text" style="height: 41px;" name="mensaje"  autocomplete="off" id="chat-mensaje" class="form-control chat-message-send mx-1" placeholder="Escribe un mensaje aquí...">
                                &nbsp;
                                <button type="submit" id="chat-btn-enviar" style="background: #B8155F;color:white" class="btn  glow send d-lg-flex"><i class="ft-play"></i>
                                    <span class="d-none d-lg-block mx-50">Enviar</span></button>
                            </form>
                        </div>
                    </div>
                    <!-- chat card ends -->
                </div>
            </section>
            <!-- app chat window ends -->
            <!-- app chat profile right sidebar start -->
            <section class="chat-profile">
                <header class="chat-profile-header text-center border-bottom">
                    <span class="chat-profile-close">
                        <i class="ft-x"></i>
                    </span>
                    <div class="my-2">

                        <img src="app-assets/images/portrait/small/avatar-s-26.png" class="round mb-1" alt="chat avatar" height="100" width="100">

                        <h5 class="app-chat-user-name mb-0">Elizabeth Elliott</h5>
                        <span>Devloper</span>
                    </div>
                </header>
                <div class="chat-profile-content p-2">
                    <h6 class="mt-1">ABOUT</h6>
                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                    <h6 class="mt-2">PERSONAL INFORMATION</h6>
                    <ul class="list-unstyled">
                        <li class="mb-25">email@gmail.com</li>
                        <li>+1(789) 950-7654</li>
                    </ul>
                </div>
            </section>
            <!-- app chat profile right sidebar ends -->

        </div>
    </div>
</div>



<!-- END: Content-->


<div style="display:none" class="chat" id="chat-emisor">
    <div class="chat-avatar">
        <a class="avatar m-0">
            <img src="app-assets/images/portrait/small/avatar-s-11.png" alt="avatar" height="36" width="36" />
        </a>
    </div>
    <div class="chat-body">
        <div class="chat-message">
            <p class="mensaje">How can we help? We're here for you! 😄</p>
            <span class="chat-time">7:45 AM</span>
        </div> 
    </div>
</div>
<div style="display:none" class="chat chat-left" id="chat-receptor">
    <div class="chat-avatar">
        <a class="avatar m-0">
            <img src="app-assets/images/portrait/small/avatar-s-26.png" alt="avatar" height="36" width="36" />
        </a>
    </div>
    <div class="chat-body">
        <div class="chat-message">
            <p class="mensaje">Hey John, I am looking for the best admin template.</p>

            <span class="chat-time">7:50 AM</span>
        </div>

    </div>
</div>

<script type="text/javascript">
    var ws;
    function IniciarConexion() {
        //ws= new WebSocket("ws://achex.ca:4010");
        ws = new WebSocket("ws://127.0.0.1:12345");
        ws.onopen = function () {
            
//            ws.send('{"setID":"MichatRoom","passwd":"12345"}');
            alert("conexione establecida");
        }
        ws.onmessage = function (Mensajes) {
            console.log(Mensajes);
            var MensajesObtenidos = Mensajes.data;
            var objeto = jQuery.parseJSON(MensajesObtenidos);
            var activo = $("#chat-activo").val();
            var usuario = $("#BMusuario").val();
            if ((objeto.ContenidoM != null) && (objeto.NombreU != null && ((objeto.to == activo && objeto.NombreU == usuario) || (objeto.to == usuario && objeto.NombreU == activo)))) {
                // copiar el item del chat y anexarlo al chat
                if ($("#BMusuario").val() == objeto.NombreU) {
                    $("#chat-emisor").clone().appendTo(".chat-content");
                    $('.chat-content #chat-emisor').show(10);
//                   $('.chat-content #chat-emisor .chat-body .chat-message').html(objeto.NombreU);
                    if (objeto.tipo == "archivo") {
                        $('.chat-content #chat-emisor .chat-body .chat-message .mensaje').html("<a href='controlador/archivoschat/" + objeto.ContenidoM + "'><i class='ft ft-download'></i>" + objeto.ContenidoM + "</a>");
                    } else {
                        $('.chat-content #chat-emisor .chat-body .chat-message .mensaje').html(objeto.ContenidoM);
                    }
                    
                    
                    var formattedDate = new Date();
                    var d = formattedDate.getUTCDate() - parseInt(1);
                    var m = parseInt(formattedDate.getMonth()) + parseInt(1);
                    var y = formattedDate.getFullYear();
                    var h = formattedDate.getHours();
                    var min = formattedDate.getMinutes();
                    Fecha = d + "/" + m + "/" + y + " " + h + ":" + min;
                    $('.chat-content  #chat-emisor .chat-body .chat-time').html(Fecha);
                    $('.chat-content  #chat-emisor').attr("id", "");
                } else {
                    $("#chat-receptor").clone().appendTo(".chat-content");
                    $('.chat-content #chat-receptor').show(10);
                    $('#chat-nombre-receptor').html(objeto.NombreU);
                    if (objeto.tipo == "archivo") {
                        $('.chat-content #chat-receptor .chat-body .chat-message .mensaje').html("<a href='controlador/archivoschat/" + objeto.ContenidoM + "'><i class='ft ft-download'></i>" + objeto.ContenidoM + "</a>");
                    } else {
                        $('.chat-content #chat-receptor .chat-body .chat-message .mensaje').html(objeto.ContenidoM);
                    }
                    var formattedDate = new Date();
                    var d = formattedDate.getUTCDate() - parseInt(1);
                    var m = parseInt(formattedDate.getMonth()) + parseInt(1);
                    var y = formattedDate.getFullYear();
                    var h = formattedDate.getHours();
                    var min = formattedDate.getMinutes();
                    Fecha = d + "/" + m + "/" + y + " " + h + ":" + min;
                    $('.chat-content  #chat-receptor .chat-body .chat-time').html(Fecha);
                    $('.chat-content  #chat-receptor').attr("id", "");
                }
                
                
                
            }
            
            
            
        }
        ws.onclose = function () {
            alert("Conexión Cerrada");
        }
    }
    IniciarConexion();</script>
<script>
    
    
    function EnviarMensaje() {
        
        
        $.post('controlador/Cchat.php', {accion: "NUEVO_CHAT", receptor: $("#chat-activo").val(), mensaje: $('#chat-mensaje').val()}, function (data) {
        }).done(function () {
            ws.send('{"to":"' + $("#chat-activo").val() + '","NombreU":"' + $("#BMusuario").val() + '","ContenidoM":"' + $('#chat-mensaje').val() + '"}');
            $('#chat-mensaje').val("");
        }).fail(function () {
            console.log(data);
        });
    }
    
    function ActivarChat(usuario, contacto) {
//    alert(usuario);
        
        $("#chat-activo").val(usuario);
        $("#chat-nombre-receptor").html(usuario);
        $(".contacto").removeClass("active");
        $("#form-chat").find('#chat-mensaje').focus();
        $.post('controlador/Cchat.php', {accion: "LIS_CHAT", receptor: $("#chat-activo").val()}, function (data) {
            $(".chat-content").html(data);
            $(".chat-window-wrapper .chat-start ").addClass("d-none");
            $(".chat-window-wrapper .chat-area ").removeClass("d-none");
            $("#" + contacto).addClass("active");
        });
    }
    function ListarUsuariosChat(buscar) {
        
//        $("#chat-contactos").html("");
//        alert($("#chat-buscar").val())
        $.post('controlador/Cchat.php', {accion: "LIS_USUARIOS", buscar: buscar}, function (data) {
            $("#chat-contactos").html(data);
        });
    }
    
//    ENVIAR  ARCHIVOS
    $(document).on('submit', '#form-chat', function () {
//        $("#cargandoR").html(" <img width='40px' height='40px' src='../imagenes/cargando.gif'  >");
        
        if (!$("#fielset").hasClass("d-none")) {
            if ($("#chat-file").val() == '') {
                swal("Inserte archivo", "tamaño permitido 2MB", "info");
                return false;
            }
            tamano = Math.round($("#chat-file")[0].files[0].size / 1024 / 1024 * 100) / 100;
            if (tamano > 2) {
//                alert("error, tamaño:" + tamano + " mb");
                swal("Archivo excede los 2MB.", "tamaño:" + tamano + " MB", "info");
                $("#form-chat").trigger("reset");
                $("#chat-nombre-file").html("");
                return false;
            }
        }
        $("#chat-btn-enviar").prop("disabled", true);
        $.ajax({
            type: 'POST',
            url: 'controlador/Cchat.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (r) {
                $("#chat-btn-enviar").prop("disabled", false);
                
                console.log(r);
                if (!$("#fielset").hasClass("d-none")) {
                    
                    if (r == "1") {
                        ws.send('{"tipo":"archivo","to":"' + $("#chat-activo").val() + '","NombreU":"' + $("#BMusuario").val() + '","ContenidoM":"' + $('#chat-nombre-file').html() + '"}');
                        $('#chat-file').val("");
                        $("#chat-nombre-file").html("");
                    } else if (r == "0") {
                        swal("Mensaje no enviado ..", "Error", "error");
                        return false;
                    } else {
                        swal("Archivo no enviado ..", "Error", "error");
                        return false;
                    }
                    
                } else {
                    if (r == "1") {
                        ws.send('{"tipo":"mensaje","to":"' + $("#chat-activo").val() + '","NombreU":"' + $("#BMusuario").val() + '","ContenidoM":"' + $('#chat-mensaje').val() + '"}');
                        $('#chat-mensaje').val("");
                        return false;
                    } else if (r == "0") {
                        swal("Mensaje no enviado ..", "Error", "error");
                        return false;
                    }
                }
                
            }
        });
        return false;
    }
    );
    
    
</script>