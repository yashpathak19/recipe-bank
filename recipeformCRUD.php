<?php

class RecipeForm{

    public function show($dbcon){
        $sql = 'select * from recipes';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $myrecipes= $pdostm->fetchAll();//fetch for get the data
        return $myrecipes;
    }

    public function create($dbcon,$title,$ingredients,$preparation,$category){
        $sql = "INSERT INTO recipes (title,ingredients,preparation,category)
              VALUES (:title,:ingredients,:preparation,:category)";
        if(!empty($title) && !empty($ingredients) && !empty($preparation) && !empty($category)) {

            $pst = $dbcon->prepare($sql);

            $pst->bindParam(':title,:ingredients,:preparation,:category', $title,$ingredients,$preparation,$category);
            $count = $pst->execute();
            return $count;
        }
        else {
            header("Location: feed.php");

        }
    }
    public function showupd($dbcon,$id){
        $sql = "SELECT * FROM comments where id = :id";

        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $comment = $pst->fetch(PDO::FETCH_OBJ);

        $comment_desc =  $comment->comment_desc;
        return $comment_desc;
    }
    public function update($dbcon,$comment_desc,$id){

        $sql = "Update comments
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
        //deleting selected recipe
        $sql = "DELETE FROM recipes WHERE id = :id";

        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }
}