<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
        <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/sign_up.css">
        <title>Registro</title>
    </head>
    <body>
    <?php require 'views/nav.php'; ?>
    <div class="area">
        <form  method="POST" action="nuevo/newUser" id="msform" enctype="multipart/form-data">
            <ul id="progressbar">
                <li class="active">Datos personales</li>
                <li>Domicilio</li>
                <li>Contacto</li>
            </ul>
            <fieldset>
                <?php $this -> showMessages(); ?><br>
                <h4 class="fs-title text-center">Alta de clientes</h2>
                <h5 class="fs-subtitle text-center">Campos Obligatorios</h5>
                <input type="text"   name="name" id="name" class="form-control"  placeholder="Nombre Completo">
                <input type="text"   name="curp" id="curp" class="form-control"  placeholder="CURP">
                <label for="fena">Fecha De Nacimiento</label>
                <input type="date"   name="fena" id="fena" class="form-control"  placeholder="Fecha de nacimiento">
                <label for="img_client">Foto del Cliente</label>
                <input type="file"   name="img_client" id="img_client" class="form-control" class="form-control" >
                <button type="button" name="next" class="next btn-signup">Siguiente</button>
            </fieldset>
            <fieldset>
                <h4 class="fs-title text-center">Domicilio</h2>
                <h5 class="fs-subtitle text-center">Campos Obligatorios</h3>
                <input type="text" name="pais" id="pais" class="form-control"  placeholder="Pais">
                <input type="text" name="codPostal" id="codPostal" class="form-control" placeholder="Codigo postal" >
                <select name="estado" id="estado" class="form-select" require>
                    
                </select><br>
                <select name="municipio" id="municipio" class="form-select" require>
                    <option value="" selected hidden>Seleccione un municipio</option>
                </select><br>
                <input type="text"   name="domicilio" class="form-control" id="domicilio" placeholder="Domicilio">
                <button type="button" name="previous" class="previous btn-Success btn-signup" >Anterior</button>
                <button type="button" name="next"     class="next  btn-signup" >Siguiente</button>
            </fieldset>
            <fieldset>
                <h4 class="fs-title text-center">Contacto</h2>
                <h5 class="fs-subtitle text-center">Campos Obligatorios</h3>
                <input type="tel"    name="tel"   id="tel"   class="form-control"  placeholder="000-000-0000"  pattern="[0-9]{3}[0-9]{3}[0-9]{4}">
                <input type="text"   name="email" id="email" class="form-control"  placeholder="Correo electronico">
                <input type="text"   name="pass"  id="pass"  class="form-control"  placeholder="Contraseña">
                <input type="text"   name="pass2" id="pass2" class="form-control"  placeholder="Confirmar Contraseña">
                <button type="button" name="previous btn-Success" class="previous btn-signup">Anterior</button>
                <button type="submit" class="btn-signup">Registrar</button>
            </fieldset>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo constant('URL'); ?>public/js/sign_up.js"></script>
</body>
</html>