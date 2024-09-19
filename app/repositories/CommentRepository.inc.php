<?php

include_once __DIR__."/../classes/Comment.inc.php";

class CommentRepository{
    
    public static function insert_comment($connection, $comment){
        $flag = false;
        if(isset($connection)){
            try {
                
                $sql = "INSERT INTO comments(author_id, entry_id, title, content, fecha) 
                    VALUES (:author_id, :entry_id, :title, :content, NOW())";

                $query = $connection->prepare($sql);

                if ($query === false) {
                    die("Error in the preparation of the query: " . $connection->error);
                }

                $query->bindParam(":author_id", $comment["author_id"], PDO::PARAM_STR);
                $query->bindParam(":entry_id", $comment["entry_id"], PDO::PARAM_STR);
                $query->bindParam(":title", $comment["title"], PDO::PARAM_STR);
                $query->bindParam(":content", $comment["content"], PDO::PARAM_STR);

                $query->execute() or die('Query failed.');

            } catch (PDOException $ex) {
                print "ERROR: ".$ex->getMessage()."<br>";
                $flag = true;
            }
        }        
        return $flag;
    }

}