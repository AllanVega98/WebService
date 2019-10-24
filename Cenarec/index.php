<?php
 session_start();

if (isset($_SESSION['usuario'])) {
  header('Location: /Cenarec/consulta.php?varCed='.$_SESSION['usuario']);
}

require_once('metodos.php');
$error = "";

if(!empty($_POST['estudiante']) && !empty($_POST['clave'])){
  $controlador = new metodos();
  $varCed = $_POST['estudiante'];
  $varClave = $_POST['clave'];
  $_SESSION['last_time'] = time();
  if( $controlador->login($varCed,$varClave)!=null){
    echo $controlador->login($varCed,$varClave);
    $_SESSION['usuario'] = $controlador->login($varCed,$varClave);
    header('Location: /Cenarec/consulta.php?varCed='.$varCed);
  }
  else  
  {
    $error = "La cédula o la contraseña no son válidas";
  } 
}

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
    <script src="js/script.js"></script>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">CENAREC</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <label>Ingrese sus datos </label>
      </li>
    </ul>
    <form action="index.php" method="post" class="form-inline my-2 my-lg-0">
      <label for="">Ingrese cedula: </label>
      <input required class="form-control mr-sm-2"  placeholder="Cédula" aria-label="Search" name="estudiante">
      
      <label for="">Ingrese contraseña:  </label>
      <input required class="form-control mr-sm-2" type="password" placeholder="Contraseña" aria-label="Search" name="clave">
      
      <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Ingresar</button>
      <a for=""href="" data-toggle="modal" data-target="#exampleModal">¿No está registrado?</a>
    </form>
    <div >
        <?php echo "".$error;?>
    </div>
  </div>
</nav>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div action="" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="">Verificar cédula</label>
        <input class="form-control" maxlength="9" type="text" placeholder="Cédula"id="cedula">
        <div id="registrar"></div>
      </div>
      </div>
    </div>
    </div>
  </div>
</div>
<script>
var input= document.getElementById("cedula");
var expresionRegular = /^[0-9]{9}/;

input.addEventListener("keyup", function(event) {
  var aux = input.value;
  if(aux.length==9){
    if(expresionRegular.test(aux)){
      event.preventDefault();
      loadLog();
    }else{
      document.getElementById("registrar").innerHTML = '<div class="alert alert-danger" role="alert" id="problema"> No se puede registrar la cédula porque no se encuentra registrada en el sistema </div>';
    }
  }else{
    document.getElementById("registrar").innerHTML = "";
  }
});
</script>
</body>
</html>