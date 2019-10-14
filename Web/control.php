<?php
if(isset($_POST)){
    if($_POST["cedula"]=="604470638"){
        echo '<br><form id="registrarForm">
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
    }
 }
?>