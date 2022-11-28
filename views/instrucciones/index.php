<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/instrucciones.css">
    <title>Instrucciones - <?php echo $_SESSION['accion']; ?></title>
</head>
<body>
    <div class="content">
        <div class="content-img">
            <p> Número de cliente: <?php echo $_SESSION['num_client']; ?><br>
                Cantidad:         $<?php echo $_SESSION['cantidad'];   ?>
                <br><br>
                Para retirar el dinero muestra este código qr en ventanilla en alguna de nuestras sucursales más cercanas.
                <br><br>
                Tambien puedes ir a una de las siguiente tiendas:<br><br>

                <img  class="logos" src="<?php echo constant('URL');?>public/img/Oxxo.png" alt="Logo OXXO">
                <img  class="logos3" src="<?php echo constant('URL');?>public/img/Soriana.png" alt="Logo Soriana">
                <img  class="logos2" src="<?php echo constant('URL');?>public/img/Comercial.png" alt="Logo Comercial Mexicana">
            </p>
            <img src="<?php echo constant('URL');?>public/img/retiro.png">
        </div>
        <div class="content-btn">
            <a href="<?php echo constant('URL') . $_SESSION['ruta'];?>">Volver</a>
            <form action="<?php echo constant('URL'); ?>instrucciones/generatePDF" method="POST" target="print_popup" onsubmit="window.open('about:blank','print_popup','width=auto,height=auto');">
                <button type="submit" class="btn"><i class="fa-solid fa-print"></i></button>
            </form>
        </div>
    </div>
</body>
</html>
