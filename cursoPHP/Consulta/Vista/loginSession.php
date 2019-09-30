<?php 
include_once ('../Controlador/Conexion.php');
$conexion = new Conexion();
session_start();// con esto puedo decir en cuales paginas se va estar iniciada y manipularla
if($conexion->busca($_POST['userName'],$_POST['password'])&&$_SESSION['login']='administrador'){
	echo 'sesion creada';
}else{
	echo 'Usuario o contraseña incorrecta';
}
?>
