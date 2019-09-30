<?php 
	function API($ruta){
		$url = "C:\Users\vegai\OneDrive\Documentos\WebService";
		$respuesta = $url . $ruta;
		return $respuesta;
	}

$direccion = API("1");
$json = file_get_contents($direccion);
print_r($json);
?>