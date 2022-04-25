<?php

class LoginModel extends Model{
    function __construct(){
        parent::__construct();
    }

    function authenticate(){
        $query = "SELECT * FROM USUARIOS WHERE USER = :user";
    }
}