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
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/editar.css">
    <title>Editar - <?php echo $user['num_client']; ?></title>
</head>
<body>
    <?php $this -> showMessages();?>
    <main class="main">
        <?php $this -> navController(); ?>
        <section class="content"  id="content-main">
            <form action="<?php echo constant('URL'); ?>editar/update"  method="POST" enctype="multipart/form-data">
                <input type="text"   name="name" id="name"  value="<?php echo $user['name']?>" placeholder="Nombre Completo">
                <input type="text"   name="curp" id="curp"  value="<?php echo $user['curp']?>" placeholder="CURP">           
                <span class="margin">Foto del cliente (Actual)</span>
                <div class="content-img">
                    <img src="<?php echo constant('URL') . 'public/img/' . $user['img_client']; ?>" alt="img_client">
                    <label for="img_client" class="btn-edit-img"> 
                        <span><i class="fa-solid fa-pen-to-square"></i></span>
                    </label> 
                </div>
                <input type="file" name="img_client" id="img_client">
                <label for="fena">Fecha de nacimiento</label>
                <input type="date"   name="fena" id="fena"  value="<?php echo $user['fena'] ?>">
                <input type="text" name="codPostal" value="<?php echo $user['codPostal'] ?>" id="codPostal"  placeholder="Codigo postal" >
                <select name="pais" id="Pais" class="form-select" require>
                    <option value="<?php echo $user['pais']; ?>" selected><?php echo $user['pais']; ?></option>
                </select>
                <select name="estado" id="Estado" class="form-select" require>
                    <option value="<?php echo $user['estado']; ?>" selected><?php echo $user['estado']; ?></option>
                </select>
                <select name="ciudad" id="ciudad" class="form-select" require>
                    <option value="<?php echo $user['ciudad']; ?>" selected><?php echo $user['ciudad']; ?></option>
                </select>
                <input type="text" name="domicilio" id="domicilio" value="<?php echo $user['domicilio']; ?>">
                <input type="password" name="passEjecutivo" id="passEjecutivo" placeholder="Contraseña">
                <a href="<?php echo constant('URL');?>editar/volver" class="btn btn-a">Regresar</a>
                <div class="content-btn-submit">
                    <button type="submit" class="btn-Success">Actualizar</button>
                </div>
            </form>
        </section>
    </main> 
    <script src="<?php echo constant('URL');?>public/js/editar.js"></script>
</body>
</html>