<?php
require_once "database/database.php";
class FeedCrud{
    public function custom($sql){
        $dbcon = database::getDb();
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $results = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function listRecipes($tableName){
        $dbcon = database::getDb();
        $sql = "select * from $tableName";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $results= $pdostm->fetchAll();//fetch for get the data
        return $results;
    }

    public function deleterecipe($id){
        $dbcon = database::getDb();
        $sql = "DELETE FROM recipes WHERE id = :id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }
    public function createRecipe($title,$ingredients,$preparation,$category,$img,$user_id,$posted_date)
    {
        $dbcon = database::getDb();
        $sql = "INSERT INTO recipes (title,ingredients,preparation,category,recipe_img,user_id,posted_date)
              VALUES (:title,:ingredients,:preparation,:category,:img,:user_id,:date)";
        
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':title', $title);
        $pst->bindParam(':ingredients',$ingredients);
        $pst->bindParam(':preparation', $preparation);
        $pst->bindParam(':category', $category);
        $pst->bindParam(':img', $img);
        $pst->bindParam(':user_id', $user_id);
        $pst->bindParam(':date', $posted_date);
        $count = $pst->execute();
        return $count;
        
    }

    public function updaterecipe($id,$title,$ingredients,$preparation,$category,$img,$posted_date){
        $dbcon = database::getDb();
        $sql = "Update recipes
                set title = :title,
                ingredients = :ingredients,
                preparation = :preparation,
                category = :category,
                recipe_img = :img,
                posted_date = :date
                WHERE id = :id
            ";

        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':title', $title);
        $pst->bindParam(':ingredients', $ingredients);
        $pst->bindParam(':preparation', $preparation);
        $pst->bindParam(':category', $category);
        $pst->bindParam(':img', $img);
        $pst->bindParam(':date',$posted_date);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }
    public function showRecipe($id){
        $dbcon = database::getDb();
        $sql = "SELECT * FROM recipes WHERE id = :id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(PDO::FETCH_ASSOC);
    }

    public  function showAuthor($id){
        $dbcon = database::getDb();
        $sql = "SELECT users.first_name, users.last_name FROM recipes inner join users on users.id = recipes.user_id WHERE recipes.id = :id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(PDO::FETCH_ASSOC);
    }
    
}
