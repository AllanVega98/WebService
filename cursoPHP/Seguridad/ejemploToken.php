<?php
	session_start();
	require_once('app/clases/nocsrf.php');
?>
<html>
<head> 
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="controllers/modificar.php"method="post">
		<input type="submit" class="Modificar">
		<input type="hidden" name="_token" value"<?php echo NoCSRF::generate('_token');?>" class="type">
	</form>
</body>
</html>