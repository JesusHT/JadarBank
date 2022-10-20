<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>/public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/global.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="content">
        <div class="formContent ">
            <div class="login-main">
                <?php $this -> showMessages(); ?>
                <h2 class="center">Inicio de sesión</h2>
                <form action="<?php echo constant('URL'); ?>login/authenticate" method="POST">
                    
                    <label for="email">Correo</label><br>
                    <input type="email" name="email" id="email" placeholder="nombre@ejemplo.com" require>
                    <label for="password">Contraseña</label><br>
                    <input type="password" name="pass" id="password" placeholder="*******" require>
                    <div class="center"><button type="submit" class="button">Iniciar Sesión</button></div>                
                    <br><span>¿Olvidaste tu contraseña?</span><a href="<?php echo constant('URL'); ?>recuperar">Recuperar</a>
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>