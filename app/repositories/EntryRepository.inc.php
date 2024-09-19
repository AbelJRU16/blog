<?php

include_once __DIR__."/../classes/Entry.inc.php";

class EntryRepository{
    
    public static function insert_entry($connection, $entry){
        $flag = false;
        if(isset($connection)){
            try {
                
                $sql = "INSERT INTO entrys(author_id, title, content, fecha, active) 
                    VALUES (:author_id, :title, :content, NOW(), 0)";

                $query = $connection->prepare($sql);

                if ($query === false) {
                    die("Error in the preparation of the query: " . $connection->error);
                }

                $query->bindParam(":author_id", $entry["author_id"], PDO::PARAM_STR);
                $query->bindParam(":title", $entry["title"], PDO::PARAM_STR);
                $query->bindParam(":content", $entry["content"], PDO::PARAM_STR);

                $query->execute() or die('Query failed.');

            } catch (PDOException $ex) {
                print "ERROR: ".$ex->getMessage()."<br>";
                $flag = true;
            }
        }        
        return $flag;
    }

}