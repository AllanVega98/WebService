<?php

$servidor="DESKTOP-QNN29AA\SQLEXPRESS";
$infoConexion = array("Database"=>"db_geoCR","UID"=>"sa","PWD"=>"123","Characterset"=>"UTF-8");
$conexion = sqlsrv_connect($servidor,$infoConexion);

if($conexion){
	echo"exitosas";
}else{
	echo"no papu";
}
?>