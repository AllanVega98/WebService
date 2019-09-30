<?php // logica
include_once 'includes/user.php';
include_once 'includes/userSession.php';

//instancias
$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
	echo "hay sesion";
}else if(isset($_POST['username'])&& isset($_POST['password'])){
	//echo "Validacion de login";
	$userForm = $_POST['username'];
	$passForm = $_POST['password'];
	
	if($user->userExists($userForm, $passForm)){//metodo que está en user donde validamos el usuario
		echo "usuario validado";
	}else{
		echo "nombre usuario incorrecto";
	}	
}else{
	//echo "Login";
	include_once 'vistas/login.php';
}
?>