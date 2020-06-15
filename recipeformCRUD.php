<?php
require_once "database/database.php";
class RecipeForm{

    public function show($dbcon){
        $sql = 'select * from recipes';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $myrecipes= $pdostm->fetchAll();//fetch for get the data
        return $myrecipes;
    }

    public function deleterecipe($id){
        $dbcon = Database::getDb();
        $sql = "DELETE FROM recipes WHERE id = :id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        return $pst->execute();
    }
    public function create($dbcon,$title,$ingredients,$preparation,$category,$image)
    {
        $sql = "INSERT INTO recipes (title,ingredients,preparation,category,image)
              VALUES (:title,:ingredients,:preparation,:category,:image)";
        if(!empty($title) && !empty($ingredients) && !empty($preparation) && !empty($category)) {

            $pst = $dbcon->prepare($sql);

            $pst->bindParam(':title', $title);
            $pst->bindParam(':ingredients',$ingredients);
            $pst->bindParam(':preparation', $preparation);
            $pst->bindParam(':category', $category);
            $pst->bindParam(':image', $image);
            $count = $pst->execute();
            return $count;
        }
        else {
            header("Location: feed.php");

        }
    }

    public function updaterecipe($id, $title, $ingredients, $preparation, $category){
        $dbcon = Database::getDb();
        $sql = "Update recipes
                set title = :title,
                ingredients = :ingredients,
                preparation = :preparation,
                category = :category,
                WHERE id = :id
            ";

        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':title', $title);
        $pst->bindParam(':ingredients', $ingredients);
        $pst->bindParam(':preparation', $preparation);
        $pst->bindParam(':category', $category);
        $pst->bindParam(':id', $id);

        return $pst->execute();
    }
    public function getRecipe($id){
        $dbcon = Database::getDb();
        $sql = "SELECT * FROM recipes WHERE id = :id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(PDO::FETCH_OBJ);
    }


}