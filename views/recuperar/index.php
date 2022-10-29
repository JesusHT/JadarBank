<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/global.css">
    <title>Recuperar</title>
</head>
<body>
    <p>
        <label for="email_recuperar">Correo</label>
        <input type="email" name="email_recuperar" id="email_recuperar">
    </p>
    <p>
        <input type="submit" value="Recuperar Contraseñas">
    </p>
    <p>
        <a href="<?php echo constant('URL'); ?>">Regresar al login </a>
    </p>
</body>
</html>