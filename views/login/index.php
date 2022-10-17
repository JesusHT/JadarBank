<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>/public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/style.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="content">
        <div class="formContent ">
            <?php $this -> showMessages(); ?>
            <form action="<?php echo constant('URL'); ?>login/authenticate" method="POST">
                <p>
                    <label for="email">Correo</label><br>
                    <input type="email" name="email" id="email" placeholder="nombre@ejemplo.com" require>
                </p>
                <p>
                    <label for="password">Contraseña</label><br>
                    <input type="password" name="pass" id="password" placeholder="*******" require>
                </p>
                <p>
                    <button type="submit" class="button">Iniciar Sesión</button>
                </p>
                <p>
                    ¿Olvidaste tu contraseña? <a href="<?php echo constant('URL'); ?>recuperar">recuperar contraseña</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>