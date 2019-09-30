<?php
	include_once 'Conexion.php';
	include_once 'Usuario.php';

class ControladorLogin{
	//Variables
	private $usuario = new Usuario();
	private $conexion = new Conexion();
	//metodos
	public function verificarUsuario($pUsername, $pClave){
		return $conexion->verificar($pUsername, $pClave);
	}
}

?>