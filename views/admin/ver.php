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
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/ver.css">
    <title>Ver - <?php echo $user['num_client']; ?></title>
</head>
<body>
    <?php require 'views/nav.php'; ?>
    <div class="area">
        <div class="content">
            <div class="img">
                <img src="<?php echo constant('URL');?>public/img/<?php echo $user['img_client']; ?>" alt="">
            </div>
            <div class="info">
                <p><span>Número de cliente:</span> <?php echo $user['num_client'];?></p>
                <p><span>Nombre:           </span> <?php echo $user['name']      ;?></p>
                <p><span>Estatus:          </span> <?php echo $user['status']    ;?></p>
            </div>
            <div class="prestamos">
                <form action="<?php echo constant('URL'); ?>ver/generarprestamo" method="post">
                    <input type="hidden" name="prestamo" value="<?php echo $user['num_client']; ?>">
                    <button type="submit" class="btn">Generar prestamo</button>
                </form>
            </div>
        </div>
        <a href="<?php echo constant('URL');?>editar/volver" class="btn btn-a">Regresar</a>
    </div>
</body>
</html>