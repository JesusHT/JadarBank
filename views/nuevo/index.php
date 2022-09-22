<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JADAR BANK</title>
</head>
<body>
    <?php require 'views/header.php'; ?>

    <div class="area">
        <h1 class="center">Registro</h1>

        <form action="<?php echo constant('URL'); ?>nuevo/registrarCliente" method="POST" >
            <p>
                <label for="matricula">Matricula</label><br>
                <input type="text" name="matricula" id="">
            </p>
            <p>
                <label for="matricula">Nombre</label><br>
                <input type="text" name="nombre" id="">
            </p>
            <p>
                <br>
                <input type="submit" value="Registrar">
            </p>
        </form>
    </div>
</body>
</html>