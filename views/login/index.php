<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/login.css">
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <p>
            <label for="email">Correo</label>
            <input type="email" name="email" id="email" require>
        </p>
        <p>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" require>
        </p>
        <p>
            <input type="submit" value="Iniciar Sesión">
        </p>
        <p>
            ¿Olvidaste tu contraseña? <a href="<?php echo constant('URL'); ?>recuperar">recuperar contraseña</a>
        </p>
    </form>
</body>
</html>