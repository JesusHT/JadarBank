<?php 
	require_once "conexion.php";
	require_once "metodosCrud.php";

 ?>

<!DOCTYPE html>
<html>
<head>
<link href="diseño.css" rel="stylesheet" type="text/css">

	<title>crud</title>
</head>
<body>

<form action="procesos/insertar.php" method="post">
<div id="fondo">
	<div id="datospersona">
            <label for="">Nombre Completo:</label>
            <input type="text" name="inp_nombreCompleto" id="inp_nombreCompleto" class="form-control" required>
			<p></p>
            <label for="">Edad:</label>
            <input type="number" name="inp_edad" id="inp_edad" class="form-control" required>
            <p></p>
			<label for="">Fecha de nacimiento</label>
            <input type="date" name="inp_fechaNacimiento" id="inp_fechaNacimiento" class="form-control" required>
            <p></p>
			<label for="">CURP</label>
            <input type="text" name="inp_curp" id="inp_curp" class="form-control" required>
            <p></p>
			<label for="">Foto del Cliente</label>
            <input type="file" name="featured" id="featured" class="form-control" required accept="image/*" class="form-control">
            <p></p>
		</div>

		<div id="domicilio">
			
			<label for="">Domicilio</label>
            <input type="text" name="inp_domicilio" id="inp_domicilio" class="form-control" required>
            <p></p>
			<label for="">Codigo Postal</label>
            <input type="text" name="inp_codigoPostal" id="inp_codigoPostal" class="form-control" required>
            <p></p>
			<label for="">Municipio</label>
            <input type="text" name="inp_municipio" id="inp_municipio" class="form-control" required>
            <p></p>
			<label for="">Pais:</label>
            <input type="text" name="inp_pais" id="inp_pais" class="form-control" required>
            <p></p>
		</div>

		<div id ="contacto">
		<label for="">Numero Telefonico</label>
            <input type="number" name="inp_numeroTelefonico" id="inp_numeroTelefonico" class="form-control" required>
            <p></p>

			<label for="">Correo electronico</label>
            <input type="text" name="inp_email" id="inp_email" class="form-control" required>
            <p></p>
			
			<label for="">Contraseña</label>
            <input type="text" name="inp_contraseña" id="inp_contraseña" class="form-control" required>
            <p></p>
			<label for="">Confirmar contraseña:</label>
            <input type="text" name="inp_contraseña2" id="inp_contraseña2" class="form-control" required>
            <p></p>

		</div>
			<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" />
            <label for="">Aceptar Terminos y Condiciones</label>
            <br>
</div>
	
	<button>Agregar</button>
</form>

<br><br>

</body>
</html>