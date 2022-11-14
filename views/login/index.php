<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/login.css">
    <title>Inicio de sesión</title>
</head>
<body>
    <?php $this -> showMessages(); ?>
    <div class="login-content"  id="content-main">
        <img src="<?php echo constant('URL');?>public/img/logo.png" alt="JadarBank Logo">
        <h1>Inicio de sesión</h1>
        <form action="<?php echo constant('URL'); ?>login/authenticate" method="POST">
                
                <label for="email">Correo</label>
                <input type="email" name="email" id="email" placeholder="nombre@ejemplo.com" require>

                <label for="password">Contraseña</label>
                <input type="password" name="pass" id="password" placeholder="*******" require>
                
                <button type="submit" class="btn-login">Iniciar Sesión</button>                
                
        </form>
        <a href="<?php echo constant('URL'); ?>recuperar">¿Olvidaste tu contraseña?</a>
        <a href="<?php echo constant('URL'); ?>registro">¿No tienes una cuenta?</a>
    </div>
</body>
</html>