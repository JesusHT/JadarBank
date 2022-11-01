<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>/public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="content">
        <?php $this -> showMessages(); ?>
        <div class="login-main">
            <h2>Inicio de sesión</h2>
            <form action="<?php echo constant('URL'); ?>login/authenticate" method="POST">
                
                <label for="email">Correo</label>
                <input type="email" name="email" id="email" placeholder="nombre@ejemplo.com" require>
                <label for="password">Contraseña</label>
                <input type="password" name="pass" id="password" placeholder="*******" require>
                <button type="submit" class="btn-login">Iniciar Sesión</button>                
                
            </form>
            <span>¿Olvidaste tu contraseña? <a href="<?php echo constant('URL'); ?>recuperar">Recuperar</a></span>
        </div>
    </div>
</body>
</html>