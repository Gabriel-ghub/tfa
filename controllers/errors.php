<?php

class Errors extends Controller{
    function __construct(){
        parent::__construct();
        error_log('Errores::construct -> Inicio de Errores');
    }

    function render(){
        error_log('Login::render -> Carga el index de Errores');
        $this->view->render('error/index');

    }
}

?>