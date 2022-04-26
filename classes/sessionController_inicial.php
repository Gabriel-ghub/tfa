<?php

/**
 * Controlador que también maneja las sesiones
 */
class SessionController extends Controller
{

    private $userSession;
    private $username;


    private $session;


    private $user;

    function __construct()
    {
        parent::__construct();

        $this->init();
    }

    public function getUserSession()
    {
        return $this->userSession;
    }

    public function getUsername()
    {
        return $this->username;
    }



    private function init()
    {
        //se crea nueva sesión
        $this->session = new Session();
        $user = $this->session->getCurrentUser();
        
        if (isset($user) && $user != "") {
            return true;
        } else {
            $this->validateSession();
        }
    }


    function validateSession()
    {
        //Si existe la sesión
        if ($this->existsSession()) {
            $username = $this->getUserSessionData()->getUsername();
            if (isset($username) && $username != "") {
                $this->redirect("main");
            }
        } else {
            //No existe ninguna sesión
            if ($this->getCurrentPage() == "login") {
            } else {
                header('location: ' . constant('URL') . 'login');
            }
        }
    }
    /**
     * Valida si existe sesión, 
     * si es verdadero regresa el usuario actual
     */
    function existsSession()
    {
        if (!$this->session->exists()) return false;
        if ($this->session->getCurrentUser() == NULL) return false;

        $username = $this->session->getCurrentUser();

        if ($username) return true;

        return false;
    }

    function getUserSessionData()
    {
        $username = $this->session->getCurrentUser();
        $this->user = new UserModel();
        $this->user->get($username);
        return $this->user;
    }

    //ACA YA TENGO INICIADA LA SESSION CON EL USUARIO
    public function initialize($user)
    {
        $username = $user->getUsername();
        $this->session->setCurrentUser($username);
        $this->redirect("main");
    }


    public function logoutSession()
    {
        $this->session->closeSession();
    }

    private function getCurrentPage()
    {

        $actual_link = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actual_link);
        return $url[2];
    }
}
