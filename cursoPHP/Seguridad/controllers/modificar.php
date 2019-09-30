<?php
	$conn = new mysqli('localhost','root','','tutoseguridad');
	$query = "update comentarios set comentario = 'hola' where id=1";
	$statement = $conn->prepare($query);
	$statement->execute();	
?>
