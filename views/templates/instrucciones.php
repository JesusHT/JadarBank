<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrucciones de retiro</title>
    <style>
      .content {
        display: flex;
        width: 320px;
        padding: 0 10px;
        background-color: #fff;
        border-style: solid;
        border-width: 1px;
        border-color: #000;
        left: 50%;
        position: absolute;
        border-radius: 10px;
        transform: translate(-50%, 0); }

        h1 {text-align: center;}
          
        .content .content-img img {
          width: 250px;
          height: auto; 
          margin-bottom: 20px;}
          
          .content .content-img p .logos {
            width: 60px;
            height: auto; }
          .content .content-img p .logos2 {
            width: 120px;
            height: auto; }
          .content .content-img p .logos3 {
            width: 100px;
            height: auto; }
          
    </style>
</head>
<body>
    <div class="content">
        <h1>Retiro</h1>
        <div class="content-img">
            <p> Número de cliente: <?php echo $this -> d['num_client']; ?> <br>
                Cantidad:         $<?php echo $this -> d['cantidad'];   ?>
                <br><br>
                Para retirar el dinero muestra este código QR en ventanilla en alguna de nuestras sucursales más cercanas.
                <br><br>
                Tambien puedes ir a una de las siguiente tiendas:
                <br><br>
                <img  class="logos"  src="<?php echo $this -> d['logo1'];?>" alt="Logo OXXO">
                <img  class="logos3" src="<?php echo $this -> d['logo2'];?>" alt="Logo Soriana">
                <img  class="logos2" src="<?php echo $this -> d['logo3'];?>" alt="Logo Comercial Mexicana">
            </p>
            <center><img src="<?php echo $this -> d['qr'];?>"></center>
        </div>
    </div>
</body>
</html>