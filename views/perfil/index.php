<?php  
    $user = $this -> d['client'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/perfil.css">
    <title>Perfil</title>
</head>
<body>
    <?php $this -> showMessages();?>
    <main class="main">
        <?php $this -> navController(); ?>
        <section class="content"  id="content-main">
            <div class="header">
                <div class="content-img">
                    <img src="<?php echo constant('URL');?>public/img/<?php echo $user['img_client']; ?>" alt="Imagen de perfil">
                    <p><?php echo $user['name'];?></p>
                </div>
            </div>
            <div class="body">
                <ul class="lista-datos">
                    <li><i class="icono fas fa-solid fa-hashtag"></i><span> Número de cliente: </span><?php echo $user['num_client']                                                        ;?></li>
                    <li><i class="icono fas fa-solid fa-flag"></i>   <span> Pais:              </span><?php echo $user['pais']                                                              ;?></li>
                    <li><i class="icono fas fa-map-marker-alt"></i>  <span> Dirección:         </span><?php echo $user['estado'] . ', ' . $user['ciudad'] . ', ' . $user['domicilio'] . '.' ;?></li>
                    <li><i class="icono fas fa-phone-alt"></i>       <span> Télefono:          </span><?php echo $user['tel']                                                               ;?></li>
                    <li><i class="icono fas fa-calendar-alt"></i>    <span> Fecha nacimiento:  </span><?php echo $user['fena']                                                              ;?></li>
                </ul>
            </div>
            <div class="footer mt-2">
                <a id="configuracion" class="activo">Configuración</a>
                <a id="edit">Contraseña</a>
                <a id="notifications">Notifiaciones</a>
                <hr class="mb-2 mt-1">
                <div class="active" id="configuracion-content">
                    <form action="" method="POST">
                        <div class="config">
                            <div class="option">
                                <p>Verificación en 2 pasos</p><input type="checkbox" name="validacion" id="switch"  value="0"><label for="switch"></label>
                            </div>
                            <div class="option">
                                <p>Cobro automático       </p><input type="checkbox" name="cobro"      id="switch2" value="0"><label for="switch2"></label>
                            </div>
                        </div>

                        <div class="content-button">
                            <button type="submit" class="btn mt-2 bg-success"><i class="fa-solid fa-floppy-disk"></i> Guardar </button>
                        </div>
                    </form>
                </div>
                <div class="" id="edit-content">
                    <form action="" method="post">
                        <input type="password" name="pass"           id="pass"           placeholder="Ingrese su contraseña actual" required>
                        <input type="password" name="newpass"        id="newpass"        placeholder="Ingrese su nueva contraseña"  required>
                        <input type="password" name="newpassconfirm" id="newpassconfirm" placeholder="Confirme su nueva contraseña" required>
                        <div class="content-button">
                            <button type="submit" class="btn mt-2 bg-success"><i class="fa-solid fa-floppy-disk"></i> Guardar </button>
                        </div>
                    </form>
                </div>
                <div class="" id="notifications-content">
                    <form action="" method="post">
                        <div class="content-button">
                            <button type="submit" class="btn mt-2 bg-success"><i class="fa-solid fa-floppy-disk"></i> Guardar </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script src="<?php echo constant('URL') . 'public/js/';?>profile.js"></script>
</body>
</html>