<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/instrucciones.css">
    <title>Instrucciones - <?php echo $_SESSION['accion']; ?></title>
</head>
<body>
    <div class="content">
        <div class="content-img">
            <img src="<?php echo constant('URL');?>public/img/retiro.png">
        </div>

        <a href="<?php echo constant('URL');?>main" class="btn btn-back mt-2">Volver</a>
    </div>
</body>
</html>
