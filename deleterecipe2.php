<?php
require_once 'recipeformCRUD.php';

if(isset($_POST['recipe_id'])){
    $id = $_POST['recipe_id'];

    $recipe = new RecipeForm();

    $count = $recipe->deleterecipe($id);
    if($count){
        header("Location: feed.php");
    }
    else {
        echo "Unfortunately the recipe cannot be deleted";
    }


}
