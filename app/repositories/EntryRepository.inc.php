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

    public static function get_entries_count($connection){
        $total_entries = 0;
        if(isset($connection)){
            try {

                $sql = "SELECT count(*) as total FROM entrys";
                $sentence = $connection->prepare($sql);
                $sentence->execute();
                $result = $sentence->fetch();

                $total_entries = $result["total"];

            } catch (PDOException $ex) {
                print "ERROR: ".$ex->getMessage()."<br>";
            }
        }   
        return $total_entries;
    }

    public static function get_entries($connection, $page=1){
        $entries = [];
        if(isset($connection)){
            try {
                $offset = ($page - 1) * 5;
                $sql = "SELECT * FROM entrys LIMIT $offset, 5";
                $sentence = $connection->prepare($sql);
                $sentence->execute();
                $result = $sentence->fetchAll();

                if(count($result)){
                    foreach($result as $row){
                        $entries[] = new Entry(
                            $row["id"],
                            $row["author_id"],
                            $row["title"],
                            $row["content"],
                            $row["fecha"],
                            $row["active"],
                        );
                    }
                }
            } catch (PDOException $ex) {
                print "ERROR: ".$ex->getMessage()."<br>";
            }
        }
        return $entries;
    }

    public static function get_entry($connection, $id){
        $entry = [];

        if(isset($connection)){
            try {

                $sql = "SELECT * FROM entrys WHERE id = :id";
                $query = $connection->prepare($sql);
                $query->bindParam(":id", $id, PDO::PARAM_INT);

                if ($query === false) {
                    die("Error in the preparation of the query: " . $connection->error);
                }

                $query->execute() or die('Query failed.');

                $result = $query->fetch();

                if(!empty($result)) {
                    $entry = [
                        'id' => $result["id"],
                        'author_id' => $result["author_id"],
                        'title' => $result["title"],
                        'content' => $result["content"],
                        'fecha' => $result["fecha"],
                        'active' => $result["active"],
                    ];
                }
            } catch (PDOException $ex) {
                print "ERROR: ".$ex->getMessage()."<br>";
            }
        }
        return $entry;
    }

}