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
    <?php 
        require_once 'views/nav.php';
        $this -> showMessages(); 
    ?>
    <div class="area">
        <h1 class="center">Prestamos</h1>
        <form action="<?php echo constant('URL'); ?>prestamos/calcular" method="POST">
            <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad en pesos">
            <select name="plazo" id="plazo">
                <option value="" selected hidden>Elija un plazo en meses</option>
            </select>
            
            <button type="submit" class="btn">Simular Prestamo</button>
        </form>
    </div>
    <script src="<?php echo constant('URL');?>public/js/prestamos.js"></script>
</body>
</html>