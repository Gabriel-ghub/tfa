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

    function authenticate(){
        if($this->existPOST(['username','password'])){
            $username = $this->getPOST('username');    
            $password = $this->getPOST('password');    
        }

        if($username == '' || empty($username) || $password== ''|| empty($password)){
            $this->redirect('login',['error' =>ErrorMessages::ERROR_LOGIN_USUARIO_NOT_EXISTS]);
        }
        $user = $_POST['user'];
        $password = $_POST['password'];
        $this->view->user = $user;
        $this->loadModel("login");
    }
}

?>