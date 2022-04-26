<?php

class UserModel extends Model implements IModel{


    private $id;
    private $username;
    private $password;
    private $name;
    private $lastName;

    public function __construct(){
        parent::__construct();
        $this->username = "";
        $this->password = "";
        $this->name = "";
        $this->lastName="";
    }

    public function save(){
        try{
            $query = $this->prepare('INSERT INTO users(username,password,name,lastname) VALUES(:username,:password,:name,:lastname)');
            $query->execute(['username'=>$this->username,
                            'password'=>$this->password,
                            'name'=>$this->name,
                            'lastname'=>$this->lastname]);
            return true;
        }catch(PDOException $e){
            error_log('USERMODEL::save->PDOException '.$e);
            return false;
        }
    }

    public function getAll(){
        $items=[];
        try{
            $query = $this->query('SELECT * FROM users');

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new UserModel();
                $item->setId($p['id']);
                $item->setUsername($p['username']);
                $item->setPassword($p['password']);
                $item->setName($p['name']);
                $item->setLastName($p['lastname']);
                array_push($items,$item);
            }
            return $items;
        }catch(PDOException $e){
            error_log('USERMODEL::getAll->PDOException '.$e);
        }
    }


    public function get($id){

        try{
            $query = $this->prepare('SELECT * FROM users WHERE ID = :id');
            $query->execute([
                            'id' => $id
                            ]);

            $user = $query->fetch(PDO::FETCH_ASSOC);

                $this->setId($user['id']);
                $this->setUsername($user['username']);
                $this->setPassword($user['password']);
                $this->setName($user['name']);
                $this->setLastName($user['lastname']);
                
                return $this;
            
        }catch(PDOException $e){
            error_log('USERMODEL::getID->PDOException '.$e);
        }
    }

    public function delete($id){
        try{
            $query = $this->prepare('DELETE * FROM users WHERE ID = :id');
            $query->execute([
                            'id' => $id
                            ]);
            return true;
        }catch(PDOException $e){
            error_log('USERMODEL::deleteID->PDOException '.$e);
            return false;
        }
    }

    public function update(){
        try{
            $query = $this->prepare('UPDATE USERS SET username = :username,password = :password,name = :name,lastname = :lastname WHERE ID = :id');
            $query->execute(['username'=>$this->username,
            'password'=>$this->password,
            'name'=>$this->name,
            'lastname'=>$this->lastname,
            'id'=>$this ->id
                            ]);
            return true;
            
        }catch(PDOException $e){
            error_log('USERMODEL::updateID->PDOException '.$e);
            return false;
        }
    }


    public function from($array){
        $this->id           = $array['id'];
        $this->username     = $array['username'];
        $this->password     = $array['password'];
        $this->name         = $array['name'];
        $this->lastName     = $array['lastname'];
    }

    //Método que retorna true o false si existe un usuario con el mismo nombre de usuario
    public function exists($username){
        try{
            $query = $this->prepare('SELECT username FROM users where username = :username');
            $query->execute([
                'username' =>$username
            ]);
            if($query->rowCount()>0){
                return true;
            }else{
                return false;
            }

        }catch(PDOException $e){
            error_log('USERMODEL::metodoExists->PDOException '.$e);
            return false;
        }
    }

    //Método que verifica que las contraseñas sean iguales
    public function comparePasswords($password,$id){
        try{
            $user = $this->getId($id);

            return password_verify($password,$user->getPassword());

        }catch(PDOException $e){
            error_log('USERMODEL::metodoComparePasswords->PDOException '.$e);
            return false;
        }
    }


    //función que hashea la clave para no guardarla como texto plano
    //El costo es el número de veces que se HASHEA la contraseña
    private function getHashedPassword($password){
        return password_hash($password,PASSWORD_DEFAULT,['cost'=>2]);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this ->id;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setPassword($password){
        $this->password = $this->getHashedPassword($password);
    }

    public function getPassword(){
        return $this->password;
    }

    public function setName($name){
        $this->name =  $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setLastName($lastname){
        $this->lastName = $lastname;
    }

    public function getlastName(){
        return $this->lastName;
    }

}


?>