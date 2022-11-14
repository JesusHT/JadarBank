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
    <?php $this -> showMessages();?>
    <main class="main">
        <?php $this -> navController(); ?>
        <section class="content" id="content-main">
            <h1>Cartera De Clientes</h1>
            <form action="<?php echo constant('URL'); ?>admin/tableUsers" method="POST">
                <input type="text" name="busqueda" id="busqueda" placeholder="Buscar..." class="search">
                <button type="submit" class="btn bg-secondary text-white btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                <a href="<?php echo constant('URL'); ?>admin" class="btn-refresh bg-secondary"><i class="fa-solid fa-rotate"></i></a>
            </form>

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
        </section>
    </main>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Baja del cliente <span id="num_client"></span></h2>
            </div>
            <div class="modal-body">
                <p><span>Esta acción es irreversible.</span> ¿Estás seguro que quieres dar debaja a este cliente?</p>
                <form action="<?php constant('URL');?>admin/delete" method="POST">
                    <input type="hidden" name="eliminar" id="eliminar" value="">
                    <input type="password" id="passEjecutivo" name="passEjecutivo" placeholder="Ingrese contraseña" required>               
                    <div class="content-buttons">
                        <button type="button" onclick="closedModal()" class="btn bg-error btn-cancel">Cancelar</button>
                        <button type="submit" class="btn bg-success btn-confirm">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo constant('URL'); ?>public/js/admin.js"></script>
</body>
</html>