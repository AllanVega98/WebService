<?php
session_start();
if(isset($_SESSION['login'])){?>
echo 'Bienvenido sesion'.$_SESSION['login'];
<?php }else{?>

<!DOCTYPE html>
<html>

<head>
	<title>Title of the document</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<div class="container-fluid">
	<div class="row">
		<div class="col"></div>
		<form method="POST" action="Tabla.php" class="col-4 formulario">
			<div class="form-group col-12">
				<label for="exampleInputEmail1">Cédula</label>
				<input class="form-control" name="cedula" placeholder="Cédula">
			</div>
			<div class="form-group col-12">
				<label for="exampleInputPassword1">Contraseña</label>
				<input type="password" class="form-control" name="clave" placeholder="Contraseña">
			</div>
			<div class="form-check col-12">
				<button type="submit" class="btn btn-primary col-12">Ingresar</button>
			</div>
		</form>
		<div class="col"></div>
	</div>
</div>

</html>
<?php } ?>
