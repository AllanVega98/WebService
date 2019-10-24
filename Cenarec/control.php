<?php
require_once('metodos.php');
$controlador = new metodos();

//Se verifica la cedula y determinar en qué estado se encuentra
//1: Se puede registrar. 2: Ya este estudiante tiene un usuario. 3: La cédula no está registrada en el sistema 
if(isset($_POST)){
  switch($controlador->validar($_POST["cedula"])){
    case 1:
    echo '<br>
    <form id="registrarForm" action="post" action="registrar">
    <div class="form-group">
      <label for="exampleInputEmail1">Contraseña</label>
      <input required type="password" class="form-control" id="contraseña" aria-describedby="emailHelp" placeholder="Contraseña">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Confirmar contraseña</label>
      <input required type="password" class="form-control" id="confirmarContraseña" placeholder="Confirmar contraseña">
    </div>
    <button type="submit" class="btn btn-primary">Registrar</button>
    <button type="" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancelar</button>
  </form>';
    break;
    case 2:
    echo '<div class="alert alert-danger" role="alert">
      Esta cédula ya está registrada en el sistema
      </div>';
    break;
    case 3:
    echo '<div class="alert alert-danger" role="alert" id="problema">
        No se puede registrar la cédula porque no se encuentra registrada en el sistema
      </div>';
    break;
  }
 }
?>