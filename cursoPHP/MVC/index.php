<?php 
/*$usuario ="sa";
$clave ="123";
$servidor="DESKTOP-QNN29AA\SQLEXPRESS";
$bd ="db_geoCR";

$infoConexion = array("Database"=>"db_geoCR","UID"=>"sa","PWD"=>"123");
$conexion = sqlsrv_connect($servidor,$infoConexion);*/
 	
$hostname = "localhost";
$nombreUsuario = "root";
$contraseña = "";
$nombreConexion = mysqli_connect($hostname , $nombreUsuario , $contraseña);
$nombreBaseDatos= "prueba";
$base = mysqli_select_db($nombreConexion, $nombreBaseDatos);

if($nombreConexion){
	echo "Conexion establecida. <br>";
}else{
	echo "Conexion fallida. <br>";
	die(print_r(mysqli_error(),true));
}

if($base){
	echo "Base establecida. <br>";
}else{
	echo "base fallida. <br>";
	die(print_r(mysqli_error(),true));
}

$query="select * from estudiante;";
$result = mysqli_query($nombreConexion,$query);

if($result){
	echo "Resultado establecida. <br>";
}else{
	echo "Resultado fallida. <br>";
	die(print_r(mysqli_error(),true));
}

$servidor="DESKTOP-QNN29AA\SQLEXPRESS";
$infoConexion = array("Database"=>"db_geoCR","UID"=>"sa","PWD"=>"123","Characterset"=>"UTF-8");
$conexion = sqlsrv_connect($servidor,$infoConexion);

if($conexion){
	echo"exitosas <br>";
}else{
	echo"no papu <br>";
}

while($consulta = mysqli_fetch_array($result)){
	echo $consulta['nombre'];
}

?>