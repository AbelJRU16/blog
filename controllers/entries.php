<?php

include_once "../app/Connection.inc.php";
include_once "../app/repositories/EntryRepository.inc.php";

if(isset($_GET["action"]) && !empty($_GET["action"])){
    $action = $_GET["action"];  
}else{
    $action = "";
}

if($action === "get"){
    get_entries();
}else if($action === "show"){
    $id = (isset($_GET["id"]) && !empty($_GET["id"])) ? $_GET["id"] : '';
    show($id);
}else if($action === "create"){
    create();
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

function get_entries(){

    $data = json_decode(file_get_contents('php://input'), true);

    $page = $data["page"];

    Connection::open_connection();
    $entries = EntryRepository::get_entries(Connection::get_connection(), $page);
    $total = EntryRepository::get_entries_count(Connection::get_connection());
    Connection::close_connection();

    foreach($entries as $entry){
        $result[] = [
            "id" => $entry-> get_id(),
            "author_id" => $entry-> get_author_id(),
            "title" => $entry-> get_title(),
            "content" => $entry-> get_content(),
            "fecha" => $entry-> get_fecha(),
            "active" => $entry-> get_active(),
        ];
    }
    
    $json = [
        'status'=> 'OK',
        'message'=> 'Se ha devuleto los resultados',
        'page' => $page,
        'data' => $result,
        'count' => $total,
        'code'=> '200',
    ];
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

function show($id){
    if($id != ''){
        Connection::open_connection();
        $entry = EntryRepository::get_entry(Connection::get_connection(), $id);
        Connection::close_connection();
        $json = [
            'status'=> 'OK',
            'message'=> 'Se ha devuleto la entrada',
            'entry' => $entry,
            'code'=> '200',
        ];        
    }else{
        $json = [
            'status'=> 'Not Found',
            'message'=> 'Ha ocurrido un error',
            'code'=> '404',
        ];
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

function create(){
    $data = [
        'author_id' => $_POST['author_id'],
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'active' => $_POST['active'],
    ];
    Connection::open_connection();
    $flag = EntryRepository::insert_entry(Connection::get_connection(), $data);
    Connection::close_connection();
    $json = [
        'status'=> 'success',
        'message'=> 'Se ha registrado exitosamente.',
        'text' => '',
        'code'=> '201',
    ];
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
