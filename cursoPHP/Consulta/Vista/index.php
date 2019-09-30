<?php
session_start();
//session_destroy();
/*unset($_SESSION['login']);
if(session_status()==PHP_SESSION_ACTIVE){
	echo "Existo";
	
}*/if(isset($_SESSION['login'])){
	echo 'Bienvenido sesion '.$_SESSION['login']; 
}else{
	echo 'Sin sesion';
}
?>


<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="loginSession.php" method="post">
		Usuario: <input type="text"name="userName"><br>
		Contraseña: <input type="text"name="password"><br>
		<input type="submit"name="su"><br>
	</form>
</body>
</html>