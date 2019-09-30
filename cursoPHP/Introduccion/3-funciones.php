<?php
#funcion sin parametro
function saludo(){
	echo "hola<br>";
}

saludo();

#funcion con parametro
function despedida($adios){	
	echo $adios."<br>";
}

despedida("chao");

#funcion con retorno
function retorno($retornar){
	return $retornar;
}

echo retorno("Prueba");
?>