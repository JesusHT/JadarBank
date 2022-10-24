<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/admin.css">
    <title>JADAR BANK</title>
    <style>
        #paginas ul{
            margin: 10px 0;
            padding: 0;
        }
        #paginas li{
            display: inline-block;
            margin: 0;
            padding: 10px;
        }
        
        #paginas li a{
            background: rgb(228, 228, 228);
            border:solid black 1px;
            border-radius: 3px;
            color: rgb(50, 50, 50);
            padding: 10px 15px;
            text-decoration: none;
        }
        
        .actual{
            background: rgb(20, 69, 124) !important;
            color: rgb(255, 255, 255) !important;
        }
    </style>

</head>
<body>
    <?php require 'views/nav.php'; ?>
    <div class="area">
        <?php $this -> showMessages(); ?>
        <br><h1>Cartera De Clientes</h1><br>
        <form action="<?php echo constant('URL'); ?>admin/tableUsers" method="POST">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar..." class="">
            <input type="submit" value="Buscar"  class="btn">
        </form><br>
        
	    <table class="table table-dark mt-3">
            <thead>
                <tr>
                    <td>#</td>
                    <td class="">Nombre</td>
                    <td class="text-center">Número cliente</td>
                    <td class="text-center">Eliminar</td>
                    <td class="text-center">Editar</td>
                    <td class="text-center">Ver</td>
                </tr>
            </thead>
            <tbody>
                <?php echo $this -> d['tabla'];?>
            </tbody>
	    </table>
        <div id="paginas">
            <?php echo $this -> d['page'];?>
        </div>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header bg-Warning">
                <h2>Dar debaja a un cliente</h2>
            </div>
            <div class="modal-body">
                <p>Esta acción es irreversible. ¿Estás seguro que quieres dar debaja a este cliente?</p><br>
                <form action="<?php constant('URL');?>admin/delete" method="POST">
                    <input type="hidden" name="eliminar" id="eliminar" value="">
                    <label for="passEjecutivo">Ingrese su contraseña</label><br>
                    <input type="text" id="passEjecutivo" name="passEjecutivo" required> <br>
                    <br>
                    <div>
                        <button type="submit" class="btn">Confirmar</button>
                        <button type="button" onclick="closedModal()" class="btn">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo constant('URL'); ?>public/js/admin.js"></script>
</body>
</html>