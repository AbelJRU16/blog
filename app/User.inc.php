<?php

final class User {
    
    private $id;
    private $name;
    private $email;
    private $password;
    private $register_date;
    private $active;
    
    public function __construct($id, $name, $email, $password, $register_date, $active) {  
        $this -> id = $id;
        $this -> name = $name;
        $this -> email = $email;
        $this -> password = $password;
        $this -> register_date = $register_date;
        $this -> active = $active;
    }

    public function get_id() {
        return $this -> id;
    }

    public function get_name() {
        return $this -> name;
    }
    
    public function get_email() {
        return $this -> email;
    }

    public function get_password() {
        return $this -> password;
    }

    public function get_register_date() {
        return $this -> register_date;
    }

    public function get_active() {
        return $this -> active;
    }

    public function set_id($id) {
        $this -> id = $id;
    }

    public function set_name($name) {
        $this -> name = $name;
    }

    public function set_email($email) {
        $this -> email = $email;
    }

    public function set_password($password) {
        $this -> password = $password;
    }

    public function set_register_date($register_date) {
        $this -> register_date = $register_date;
    }

    public function set_active($active) {
        $this -> active = $active;
    }

}
