<?php

class ErrorMessages{

    //ERROR_CONTROLLER_METHOD_ACTION
    const ERROR_ADMIN_NEWCATEGORY_EXISTS ="1";
    const ERROR_LOGIN_USUARIO_NOT_EXISTS ="2";

    private $errorList = [];
    public function __construc(){
        $this->errorList = [
        ErrorMessages::ERROR_ADMIN_NEWCATEGORY_EXISTS =>'El nombre de la categoría no existe',
        ErrorMessages::ERROR_LOGIN_USUARIO_NOT_EXISTS =>'Error en usuario o contraseña'
        ];
    }

    public function get($hash){
        return $this->errorList[$hash];
    }

    public function existsKey($key){
        if(array_key_exists($key, $this->errorList)){
            return true;
        }
    }

}


?>