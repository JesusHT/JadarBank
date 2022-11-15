<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/cliente.css">
    <title>JADAR BANK</title>
</head>
<body>
    <?php $this -> showMessages();?>
    <main class="main">
        <?php $this -> navController(); ?>
        <section class="content" id="content-main">
            <!-- <div class="massage bg-warning"><p class="">Tiene un prestamo que esta por vencerse</p></div> -->
            <div class="header">
                <div class="content-customer-data">
                    <img src="<?php echo constant('URL') . 'public/img/' . $cliente['img_client']; ?>" alt="Imagen del cliente">
                    <h1>Bienvenido <?php echo $cliente['name']; ?></h1>
                </div>
            </div>
            <div class="body">
                <p>Saldo actual: mxn</p>
            </div>
        </section>
    </main>  
</body>
</html>