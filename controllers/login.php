<?php

class Login extends SessionController
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $this->view->render('login/index');
    }

    function authenticate()
    {
        if ($this->existPOST(['username', 'password'])) {
            $username = $this->getPOST('username');
            $password = $this->getPOST('password');

            if ($username == '' || empty($username) || $password == '' || empty($password)) {
                $this->redirect('', ["ERROR"]);
                return;
            }
            //ACÁ TENGO AL USUARIO CON TODOS SUS DATOS DE LA BBDD
            $user = $this->model->login($username, $password);

            if($user != NULL){
                // inicializa el proceso de las sesiones    
                $this->initialize($user);
            }else{
                //error al registrar, que intente de nuevo
                //$this->errorAtLogin('Nombre de usuario y/o password incorrecto');
                $this->redirect('');
                return;
            }

        }

    }
}
