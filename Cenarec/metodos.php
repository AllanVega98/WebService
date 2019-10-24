<?php
class metodos{
    public $url;
    public $error;
    
    function __construct(){
        $this->url="http://localhost:8080/WebService1.asmx?WSDL";
    }
 

    /**
     * Verificar si el usuario está registrado
     *
     * @param  string $varCed
     * @param  string $varClave
     *
     * @return int
     */
    function login($varCed,$varClave){
        try{
            $client = new SoapClient($this->url);  
            $verificar = $client->login(['cedula'=>$varCed,'clave'=>$varClave]);

            if($verificar->loginResult){
                $nombre = $client->nombre(['cedula'=>$varCed]);//llenar la tabla, verificar en la pàgina para llenar la tabla
                return $nombre->nombreResult;
            }else{//Hay que poner la redireccion al login con el error
                return null;
            }

        }catch(Exception $e){
    	    $e->getMessage();
        }
    }
    
    /**
     * Busca nombre del estudiante
     *
     * @param  mixed $varCed
     *
     * @return void
     */
    function nombre($varCed){
        try{
            $client = new SoapClient($this->url);  
            $verificar = $client->nombre(['cedula'=>$varCed]);

            if($verificar->nombreResult != null){
                return $verificar->nombreResult;
            }else{
                return null;
            }

        }catch(Exception $e){
    	    $e->getMessage();
        }
    }

    /**
     * Validar que la cédula esté registradas
     *
     * @param  mixed $varCed
     *
     * @return void
     */
    function validar($varCed){
        try{
            $client = new SoapClient($this->url);  
            $verificar = $client->validar(['cedula'=>$varCed]);
            
            return $verificar->validarResult;

        }catch(Exception $e){
    	    $e->getMessage();
        }
    }

    /**
     * Registrar el usuario
     *
     * @param  mixed $varCorreo
     * @param  mixed $varClave
     * @param  mixed $varCed
     *
     * @return void
     */
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

    /**
     * Metodo que devuelve los cursos registrados al estudiante
     *
     * @param  mixed $varCed
     *
     * @return void
     */
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