<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/global.css">
    <title>JADAR BANK</title>
</head>
<body>
    <?php require 'views/nav.php'; ?>
    <div class="area">
        <h1>Hola ejectutivo <?php echo $cliente['name'];?>!</h1><br>
        <form action="<?php echo constant('URL'); ?>admin/tableUsers" method="POST">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar..." class="bg-dark text-white">
            <input type="submit" value="Buscar">
        </form><br>
	    <table class="table table-dark mt-3">
                <?php
                    echo $this -> d['tabla'];
                ?>
            </tbody>
	    </table>
    </div>
</body>
</html>