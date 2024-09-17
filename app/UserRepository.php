<?php


class UserRepository{

    public static function get_users_count($connection){
        $total_users = 0;
        if(isset($connection)){
            try {
                
                include_once("User.inc.php");
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
                
                include_once("User.inc.php");
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
                            $row["activo"],
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
}