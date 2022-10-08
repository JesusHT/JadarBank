<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/nav.css">
    <title>Registro</title>
</head>
<body>
    <?php require 'views/nav.php'; ?>

    <div class="">
        <!-- multistep form -->
        <form id="msform">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active">Datos personales</li>
                <li>Domicilio</li>
                <li>Contacto</li>
            </ul>
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">Registro De Clientes</h2>
                <h3 class="fs-subtitle">Campos Obligatorios!</h3>
                <input type="text"   name="name" id="name" class="form-control" required placeholder="Nombre Completo">
                <input type="number" name="edad" id="edad" class="form-control" required placeholder="Edad">
                <input type="date"   name="fena" id="fena" class="form-control" required placeholder="Fecha de nacimiento">
                <input type="text"   name="curp" id="curp" class="form-control" required placeholder="CURP">
                <label for="">Foto del Cliente</label>
                <input type="file"   name="img_client" id="img_client" class="form-control" required accept="image/*" class="form-control" >
                <input type="button" name="next" class="next action-button" value="Next">
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Domicilio</h2>
                <h3 class="fs-subtitle">Campos Obligatorios!</h3>
                <input type="text" name="domicilio" id="domicilio" class="form-control" required placeholder="Domicilio">
                <input type="text" name="codPostal" id="codPostal" class="form-control" required placeholder="Codigo postal">
                <input type="text" name="municipio" id="municipio" class="form-control" required placeholder="Municipio">
                <input type="text" name="pais" id="pais" class="form-control" required placeholder="Pais">
                <input type="button" name="previous" class="previous action-button" value="Previous">
                <input type="button" name="next" class="next action-button" value="Next">
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Contacto</h2>
                <h3 class="fs-subtitle">Campos Obligatorios!</h3>
                <input type="number" name="tel" id="tel" class="form-control" required placeholder="Numero de Telefono">
                <input type="text"   name="email" id="email" class="form-control" required placeholder="Correo electronico">
                <input type="text"   name="pass" id="pass" class="form-control" required placeholder="Contraseña">
                <input type="text"   name="pass2" id="pass2" class="form-control" required placeholder="Confirmar Contraseña">
                <input type="button" name="previous" class="previous action-button" value="Previous">
                <input type="submit" name="submit" class="submit action-button" value="Submit">
            </fieldset>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo constant('URL'); ?>public/js/nav.js"></script>
</body>
</html>