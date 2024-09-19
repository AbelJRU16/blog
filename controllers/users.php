<?php

include_once "../app/Connection.inc.php";
include_once "../app/repositories/UserRepository.inc.php";
include_once "../app/validations/register.inc.php";
include_once "../app/validations/login.inc.php";
include_once "../app/SessionControl.inc.php";

if(isset($_GET["action"]) && !empty($_GET["action"])){
    $action = $_GET["action"];  
}else{
    $action = "";
}

if($action === "create"){
    create_user();
}else if($action === "login"){
    log_in();
}else{
    //header('HTTP/1.1 404 Not Found');
    $json = [
        'status'=> 'Not Found',
        'message'=> 'Ha ocurrido un error',
        'errors' => '<ul><li>Debe ingresar una direccion correcta</li></ul>',
        'code'=> '404',
    ];
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

function create_user(){
    $data = [
        "username" => trim($_POST["username"], " "),
        "email" => trim($_POST["email"], " "),
        "password" => trim($_POST["password"], " "),
        "password_confirmation" => trim($_POST["password_confirmation"], " ")
    ];

    $validator = new registerValidator($data["username"], $data["email"], $data["password"],
        $data["password_confirmation"]);

    if(!$validator->is_valid()){
        //header('HTTP/1.1 406 Not Acceptable');
        $json = [
            'status'=> 'Not Acceptable',
            'message'=> 'Ha ocurrido un error',
            'errors' => $validator->get_errors(),
            'code'=> '406',
        ];
    }else{
        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        Connection::open_connection();
        $flag = UserRepository::create_user(Connection::get_connection(), $data);
        Connection::close_connection();
        if($flag){
            //header('HTTP/1.1 400 Bad Request');
            $json = [
                'status'=> 'Bad Request',
                'message'=> 'Se ha registrado exitosamente.',
                'text' => 'Ahora debe esperar a que un administrador habilite su cuenta',
                'code'=> '201',
            ];
        }else{
            header('HTTP/1.1 201 Created');
            $json = [
                'status'=> 'success',
                'message'=> 'Se ha registrado exitosamente.',
                'text' => 'Ahora debe esperar a que un administrador habilite su cuenta',
                'code'=> '201',
            ];
        }
    }
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

function log_in(){
    $data = [
        "username" => trim($_POST["username"], " "),
        "password" => trim($_POST["password"], " ")
    ];

    Connection::open_connection();
    $validator = new loginValidator(Connection::get_connection(), $data["username"], $data["password"]);
    Connection::close_connection();

    if($validator->get_error() === "" && !is_null($validator->get_user())){
        //iniciar sesion
        //redirigir al usuario
        header('HTTP/1.1 200 OK');
        SessionControl::log_in($validator->get_user()->get_id(), $validator->get_user()->get_name());
        $json = [
            'status'=> 'OK',
            'message'=> 'Se ha logeado exitosamente',
            'text' => '',
            'code'=> '200',
        ];
    }else{
        //header('HTTP/1.1 406 Not Acceptable');
        $json = [
            'status'=> 'Not Acceptable',
            'message'=> 'Ha ocurrido un error',
            'errors' => $validator->get_error(),
            'code'=> '406',
        ];
    }
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
}