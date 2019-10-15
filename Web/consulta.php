<?php
session_start();
$time = $_SERVER['REQUEST_TIME'];

if (!isset($_SESSION['usuario'])) {
    header('Location: /Cenarec/index.php');
}
else if((time() - $_SESSION['last_time'])> 1800){
    session_destroy();
    header('Location: /Cenarec/index.php');
} 
else{
    $_SESSION['last_time']=time();
}
require_once('metodos.php');
$controlador = new metodos();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">CENAREC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        Bienvenido
        </div>
        </nav>
    <div class="container">
        <div class="container-fluid">
	    <table class="table table-dark">
		    <thead>
			    <tr>
				    <th scope="col">Nombre</th>
				    <th scope="col">Curso</th>
                    <th scope="col">Calificación</th>
                    <th scope="col">Retirado</th>
                    <th scope="col">Fecha de emisión</th>
			    </tr>
		    </thead>
		<tbody>
        <?php			
try{
    $_SESSION['usuario']=$_GET['varCed'];
    foreach ($controlador->llenarTabla($_GET['varCed'])->Grupo_Participante as $aux)
	{
?>
            <thead>
                <tr>
					<td id="NombreCurso"><?php echo $aux->nombreCurso?></td>
					<td id="CodigoCurso"><?php echo $aux->codigoGrupo?></td>
					<td id="Calificacion"><?php echo $aux->calificacion?></td>
                    <td id="Retirado"><?php echo $aux->retirado?></td>
					<td id="FechaRetirado"><?php echo $aux->fechaRetirado?></td>
                </tr>
			</thead>
<?php 
    }

}catch(Exception $e){
	$e->getMessage();
}
?>
		</tbody>
	</table>

</div>

</div>
</body>
</html>