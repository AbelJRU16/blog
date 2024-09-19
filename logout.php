<?php
include_once "template/header.inc.php";

if(SessionControl::session_init()){
    SessionControl::close_session();
}
Redirection::redirect(SERVER);