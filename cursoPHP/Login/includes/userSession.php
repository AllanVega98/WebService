<?php 
class userSession{
	public function _construct(){
	session_start();
	}
	public function setCurrentUser($user){
		$_SESSION['user']=$user;//aqui guardo el nombre de usuario que se conecta para hacer la conexion
	}
	public function getCurrentUser(){
		return $_SESSION['user'];
	}
	public function closeSession(){
		session_unset();
		session_destroy();
	}
}
?>