<?php
	class Usuario{
		private $nombre;
		private $username;
		private $clave;
		
		function __construct($pNombre, $pUsername){
			this->nombre = $pNombre;
			this->username = $pUsername;
			//this->clave = $pClave;
		}
		
		public function setNombre($pNombre){
			this->nombre=$pNombre;
		}
		public function getNombre(){
			return this->nombre;
		}
		public function setUserName($pUsername){
			this->username=$pUsername;
		}
		public function getUsername(){
			return this->username;
		}
		/*public function setClave($pClave){
			this->clave=$pClave;
		}
		public function getClave(){
			return this->clave;
		}*/
	}
?>