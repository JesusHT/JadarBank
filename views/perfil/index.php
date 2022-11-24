<?php  $user   = $this -> d['client']; ?>
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
                    <li><i class="icono fas fa-solid fa-hashtag"></i><span> Número de          </span><?php $num_client = $_SESSION['role'] === 'admin' ? 'empleado: ' . $user['num_empleado'] : 'cliente: ' . $user['num_client']; echo $num_client; ?></li>
                    <li><i class="icono fas fa-solid fa-flag"></i>   <span> Pais:              </span><?php echo $user['pais']                                                                                                                      ; ?></li>
                    <li><i class="icono fas fa-map-marker-alt"></i>  <span> Dirección:         </span><?php echo $user['estado'] . ', ' . $user['ciudad'] . ', ' . $user['domicilio'] . '.'                                                         ; ?></li>
                    <li><i class="icono fas fa-phone-alt"></i>       <span> Télefono:          </span><?php echo $user['tel']                                                                                                                       ; ?></li>
                    <li><i class="icono fas fa-calendar-alt"></i>    <span> Fecha nacimiento:  </span><?php echo $user['fena']                                                                                                                      ; ?></li>
                </ul>
            </div>
            <?php $this -> configClient(); ?>
        </section>
    </main>
</body>
</html>