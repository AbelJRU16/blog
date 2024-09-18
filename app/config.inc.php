<?php

#server
define("SERVER_NAME", "localhost"); 
define("USER_NAME", "blog_user"); 
define("DB_NAME", "blog"); 
define("PASSWORD", "password"); 

#routes
define("SERVER", "http://localhost/blog");
define("REGISTER", SERVER."/registro.php");
define("LOGIN", SERVER."/inicio-sesion.php");
define("LOGOUT", SERVER."/logout.php");