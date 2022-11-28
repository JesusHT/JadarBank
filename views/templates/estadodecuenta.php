<?php $user = $this -> d['data']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL')?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/estadodecuenta.css">
    <title>Estado De Cuenta - <?php echo $user['num_client']; ?></title>
</head>
<body>
    <div class="content">
        <header>
            <img src="<?php echo constant('URL') ?>public/img/logo.png" alt="Logo JadarBank">
        </header>
        <section>
            <p><?php echo $user['name'];                                          ?></p>
            <p><?php echo $user['domicilio'];                                     ?></p>
            <p><?php echo $user['estado']; ?> C.P. <?php echo $user['codPostal']; ?></p>
            <p>Número de cliente:   <?php echo $user['num_client'];               ?></p>
            <p>Clave interbancaria: <?php echo $user['num_cuenta'];               ?></p>
            <p>Sucursal: 001                                                        </p>
            <table>
                <thead>
                    <tr>
                        <td colspan="3" rowspan="3"><h3>Resumen</h3> En Pesos Moneda Nacional</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Saldo actual:</td>
                        <td>$<?php echo $user['saldo']; ?></td>
                    </tr>
                    <tr> 
                        <td>Transferencias: </td>
                        <td>$<?php echo $user['transferencias']; ?></td>
                    </tr>
                    <tr>
                        <td>Retiros en efectivo: </td>
                        <td>$<?php echo $user['retiros']; ?></td>
                    </tr>
                </tbody>
            </table>
            <table>   
                <thead>
                    <tr>
                        <td colspan="6" rowspan="6"><h3>Detalles de operación</h3> En Pesos Moneda Nacional</td>
                    </tr>
                </thead>
                <thead class="head">
                    <tr>
                        <td>Fecha        </td>
                        <td>Concepto     </td>
                        <td>Retiros      </td>
                        <td>Transferencia</td>
                        <td>Otro         </td>
                        <td>Saldo        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $user['movimientos']; ?>
                </tbody>
            </table>

            <div class="content-btn">
                <a href="<?php echo constant('URL') . $this ->d['url'];?>/cerrar" class="btn-back">Volver</a>
                <form action="<?php echo constant('URL'); ?>estadodecuenta/generarPDF" method="POST" target="print_popup" onsubmit="window.open('about:blank','print_popup','width=auto,height=auto'">
                    <button type="submit" class="btn"><i class="fa-solid fa-print"></i></button>
                </form>
            </div>
        </section>
    </div>
</body>
</html>