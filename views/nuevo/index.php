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
    <?php $this -> showMessages();?>
    <main class="main">
        <?php $this -> navController(); ?>
        <section class="content"  id="content-main">
            <form  method="POST" action="<?php constant('URL'); ?>nuevo/newUser" id="msform" enctype="multipart/form-data">
                <ul id="progressbar">
                    <li class="active">Datos personales</li>
                    <li>Domicilio</li>
                    <li>Contacto</li>
                </ul>
                <fieldset>
                    <h4 class="fs-title text-center">Alta de clientes</h2>
                    <h5 class="fs-subtitle text-center">Campos Obligatorios</h5>
                    <input type="text"   name="name" id="name"   placeholder="Nombre Completo">
                    <input type="text"   name="curp" id="curp"   placeholder="CURP">
                    <label for="fena">Fecha De Nacimiento</label>
                    <input type="date"   name="fena" id="fena"   placeholder="Fecha de nacimiento">
                    <label for="img_client">Foto del Cliente</label>
                    <input type="file"   name="img_client" id="img_client"   >
                    <button type="button" name="next" class="next btn-signup">Siguiente</button>
                </fieldset>
                <fieldset>
                    <h4 class="fs-title text-center">Domicilio</h2>
                    <h5 class="fs-subtitle text-center">Campos Obligatorios</h3>
                    <input type="text" name="codPostal" id="codPostal"  placeholder="Codigo postal" >
                    <select name="pais" id="pais" class="form-select" require>
                        
                    </select><br>
                    <select name="estado" id="estado" class="form-select" require>
                        <option value="" selected hidden>Seleccione un estado</option>
                    </select><br>
                    <select name="ciudad" id="ciudad" class="form-select" require>
                        <option value="" selected hidden>Seleccione un ciudad</option>
                    </select><br>
                    <input type="text"    name="domicilio"  id="domicilio" placeholder="Domicilio">
                    <button type="button" name="next"       class="next  btn-signup" >Siguiente</button>
                    <button type="button" name="previous"   class="previous btn-Success btn-signup" >Anterior</button>
                </fieldset>
                <fieldset>
                    <h4 class="fs-title text-center">Contacto</h2>
                    <h5 class="fs-subtitle text-center">Campos Obligatorios</h3>
                    <input type="tel"    name="tel"   id="tel"     placeholder="000-000-0000"  pattern="[0-9]{3}[0-9]{3}[0-9]{4}">
                    <input type="text"   name="email" id="email"   placeholder="Correo electronico">
                    <input type="text"   name="pass"  id="pass"    placeholder="Contraseña">
                    <input type="text"   name="pass2" id="pass2"   placeholder="Confirmar Contraseña">
                    <button type="button" name="previous btn-Success" class="previous btn-signup">Anterior</button>
                    <button type="submit" class="btn-signup">Registrar</button>
                </fieldset>
            </form>
        </section>
    </main>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo constant('URL'); ?>public/js/sign_up.js"></script>
</body>
</html>