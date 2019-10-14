<?php
class metodos{
    public $url;
    public $error;
    function __construct(){
        $this->url="http://localhost:8080/WebService1.asmx?WSDL";
    }
    function login($varCed, $varClave){
        try{
            $client = new SoapClient($this->url);  
            $verificar = $client->login(['cedula'=>$varCed,'clave'=>$varClave]);

            if($verificar->loginResult){
                $nombre = $client->nombre(['cedula'=>$varCed]);//llenar la tabla, verificar en la pàgina para llenar la tabla
                echo $nombre->nombreResult;
            }else{//Hay que poner la redireccion al login con el error
                $this->error="El usuario o la contraseña no son correctos";
            }

        }catch(Exception $e){
    	    $e->getMessage();
        }
    }
    
    function registrar($varCorreo,$varClave,$varCed){
        try{
            $client = new SoapClient($this->url);  
            $verificar = $client->registrar(['correo'=>$varCorreo,'clave'=>$varClave,'cedula'=>$varCed]);

            if($verificar->registrarResult){//redireccionar a pagina donde pueda ir a ver la tabla "aprete aquì para ir a la tabla"
                //
            }else{//Hay que poner la redireccion al login con el error
                $this->error="Problemas al registrar";
            }

        }catch(Exception $e){
    	    $e->getMessage();
        }
    }

    function llenarTabla($varCed){
        try{
            $client = new SoapClient($this->url);  
            $verificar = $client->llenarTabla(['cedula'=>$varCed]);
            return $verificar->llenarTablaResult;
            
        }catch(Exception $e){
            $e->getMessage();
        }
    }
}
?>