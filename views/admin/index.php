<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo constant('URL'); ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet"    href="<?php echo constant('URL'); ?>public/css/admin.css">
    <title>JADAR BANK</title>
</head>
<body>
    <?php require 'views/nav.php'; ?>
    <div class="area">
        <br><h1>Cartera De Clientes</h1><br>
        <form action="<?php echo constant('URL'); ?>admin/tableUsers" method="POST">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar..." class="bg-dark text-white">
            <input type="submit" value="Buscar">
        </form><br>
	    <table class="table table-dark mt-3">
            <thead>
                <tr>
                    <td>#</td>
                    <td class="celdas">Nombre</td>
                    <td class="celdas">numero_cliente</td>
                    <td class="celdas">Eliminar</td>
                    <td class="celdas">Editar</td>
                    <td class="celdas">ver</td>
                </tr>
            </thead>
            <tbody>
                <?php echo $this -> d['tabla'];?>
            </tbody>
	    </table>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header bg-Warning">
                <h2>Dar debaja a un cliente</h2>
            </div>
            <div class="modal-body">
                <div id="respustaCrear">

                </div>
                <p>Esta acción es irreversible. ¿Estás seguro que quieres dar debaja a este cliente?</p><br>
                <form id="FormDelete" method="POST">
                    <input type="hidden" name="eliminar" id="eliminar" value="">
                    <label for="passEjecutivo">Ingrese su contraseña</label><br>
                    <input type="text" id="passEjecutivo" name="passEjecutivo" required> <br>
                    <br>
                    <div style="text-align: right;">
                        <button type="button" onclick="crearPost()" class="btn">Eliminar</button>
                        <button type="button" onclick="closedModal()" class="btn">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo constant('URL'); ?>public/js/admin.js"></script>
    <script>
        function crearPost(){
            
            let datos = new FormData(document.getElementById("FormDelete"));

            fetch('admin/delete', {
                 method: "post",
                 body: datos
            }).then((response) => {
                 return response.json();
            }).then((data) => {
                document.getElementById("respustaCrear").innerHTML = data
            }).catch(err => console.error(err));
        }
    </script>
</body>
</html>