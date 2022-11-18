<?php  
    $account = $this -> d['account'];
?>
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
                <p class="mb-1"><span>Número de cuenta:</span> <?php echo $cliente['num_client']; ?></p>
                <p class="mb-1"><span>Clabe interbancaria: </span><?php echo $account['num_cuenta']; ?> </p>
                <p class="mb-1"><span>Saldo actual:</span> $<?php echo $account['saldo']; ?> mxn</p>
                <p class="mb-1"><span>Crédito disponible:</span> $<?php echo $account['credito'] - $account['usado']; ?> mxn</p>
                <div class="content-buttons">
                    <form action="<?php echo constant('URL');?>main/retiros" method="POST">
                        <button class="btn" >
                            <span><i class="fa-regular fa-money-bill"></i></span>
                            Retiros          
                        </button>
                    </form>
                    <form action="<?php echo constant('URL');?>main/tranferencias" method="post">
                        <button class="btn" onclick="openModal(deposito)">
                            <span><i class="fa-light fa-money-bill-transfer"></i></span>
                            Tranferencias        
                        </button>
                    </form>
                    <button class="btn">
                        <span><i class="fa-regular fa-memo-circle-check"></i></span>
                        Estado de cuenta 
                    </button>
                    <button class="btn" onclick="openModal(prestamos)">
                        <span><i class="fa-regular fa-hand-holding-dollar"></i></span>
                        Prestamo personal
                    </button>
                </div>
            </div>
        </section>
    </main> 
</body>
</html>