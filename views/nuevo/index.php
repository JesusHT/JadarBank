<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/nav.css">
    <title>JADAR BANK</title>
</head>
<body>
    <?php require 'views/header.php'; ?>

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
                <input type="text" name="inp_nombreCompleto" id="inp_nombreCompleto" class="form-control" required placeholder="Nombre Completo">
                <input type="number" name="inp_edad" id="inp_edad" class="form-control" required placeholder="Edad">
                <input type="date" name="inp_fechaNacimiento" id="inp_fechaNacimiento" class="form-control" required placeholder="Fecha de nacimiento">
                <input type="text" name="inp_curp" id="inp_curp" class="form-control" required placeholder="CURP">
                <label for="">Foto del Cliente</label>
                <input type="file" name="featured" id="featured" class="form-control" required accept="image/*" class="form-control" >
                <input type="button" name="next" class="next action-button" value="Next">
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Domicilio</h2>
                <h3 class="fs-subtitle">Campos Obligatorios!</h3>
                <input type="text" name="inp_domicilio" id="inp_domicilio" class="form-control" required placeholder="Domicilio">
                <input type="text" name="inp_codigoPostal" id="inp_codigoPostal" class="form-control" required placeholder="Codigo postal">
                <input type="text" name="inp_municipio" id="inp_municipio" class="form-control" required placeholder="Municipio">
                <input type="text" name="inp_pais" id="inp_pais" class="form-control" required placeholder="Pais">
                <input type="button" name="previous" class="previous action-button" value="Previous">
                <input type="button" name="next" class="next action-button" value="Next">
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Contacto</h2>
                <h3 class="fs-subtitle">Campos Obligatorios!</h3>
                <input type="number" name="inp_numeroTelefonico" id="inp_numeroTelefonico" class="form-control" required placeholder="Numero de Telefono">
                <input type="text" name="inp_email" id="inp_email" class="form-control" required placeholder="Correo electronico">
                <input type="text" name="inp_contraseña" id="inp_contraseña" class="form-control" required placeholder="Contraseña">
                <input type="text" name="inp_contraseña2" id="inp_contraseña2" class="form-control" required placeholder="Confirmar Contraseña">
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