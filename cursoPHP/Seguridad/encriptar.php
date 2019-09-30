<?php 

$pass = password_hash('cats45', PASSWORD_DEFAULT, ['cost'=>12]);

$result = password_verify('cats44',$pass);
 
var_dump($result);
?>