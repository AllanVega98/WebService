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
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Ingrese sus datos <span class="sr-only">(current)</span></a>
      </li>

    </ul>
    <form action="consulta.php" method="post" class="form-inline my-2 my-lg-0">
      <label for="">Ingrese cedula: </label>
      <input required class="form-control mr-sm-2"  placeholder="Cédula" aria-label="Search" id="estudiante">
      
      <label for="">Ingrese contraseña:  </label>
      <input required class="form-control mr-sm-2" type="password" placeholder="Contraseña" aria-label="Search" id="clave">
      
      <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Ingresar</button>
      <a for=""href="" data-toggle="modal" data-target="#exampleModal">¿No está registrado?</a>
    </form>
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
        <div id="alerta" class="alert alert-warning" role="alert" hide>
        Solamente puede utilizar números <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
        </div>
        <input class="form-control" maxlength="9" type="text" placeholder="Cédula"id="cedula">
        <div id="registrar"></div>
      </div>
      </div>
    </div>
    </div>
  </div>
</div>
<script>
//Inicio función que valida que la cédula se encuentre en el SICAP
function loadLog() {
var cedula= document.getElementById('cedula').value;
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
if (xhttp.readyState == 4 && xhttp.status == 200) {
document.getElementById("registrar").innerHTML = xhttp.responseText;
}
};
xhttp.open("POST", "control.php", true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("cedula="+cedula+"");
}//Fin de la función

var input= document.getElementById("cedula");
var alerta = document.getElementById("alerta");
var expresionRegular = /^[0-9]{9}/;
alerta.style.display="none";

input.addEventListener("keyup", function(event) {
  var aux = input.value;
  alerta.style.display="none";  
  if(aux.length==9){
    if(expresionRegular.test(aux)){
      event.preventDefault();
      loadLog();
    }else{
      alerta.style.display="block";
    }
  }else{
    loadLog();
  }
});
</script>

</body>
</html>