<?php 
$hostname = "localhost";
$nombreUsuario = "root";
$contraseña = "";
$nombreConexion = mysqli_connect($hostname , $nombreUsuario , $contraseña);
$nombreBaseDatos= "prueba";
$base = mysqli_select_db($nombreConexion, $nombreBaseDatos);
$query = "select * from estudiante;";

$resultado = mysqli_query($nombreConexion, $query);
if($nombreConexion){
	echo "en todas perro";
}else{
	echo"nel pastel";	
}
?>