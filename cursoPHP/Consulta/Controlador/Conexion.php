<?php
class Conexion{
    private $host= 'localhost';
    private $db= 'tutoseguridad';
    private $user= 'root';
    private $password= '';
    private $charset;
	
    public function __construct(){
        $this->host     = 'localhost';
        $this->db       = 'tutoseguridad';
        $this->user     = 'root';
        $this->password = '';
    }
    function connect(){
    
        try{
			$conn = mysqli_connect('localhost','root','');
			$db= "prueba";
			$base = mysqli_select_db($conn, $db);
			if($conn->connect_errno){
				return false;
			}else{
				return $conn;
			}
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }   
    }
	function busca($pUserName,$pClave){
	$sql = "select nombre, username from usuario where username = ? and clave = ?";
	$conn = $this->connect();
	if($resultado = mysqli_prepare($conn,$sql)){
		
		$ok=mysqli_stmt_bind_param($resultado,"ss",$pUserName,$pClave);
		$ok= mysqli_stmt_execute($resultado);
		mysqli_stmt_bind_result($resultado, $nombre, $username);
		if($ok==false){
			echo "hay problemas";
		}else{
			while(mysqli_stmt_fetch($resultado)){
				return true;
			}
		}
	}
	/*function busca($pNombre){
	$sql = "select nombre, username, clave from usuario where nombre = ?";
	$conn = $this->connect();
	if($resultado = mysqli_prepare($conn,$sql)){
		
		$ok=mysqli_stmt_bind_param($resultado,"s",$pNombre);
		$ok= mysqli_stmt_execute($resultado);
		mysqli_stmt_bind_result($resultado, $nombre, $username, $clave);
		if($ok==false){
			echo "hay problemas";
		}else{
			while(mysqli_stmt_fetch($resultado)){
				echo $nombre." es: ".$username." clave: ".$clave;
			}
		}
	}*/
}
}
?>
