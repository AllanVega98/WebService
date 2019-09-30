<?php 
#Variable numerica
$numeroCinco = 5;
echo "Esto es una variable número: $numeroCinco";
echo "<br><br>";
var_dump($numeroCinco);
echo "<br><br>";

#Variable alfanumerica
$palabra = "palabra";
echo "Esto es una variable $palabra";
echo "<br><br>";
var_dump($palabra);
echo "<br><br>";

#Variable booleana
$boleana=false;
echo "Esto es una variable bool: $boleana";
echo "<br><br>";
var_dump($boleana);
echo "<br><br>";

#Variable arreglo
$colores =array ("rojo","amarillo");
echo "Esto es una variable arreglo: $colores[1]";
echo "<br><br>";
var_dump($colores);
echo "<br><br>";

#Variable array con propiedades
$verduras=array("fruta1"=>"pera","fruta2"=>"manzana");
echo "Esto es variable array con propiedades: $verduras[fruta1]";
echo "<br><br>";
var_dump($verduras);
echo "<br><br>";

#Variable con objetos
$frutas=(object)["fruta1"=>"pera","fruta2"=>"manzana"];
echo "Esto es una objeto: $frutas->fruta1";
echo "<br><br>";
var_dump($frutas);
echo "<br><br>";
?>