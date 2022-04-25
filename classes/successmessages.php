<?php

class SuccessMessages{

    //ERROR_CONTROLLER_METHOD_ACTION
    const PRUEBA ="1234";

    private $successList = [];
    public function __construct(){
        $this->successList = [
        SuccessMessages::PRUEBA =>'Este es un mensaje de exito'
        ];
    }

    public function get($hash){
        return $this->successList[$hash];
    }

    public function existsKey($key){
        if(array_key_exists($key, $this->successList)){
            return true;
        }
    }

}


?>