<?php

class Comment{

    public function show($dbcon){
        $sql = 'select * from notifications where recipe_id = recipes->id';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $mycomments= $pdostm->fetchAll();//fetch for get the data
        return $mycomments;
    }

    public function create($dbcon,$comment_desc){
        $sql = "INSERT INTO notifications (comment_desc) 
              VALUES (:comment_desc)";
        if(!empty($comment_desc)) {

            $pst = $dbcon->prepare($sql);

            $pst->bindParam(':comment_desc', $comment_desc);
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