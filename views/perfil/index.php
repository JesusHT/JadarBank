<?php  
    $user = $this -> d['client'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/global.css">
    <title>Perfil</title>
    <style>
        .area span {
            color:blue; 
        }

        img {
            width: 300px;
            height: auto;
        }
    </style>
</head>
<body>
    <?php require 'views/nav.php'; ?>
    <div class="area">
        <?php 
            echo '<span> Id: '                  . '</span>' . $user['id']         . '<br>';
            echo '<span> Nombre: '              . '</span>' . $user['name']       . '<br>';
            echo '<span> Fecha De Nacimiento: ' . '</span>' . $user['fena']       . '<br>';
            echo '<span> CURP: '                . '</span>' . $user['curp']       . '<br>';
            echo '<span> Imagen: '              . '</span><br><img src="'. constant('URL') . 'public/img/' . $user['img_client'] . '"></img><br>';
            echo '<span> Domicilio: '           . '</span>' . $user['domicilio']  . '<br>';
            echo '<span> CodPostal: '           . '</span>' . $user['codPostal']  . '<br>';
            echo '<span> Estado: '              . '</span>' . $user['estado']     . '<br>';
            echo '<span> Municipio: '           . '</span>' . $user['municipio']  . '<br>';
            echo '<span> Pais: '                . '</span>' . $user['pais']       . '<br>';
            echo '<span> Teléfono: '            . '</span>' . $user['tel']        . '<br>';
            echo '<span> Correo: '              . '</span>' . $user['email']      . '<br>';
            echo '<span> Número De Cliente: '   . '</span>' . $user['num_client'] . '<br>';
            echo '<span> Rol: '                 . '</span>' . $user['role']       . '<br>';
            echo '<span> Estatus: '             . '</span>' . $user['status']     . '<br>';        
        ?>
    </div>
</body>
</html>