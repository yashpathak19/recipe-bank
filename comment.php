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
        $sql = "select * from notifications where recipe_id=$id";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $results = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function create($dbcon,$comment_desc,$recipe_id){
        $sql = "INSERT INTO notifications (comment_desc,recipe_id) 
              VALUES (:comment_desc,:recipe_id)";
        if(!empty($comment_desc)) {

            $pst = $dbcon->prepare($sql);

            $pst->bindParam(':comment_desc', $comment_desc);
            $pst->bindParam(':recipe_id', $recipe_id);

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