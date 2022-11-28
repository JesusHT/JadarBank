<?php $user = $this -> d['client']; $messages = $this -> d['aviso'];?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/ver.css">
    <title>Ver - <?php echo $user['num_client']; ?></title>
</head>
<body>
    <?php $this -> showMessages();?>
    <main class="main">
        <?php $this -> navController(); ?>
        <section class="content"  id="content-main">
            <div class="message">
                <?php 
                    foreach ($messages as $message) {
                        echo $message;
                    }
                ?>
            </div>
            <div class="img">
                <img src="<?php echo constant('URL');?>public/img/<?php echo $user['img_client']; ?>" alt="">
            </div>
            <div class="info">
                <p><span>Nombre:             </span> <?php echo $user['name']      ;?></p>
                <p><span>Número de cliente:  </span> <?php echo $user['num_client'];?></p>
                <p><span>Clabe interbancaria:</span> <?php echo $user['num_cuenta'];?></p>
                <div class="content-btn-estadodecuenta">
                    <form action="<?php echo constant('URL') ?>ver/generarEstadoDeCuenta" method="POST">
                        <input type="hidden" name="num_client" value="<?php echo $user['num_client'];?>">
                        <button type="submit" class="btn mt-2">
                            <span><i class="fa-solid fa-memo-circle-check"></i></span>
                            Generar estado de cuenta
                        </button>
                    </form>
                </div>
            </div>
            <div class="prestamos">
                <div class="acciones">
                    <form action="<?php echo constant('URL'); ?>ver/generarprestamo" method="post">
                        <input type="hidden" name="prestamo" value="<?php echo $user['num_client']; ?>">
                        <button type="submit">
                            <span><i class="fa-solid fa-hand-holding-dollar"></i></span>
                            Solicitar prestamo 
                        </button>
                    </form>
                    <a href="<?php echo constant('URL');?>ver/movimientos?v=retiros" class="buttons">
                        <span><i class="fa-solid fa-money-simple-from-bracket"></i></i></span>
                         Retiros  
                    </a>
                    <a href="<?php echo constant('URL');?>ver/movimientos?v=depositos">
                        <span><i class="fa-solid fa-money-bill-transfer"></i></span>
                        Depositos        
                    </a>
                </div>
                <h4>Prestamos activos del cliente: </h4>
                <div class="content-table">
                    <?php echo $this -> d['tabla'];?>
                    <div id="paginas">
                        <?php echo $this -> d['page'];?>
                    </div>
                </div>
            </div>
            <a href="<?php echo constant('URL');?>editar/volver" class="btn btn-back mt-2">Regresar</a>
        </section>
    </main>   
</body>
</html>