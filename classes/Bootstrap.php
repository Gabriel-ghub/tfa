<?php
class Bootstrap {
    private $controller;
    private $action;
    private $request;

    public function __construct($request){
        $this->request = $request;
        if($this->request['controller'] ==""){
            $this->controller = 'home';
        }else{
            $this->controller = $this->request['controller'];
        }
        if($this->request['action']==""){
            $this->action = 'index';
        }else{
            $this->action = $this->request['action'];
        }
    }

    public function createController(){
        //CHECK CLASS
        if (class_exists($this->controller)){
            $parents = class_parents($this->controller);
            //CHECK EXTEND
            if(in_array("Controller",$parents)){
                if(method_exists($this->controller,$this->action)){
                    return new $this->controller($this->action,$this->request);
                }else{
                    //METHOD DOES NOT EXIST
                    echo '<h1> Method does not exist</h1>';
                    return;
                }
            }else{
                //BASE CONTROLLER DOES NOT EXIST
                echo '<h1> Base controler not found</h1>';
                return;
            }
        }else{
            //Controller class does not exist
            echo '<h1> Controller class does not exists</h1>';
            return;
        }
    }
}