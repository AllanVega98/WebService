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
	<table class="table table-dark">
		<thead>
			<tr>
				<th scope="col">Nombre</th>
				<th scope="col">Calificación</th>
				<th scope="col">Curso</th>
			</tr>
		</thead>
		<tbody>
			<?php			
try{
$varCed = $_POST['cedula'];
$varClave = $_POST['clave'];
$url="http://localhost:8123/consultapp/WebService1.asmx?WSDL";
$client = new SoapClient($url);
$respuestValidar = $client->validar(['ced'=>$varCed,'clave'=>$varClave]);
	
	if($respuestValidar->validarResult==true){
		echo "Linda prrosqui";
	}else{
		echo "nelson Mandela";
	}
	
	try{
		$respuesta2 = $client->llenar(['ced'=>$varCed]);
		foreach ($respuesta2->llenarResult->Curso as $aux)
		{
?>
			<thead>
				<tr>
					<td id="Nombre"><?php echo $aux->nombreCurso?></td>
					<td id="Calificacion"><?php //echo $aux->calificacion?></td>
					<td id="Curso"><?php //echo $aux->nombreEstudiante?></td>
				</tr>
			</thead>
			<?php 
		}
	
	}catch(Exception $e){
		$e->getMessage();
	}
}catch(Exception $e){
	$e->getMessage();
}
?>
		</tbody>
	</table>

</div>

</html>
