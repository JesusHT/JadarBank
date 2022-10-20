<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/global.css">
        <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/default.css">
        <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/nav.css">
        <title>Registro</title>
    </head>
    <body>
    <div id="menu">
        
    </div>
    <div class="">
        <form  method="POST" action="nuevo/newUser" id="msform" enctype="multipart/form-data">
            <ul id="progressbar">
                <li class="active">Datos personales</li>
                <li>Domicilio</li>
                <li>Contacto</li>
            </ul>
            <fieldset>
                <?php $this -> showMessages(); ?><br>
                <h2 class="fs-title">Registro De Clientes</h2>
                <h3 class="fs-subtitle">Campos Obligatorios!</h3>
                <input type="text"   name="name" id="name" class="form-control"  placeholder="Nombre Completo">
                <input type="date"   name="fena" id="fena" class="form-control"  placeholder="Fecha de nacimiento">
                <input type="text"   name="curp" id="curp" class="form-control"  placeholder="CURP">
                <label for="">Foto del Cliente</label>
                <input type="file"   name="img_client" id="img_client" class="form-control" class="form-control" >
                <input type="button" name="next" class="next action-button" value="Next">
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Domicilio</h2>
                <h3 class="fs-subtitle">Campos Obligatorios!</h3>
                <input type="text" name="pais" id="pais" class="form-control"  placeholder="Pais">
                <input type="text" name="codPostal" id="codPostal" class="form-control" placeholder="Codigo postal">
                <select name="estado" id="estado" class="form-select" require>
                    
                </select><br>
                <select name="municipio" id="municipio" class="form-select" require>
                    <option value="" selected hidden>Seleccione un municipio</option>
                </select><br>
                <input type="text"   name="domicilio" class="form-control" id="domicilio" placeholder="Domicilio">
                <input type="button" name="previous"  class="previous action-button" value="Previous">
                <input type="button" name="next"      class="next action-button"     value="Next">
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Contacto</h2>
                <h3 class="fs-subtitle">Campos Obligatorios!</h3>
                <input type="number" name="tel"   id="tel"   class="form-control"  placeholder="Numero de Telefono">
                <input type="text"   name="email" id="email" class="form-control"  placeholder="Correo electronico">
                <input type="text"   name="pass"  id="pass"  class="form-control"  placeholder="Contraseña">
                <input type="text"   name="pass2" id="pass2" class="form-control"  placeholder="Confirmar Contraseña">
                <input type="button" name="previous" class="previous action-button" value="Previous">
                <input type="submit" value="enviar">
            </fieldset>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo constant('URL'); ?>public/js/nav.js"></script>
    <script type="text/javascript" src="<?php echo constant('URL'); ?>public/js/sign_up.js"></script>
    <script type="text/javascript" src="<?php echo constant('URL'); ?>public/js/menu.js"></script>
</body>
</html>