<?php

$automovil1 = (object)["marca"=>"toyota","modelo"=>"corolla"];
$automovil2 = (object)["marca"=>"bmw","modelo"=>"X5"];

function mostrar($automovil){ 
	echo "<p>Hola! soy un un $automovil->marca, modelo: $automovil->modelo</p>";
}
mostrar($automovil2);
?>