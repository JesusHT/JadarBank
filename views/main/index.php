<?php $account = $this -> d['account']; $messages = $this -> d['aviso'];?>
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
            <div class="massage">
                <?php 
                    foreach ($messages as $message) {
                        echo $message;
                    }
                ?>
            </div>
            <header>
                <div class="img">
                    <img src="<?php echo constant('URL') . 'public/img/' . $cliente['img_client']; ?>" alt="Imagen del cliente">
                </div>
                <div class="title">
                    <h1>¡Bienvenido, <?php echo $cliente['name']; ?>!</h1>
                </div>
            </header>
            <div class="body">
                <p class="mb-1 mt-1 info"><span>Número de cuenta:</span> <?php echo $cliente['num_client']; ?></p>
                <p class="mb-1 info"><span>Clabe interbancaria: </span><?php echo $account['num_cuenta']; ?> </p>
                <p class="mb-1 info"><span>Saldo actual:</span> $<?php echo $account['saldo']; ?> mxn</p>
                <p class="mb-1 info"><span>Crédito disponible:</span> $<?php echo $account['credito'] - $account['usado']; ?> mxn</p>
                <div class="content-buttons">
                    <a href="<?php echo constant('URL');?>main/movimientos?v=retiros">
                        <span><i class="fa-solid fa-money-simple-from-bracket"></i></i></span>
                         Retiros  
                    </a>
                    <a href="<?php echo constant('URL');?>main/movimientos?v=tranferencias">
                        <span><i class="fa-solid fa-money-bill-transfer"></i></span>
                        Tranferencias        
                    </a>
                    <a href="<?php echo constant('URL');?>main/generarEstadoDeCuenta">
                        <span><i class="fa-solid fa-memo-circle-check"></i></span>
                        Estado de cuenta 
                    </a>
                    <a href="<?php echo constant('URL');?>main/movimientos?v=prestamos">
                        <span><i class="fa-solid fa-hand-holding-dollar"></i></span>
                        Prestamo personal
                    </a>
                </div>

                <h4>Últimos movimientos realizados</h4>
                <div class="movimientos">
                    <?php echo $this -> d['movimientos']; ?>
                </div>
            </div>
        </section>
    </main> 
</body>
</html>