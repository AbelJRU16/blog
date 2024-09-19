<?php

include_once "../app/repositories/UserRepository.inc.php";

class loginValidator{
    
    private $user;
    private $error;

    public function __construct($connection, $username, $password){
        $this->error="";

        if(!$this->is_set($username) || !$this->is_set($password)){
            $this->user = null;
            $this->error = "Debes introducir tu email y tu clave";
        }else{
            $this->user = UserRepository::get_user_by_field($connection, "name", $username);
        
            if(is_null($this->user) || !password_verify($password, $this->user->get_password())){
                $this->error = "Datos incorrectos";
            }
        }
    }

    private function is_set($var){ return (isset($var) && !empty($var)); }

    public function get_user(){
        return $this->user;
    }

    public function get_error(){ 
        return $this->error; 
    }
}