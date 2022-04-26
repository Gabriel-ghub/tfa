<?php

class Main extends SessionController{

    function __construct()
    {
        parent::__construct();
    }

    function render()
    {

        $this->view->username = $this->getUserSessionData();
        $this->view->render('main/index');
    }

    function logout(){
        $this->logoutSession();
        $this->redirect("login");
    }
}

?>