<?php
require_once 'database/database.php';
class Comment{

    public function show($dbcon){
        $sql = 'select * from notifications';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $mycomments= $pdostm->fetchAll();//fetch for get the data
        return $mycomments;
    }
    public function showRecipeComment($id){
        $dbcon = database::getDb();
        $sql = "select notifications.*, users.* from notifications inner join users on notifications.sender_user_id = users.id where type = 0 and recipe_id=$id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $results = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($results);
        return $results;
    }
    public function showuserRecipe($id){
        $dbcon = database::getDb();
        $sql = "select first_name from users where id = $id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $results = $pdostm->fetch(PDO::FETCH_COLUMN);
        return $results;
    }

    public function create($comment_desc,$recipe_id,$userId,$date){
        $dbcon = database::getDb();
        $sql = "INSERT INTO notifications (comment_desc,recipe_id,sender_user_id,notification_date) 
              VALUES (:comment_desc,:recipe_id,:user_id,:date)";
        if(!empty($comment_desc)) {

            $pst = $dbcon->prepare($sql);

            $pst->bindParam(':comment_desc', $comment_desc);
            $pst->bindParam(':recipe_id', $recipe_id);
            $pst->bindParam(':user_id', $userId);
            $pst->bindParam(':date', $date);
            $count = $pst->execute();
            return $count;
        }
        else {
            header("Location: feed.php");

        }
    }
    public function showupd($dbcon,$id){
        $sql = "SELECT * FROM notifications where id = :id";

        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $comment = $pst->fetch(PDO::FETCH_OBJ);

        $comment_desc =  $comment->comment_desc;
        return $comment_desc;
    }
    public function update($dbcon,$comment_desc,$id){

        $sql = "Update notifications
                set comment_desc = :comment_desc
                WHERE id = :id";
        if(!empty($comment_desc)) {
            $pst = $dbcon->prepare($sql);

            $pst->bindParam(':comment_desc', $comment_desc);
            $pst->bindParam(':id', $id);

            $count = $pst->execute();
            return $count;
        }else{
            header("Location:feed.php");
        }

    }
    public function del($dbcon,$id){
        //deleting selected comment
        $sql = "DELETE FROM notifications WHERE id = :id";

        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }
}