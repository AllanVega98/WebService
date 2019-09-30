<?php
try{
$url="http://localhost:8123/consultapp/WebService1.asmx?WSDL";
$client = new SoapClient($url);
print_r($client->__getTypes());
echo "<br><br><br>";
$respuesta = $client->Suma(['a'=>10,'b'=>9]);
echo $respuesta->SumaResult;
echo "<br><br><br>";
try{
	$respuesta2 = $client->buscar(['estudiante'=>2]);
		foreach ($respuesta2->buscarResult->Curso as $aux)
		{
			echo $aux->nombre."<br>";
			echo $aux->calificacion."<br>";
			echo $aux->idCurso."<br>";
		}
	}catch(Exception $e){
		$e->getMessage();
	}
	}catch(Exception $e){
	$e->getMessage();
	}
?>