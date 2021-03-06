<?php


class Controller{

    function __construct(){
        // Este es el controlador base
        $this->view = new View();
    }

    function loadModel($model){
        $url = 'models/'.$model.'model.php';

        if (file_exists($url)){
            require_once $url;

            $modelName = $model.'Model';
            $this->model = new $modelName();
        }
    }

    function existPOST($params){
        foreach ($params as $param) {
            if(!isset($_POST[$param])){
                return false;
            }
        }
        return true;
    }

    function existGET($params){
        foreach ($params as $param) {
            if(!isset($_GET[$param])){
                return false;
            }
        }
        return true;
    }

    function getGET($name){
        return $_GET[$name];
    }

    function getPOST($name){
        return $_POST[$name];
    }

    function redirect($url, $mensajes = []){
        $data = [];
        $params = '';
        
        foreach ($mensajes as $key => $value) {
            array_push($data, $key . '=' . $value);
        }

        $params = join('&', $data);
        
        if($params != ''){
            $params = '?' . $params;
        }

        header('location: ' . constant('URL') . $url . $params);
    }
}


?>