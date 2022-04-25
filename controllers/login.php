<?php

class Login extends Controller{
    function __construct(){
        error_log('Login::construct -> Inicio de Login');
        parent::__construct();
    }

    function render(){
        error_log('Login::render -> Carga el index de Login');
        $this->view->render('login/index');
    }

    function login(){
        $user = $_POST['user'];
        $password = $_POST['password'];
        $this->view->user = $user;
        $this->loadModel("main");
    }
}

?>