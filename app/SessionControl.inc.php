<?php

class SessionControl{

    public static function log_in($user_id, $user_name){
        if(session_id() == ""){
            session_start();
        }

        $_SESSION["user_id"] = $user_id;
        $_SESSION["user_name"] = $user_name;        
    }

    public static function close_session(){
        if(session_id() == ""){
            session_start();
        }

        if(isset($_SESSION["user_id"])){
            unset($_SESSION["user_id"]);
        }

        if(isset($_SESSION["user_name"])){
            unset($_SESSION["user_name"]);
        }
        
        session_destroy();
    }

    public static function session_init(){
        if(session_id() == ""){
            session_start();
        }
        
        return (isset($_SESSION["user_id"]) && $_SESSION["user_name"]);
    }
}