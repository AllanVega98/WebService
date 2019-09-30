<?php 
#clase

class Automovil{
	#atributos
	public $marca;
	public $modelo;
	
	#metodos
	public function mostrar(){
		echo "<p>Hola! soy un un $this->marca, modelo: $this->modelo</p>";
	}
}
$a = new Automovil();
$a -> marca ="BMW";
$a -> modelo = "x5";
$a -> mostrar();

$b = new Automovil();
$b -> marca ="toyota";
$b -> modelo = "hilux";
$b -> mostrar();
?>