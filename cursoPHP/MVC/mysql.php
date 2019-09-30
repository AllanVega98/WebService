<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
</head>
<body>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
<?php 
$hostname = "localhost";
$nombreUsuario = "root";
$contraseña = "";
$nombreConexion = mysqli_connect($hostname , $nombreUsuario , $contraseña);
$nombreBaseDatos= "prueba";
$base = mysqli_select_db($nombreConexion, $nombreBaseDatos);

$varId = $_POST['id'];//igual a name del input de fomrulario
$resultado = mysqli_query($nombreConexion, "select * from estudiante where id=$varId");

while($estudiante = mysqli_fetch_array($resultado))
	{
?> 
     <tr>
      <th scope="row"></th>
      <td id="num"><?php echo $estudiante['id'] ?></td>
      <td id="nombre"><?php echo $estudiante['nombre'] ?></td>
      <td id="apellido"><?php echo $estudiante['apellido'] ?></td>
    </tr>
<?php 
	}
?>
   </tbody>
</table>
</body>
</html>
