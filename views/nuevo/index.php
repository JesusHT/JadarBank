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
            <form  method="POST" action="<?php echo constant('URL'); ?>nuevo/newUser" id="msform" enctype="multipart/form-data">
            <ul id="progressbar">
                    <li class="active">Datos personales</li>
                    <li id="2" >Domicilio</li>
                    <li id="3" >Contacto</li>
                </ul>
                <div class="form-content">
                    <!-- Titulo -->    

                    <h4 class="fs-title text-center">Alta de clientes</h2>
                    <h5 class="fs-subtitle text-center">Campos Obligatorios</h5>

                    <!-- Form contacto -->
                    <fieldset id="datos">
                        <input  type="text" name="name" id="name" placeholder="Nombre Completo">
                        <input  type="text" name="curp" id="curp" placeholder="CURP">
                        <label  for="fena">Fecha De Nacimiento</label>
                        <input  type="date"   name="fena" id="fena"   placeholder="Fecha de nacimiento">
                        <label  for="img_client">Foto del Cliente <span tabindex="0" data-descr="Debe ser una foto de su rostro en formato jpg."><i class="fa-sharp fa-solid fa-circle-info"></i></span></label>
                        <input  type="file"   name="img_client" id="img_client">
                    </fieldset>

                    <!-- Form domicilio -->
                    <fieldset id="domicilio">
                        <input type="text" name="codPostal" id="codPostal"  placeholder="Codigo postal">
                        <select name="pais" id="pais" class="form-select mb-1" require>

                        </select>
                        <select name="estado" id="estado" class="form-select mb-1" require>
                            <option value="" selected hidden>Seleccione un estado</option>
                        </select>
                        <select name="ciudad" id="ciudad" class="form-select mb-1" require>
                            <option value="" selected hidden>Seleccione un ciudad</option>
                        </select>
                        <input type="text"    name="domicilio"  id="domicilio" placeholder="Domicilio">
                    </fieldset>

                    <!-- Form contacto -->
                    <fieldset id="contacto">
                        <input type="tel"      name="tel"   id="tel"   placeholder="Número de telefonico"  pattern="[0-9]{3}[0-9]{3}[0-9]{4}">
                        <input type="text"     name="email" id="email" placeholder="Correo electronico">
                    </fieldset>
                    
                    <!-- Botones de siguiente y anterior -->
                    <div class="align-left">
                        <button type="button" id="previous" class="btn-previous"><i class="fa-solid fa-circle-left"></i></button>
                    </div>
                    <div class="align-right">
                        <button type="button" id="next"     class="btn-next"><i class="fa-solid fa-circle-right"></i></button>
                        <button type="submit" id="submit" class="btn bg-lightblue btn-submit">Enviar</button>
                    </div>
                </div>
            </form>
        </section>
    </main>  
    <script type="text/javascript" src="<?php echo constant('URL'); ?>public/js/sign_up.js"></script>
</body>
</html>