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
    <title>Editar - <?php echo $user['num_client']; ?></title>
</head>
<body>
    <?php require 'views/nav.php'; ?>
    <div class="area">
        <input type="text"   name="name" id="name"  value="<?php echo $user['name']?>" placeholder="Nombre Completo">
        <input type="text"   name="curp" id="curp"  value="<?php echo $user['curp']?>" placeholder="CURP">
        <label for="fena">Fecha De Nacimiento</label>
        <input type="date"   name="fena" id="fena"  value="<?php echo $user['fena'] ?>"  placeholder="Fecha de nacimiento">
        <label for="img_client">Foto del Cliente</label>
    </div>
</body>
</html>