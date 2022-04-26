<?php 

class SessionController extends Controller{

    function __construct()
    {
        parent::__construct();
        $this -> init();
    }

    function init(){
        $this -> session = new Session;

        $this -> validateSession();
    }

    function validateSession(){
        // SI EXISTE LA SESSION
        if ($this -> existsSession()){
            $user = $this -> getUserSessionData();
            return $user;
        }
        // SI NO EXISTE
        else{
            // EL USUARIO SIN SESSION ESTA INTENTANDO ENTRAR A LOGIN
            if($this -> current_page() == 'login'){
                // No hacemos nada
            }
            else{
                // SI NO es login, lo mandamos a loguearse
                $this -> redirect ('login');
            }
        }
    }

    // Funcion para comprobar si existe la SESSION O no
    function existsSession(){
        if(!$this->session->exists()) return false;
        if($this->session->getCurrentUser() == NULL) return false;

        $userid = $this->session->getCurrentUser();

        if($userid) return true;

        return false;
    }

    // Funcion para obtener la pagina actual
    function current_page(){
        $actual_link = trim("$_SERVER[REQUEST_URI]");
        $url = explode('/', $actual_link);
        return $url[2];
    }

    // Funcion que devuelve un objeto de la clase UserModel
    function getUserSessionData(){
        $id = $this->session->getCurrentUser();
        $this->user = new UserModel();
        $this->user->get($id);
        return $this->user;
    }

    public function logoutSession()
    {
        $this->session->closeSession();
    }
    
    public function initialize($user)
    {
        $username = $user->getUsername();
        $this->session->setCurrentUser($username);
        $this->redirect("main");
    }
}

?>
