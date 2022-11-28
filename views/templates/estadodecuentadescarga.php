<?php $user = $this -> d['data']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL')?>public/img/favicon.ico" type="image/x-icon">
    <title>Estado De Cuenta</title>
    <style>
        table {
            margin-top: 15px;
            margin-bottom: 15px;
            border-width: 1px;
            border-spacing: 0px;
            border-style: none;
            border-collapse: separate;
            background-color: #fff; }
        table tr, table td {
          border-width: 1px;
          padding: 5px;
          border-style: solid;
          border-color: black;
          background-color: #fff; }
        table thead tr > td {
          text-align: center;
          padding: 10px; }
        table tr, table td {
          border-width: 1px;
          padding: 5px;
          border-style: solid;
          border-color: black;
          background-color: #fff; }
        table thead tr td {
            background-color: #0d4755;
            color: #fff; }

        .content {
  width: 100%;
  height: 100%;
  display: grid;
  padding: 0;
  grid-template-columns: repeat(5, 1fr);
  grid-area: repeat(4, 1fr);
  grid-template-areas: "header header header header header" "body body body body body" "body body body body body" "footer footer footer footer footer"; }
  .content header {
    grid-area: header;
    display: flex;
    justify-content: center; }
    .content header img {
      width: 120px;
      height: auto; }
  .content section {
    grid-area: body;
    display: grid;
    justify-content: center; }
    .content section table {
      border-style: none; }
    .content section .head tr td {
      background-color: #3e8692; }
    
    </style>
</head>
<body>
    <div class="content">
        <header>
           <center> <img src="<?php echo $this -> d['logo'];?>" alt="Logo JadarBank"></center>
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
                        <td colspan="2" ><h3>Resumen</h3> En Pesos Moneda Nacional</td>
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
                <thead class="head" style="background-color: #0d4755;">
                    <tr>
                        <td style="background-color: #0d4755;" colspan="6"><h3>Detalles de operación</h3> En Pesos Moneda Nacional</td>
                    </tr>
                    <tr style="background-color: #3e8692;">
                        <td style="background-color: #3e8692;">Fecha        </td>
                        <td style="background-color: #3e8692;">Concepto     </td>
                        <td style="background-color: #3e8692;">Retiros      </td>
                        <td style="background-color: #3e8692;">Transferencia</td>
                        <td style="background-color: #3e8692;">Otro         </td>
                        <td style="background-color: #3e8692;">Saldo        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $user['movimientos']; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>