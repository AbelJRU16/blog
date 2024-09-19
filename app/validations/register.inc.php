<?php

include_once "../app/repositories/UserRepository.inc.php";

class registerValidator{
    
    private $username;
    private $email;

    private $error_username;
    private $error_email;
    private $error_password;
    private $error_confirm;

    public function __construct($username, $email, $password, $password_confirm){
        $this->username = "";
        $this->email = "";  

        $this->error_username = $this->validate_username($username);
        $this->error_email = $this->validate_email($email);
        $this->error_password = $this->validate_password($password);
        $this->error_confirm = $this->validate_confirm($password, $password_confirm);
    }

    private function is_set($var){ return (isset($var) && !empty($var)); }

    private function validate_username($var){ 
        if(!$this->is_set($var)){ return "Debes ingresar un nombre de usuario."; }
        else { $this->username = $var; }

        if(strlen($var) < 6 && strlen($var) >= 24){ 
            return "El nombre debe tener entre 6 y 24 caracteres."; 
        }

        Connection::open_connection();
        if(UserRepository::does_it_exist(Connection::get_connection(), "name", $var)){
            return "El nombre ya se encuentra en uso";
        }
        Connection::close_connection();

        
        return "";
    }

    private function validate_email($var){
        if(!$this->is_set($var)){ return "Debes ingresar un email."; }
        else { $this->email = $var; }

        Connection::open_connection();
        if(UserRepository::does_it_exist(Connection::get_connection(), "email", $var)){
            return "El email ya se encuentra en uso";
        }
        Connection::close_connection();
        
        return "";
    }

    private function validate_password($var){
        if(!$this->is_set($var)){ return "Debes escribir tu contrasena"; }
        return "";
    }

    private function validate_confirm($var, $conf){
        if(!$this->is_set($conf)){ return "Debes repetir tu contrasena"; }
        if($var !== $conf){ return "Ambas contrasena deben coincidir"; }
        return "";
    }

    public function get_errors(){

        $errors = [
            $this->error_username,
            $this->error_email,
            $this->error_password,
            $this->error_confirm
        ];
        return $errors;
    }

    public function is_valid(){
        if($this->error_username === "" && $this->error_email === "" &&
                $this->error_password === "" && $this->error_confirm === ""){
            return true;
        }else{
            return false;
        }
    }
}