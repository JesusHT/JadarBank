<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/prestamos.css">
    <title>JADAR BANK</title>
</head>
<body>
    <?php $this -> showMessages();?>
    <main class="main">
        <?php $this -> navController(); ?>
        <section class="content"  id="content-main">
            <h1>Prestamos</h1>
            <span class="span-error mb-1" id="span-error"></span>
            <form action="<?php echo constant('URL'); ?>prestamos/calcular" method="POST">
                <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad en pesos">
                <select name="plazo" id="plazo">
                    <option value="" selected hidden>Elija un plazo en meses</option>
                </select>
                <button type="submit" class="btn btn-prestamos">Simular Prestamo</button>
            </form>
            <script src="<?php echo constant('URL');?>public/js/prestamos.js"></script>
