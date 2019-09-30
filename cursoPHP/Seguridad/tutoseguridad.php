<?php 
	if(isset($_POST['_token'])){
		$conn = new mysqli('localhost','root','','tutoseguridad');
		$query = "insert into comentarios (email,comentario) values(?,?)";
		$statement = $conn->prepare($query);
		//Con esto no inyectan código
		$statement->bind_param("ss",htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8'),htmlspecialchars($_POST['comentario'],ENT_QUOTES,'UTF-8'));//Las "ss" son 2 string
		$statement->execute();
	}
?>


<html>

<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>

<body>
	<h2>Comentarios</h2>
	<form method="post">
		<input type="text" name="email"><br>
		<textarea name="comentario" cols="30" rows="5"></textarea><br>
		<input type="hidden" name="_token" value="1">
		<input type="submit">
	</form>
	<br><br>
	<?php 
		$conn = new mysqli('localhost','root','','tutoseguridad');
		$query = "select * from comentarios";
		$statement = $conn->prepare($query);
		$statement->execute();
		$result=$statement->get_result();
		foreach($result as $row){
			echo "<p>".$row['comentario']."</p>";
		}
	?>
</body>

</html>
