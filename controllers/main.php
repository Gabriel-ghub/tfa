<?php

class Main extends SessionController{

    function __construct()
    {
        parent::__construct();
        $this->view->mensajeError = "";
    }

    function render()
    {
        $this->view->username = $this->getUserSessionData();
        if($this->existGET(["mensaje"])){
            $this->view->mensajeError = $this->getGet("mensaje");
        };
        $this->view->gastos = $this->model->cargaGastos();
        $this->view->render('main/index');
    }

    function logout(){
        $this->logoutSession();
        $this->redirect("login");
    }

    function delete(){
        if($this->existGET(['id'])){
            $param = $this->getGET('id');
            if($param != ""){
                if($this->model->deleteById($param)){
                    $this->redirect("main");
                }else{
                    $this->redirect("",["mensaje" =>"No se pudo borrar"]);
                }
            }else{
                $error = new Errors();
                $error->render();
                return;
            }
        }
        else{
            $error =new Errors();
            $error->render();
            return;
        }

    }

    function transaction(){
        $this->view->render('main/transactionIn');
    }

    
}

?>