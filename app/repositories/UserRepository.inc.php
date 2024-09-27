<?php

class UserRepository{

    public static function get_users_count($connection){
        $total_users = 0;
        if(isset($connection)){
            try {
                include_once(__DIR__."/../classes/User.inc.php");
                $sql = "SELECT count(*) as total FROM users";
                $sentence = $connection->prepare($sql);
                $sentence->execute();
                $result = $sentence->fetch();

                $total_users = $result["total"];

            } catch (PDOException $ex) {
                print "ERROR: ".$ex->getMessage()."<br>";
            }
        }   
        return $total_users;
    }

    public static function get_all_users($connection){
        $users = array();
        if(isset($connection)){
            try {
                
                include_once(__DIR__."/../classes/User.inc.php");
                $sql = "SELECT * FROM users";
                $sentence = $connection->prepare($sql);
                $sentence->execute();
                $result = $sentence->fetchAll();

                if(count($result)){
                    foreach($result as $row){
                        $users[] = new User(
                            $row["id"],
                            $row["name"],
                            $row["email"],
                            $row["password"],
                            $row["register_date"],
                            $row["active"],
                        );
                    }
                }else{
                    print 'No hay usuarios';
                }
            } catch (PDOException $ex) {
                print "ERROR: ".$ex->getMessage()."<br>";
            }
        }        
        return $users;
    }

    public static function does_it_exist($connection, $field_name, $var){
        $exist = true;

        if(isset($connection)){
            try {
                $sql = "SELECT * FROM users WHERE $field_name = :field";
                
                $query = $connection->prepare($sql);
                $query->bindParam(":field", $var, PDO::PARAM_STR);

                if ($query === false) {
                    die("Error in the preparation of the query: " . $connection->error);
                }

                $query->execute() or die('Query failed.');

                $result = $query->fetch();

                $exist = (!isset($result)) ? true : false;
            } catch (PDOException $ex) {
                print "ERROR: ".$ex->getMessage()."<br>";
            }
        }
        return $exist;
    }

    public static function get_user_by_field($connection, $field_name, $var){
        $user = null;

        if(isset($connection)){
            try {

                include_once(__DIR__."/../classes/User.inc.php");
                $sql = "SELECT * FROM users WHERE $field_name = :field";
                $query = $connection->prepare($sql);
                $query->bindParam(":field", $var, PDO::PARAM_STR);

                if ($query === false) {
                    die("Error in the preparation of the query: " . $connection->error);
                }

                $query->execute() or die('Query failed.');

                $result = $query->fetch();

                if(!empty($result)) {
                    $user = new User(
                        $result['id'],
                        $result['name'],
                        $result['email'],
                        $result['password'],
                        $result['register_date'],
                        $result['active'],
                    );
                }
            } catch (PDOException $ex) {
                print "ERROR: ".$ex->getMessage()."<br>";
            }
        }
        return $user;
    }

    public static function create_user($connection, $data){
        $flag = false;
        if(isset($connection)){
            try {
                
                $sql = "INSERT INTO users(name, email, password, register_date, active) 
                    VALUES (:name, :email, :password, NOW(), 0)";

                $query = $connection->prepare($sql);

                if ($query === false) {
                    die("Error in the preparation of the query: " . $connection->error);
                }

                $query->bindParam(":name", $data["username"], PDO::PARAM_STR);
                $query->bindParam(":email", $data["email"], PDO::PARAM_STR);
                $query->bindParam(":password", $data["password"], PDO::PARAM_STR);

                $query->execute() or die('Query failed.');

            } catch (PDOException $ex) {
                print "ERROR: ".$ex->getMessage()."<br>";
                $flag = true;
            }
        }        
        return $flag;
    }
}