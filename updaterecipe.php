<?php
require_once 'recipeformCRUD.php';
$title = $ingredients = $preparation = $category  = "";


if(isset($_POST['updaterecipe'])){
    $id= $_POST['recipe_id'];
    $recipeCRUD = new RecipeForm();

    $recipe = $recipeCRUD->getRecipe($id);

    $title =  $recipe->title;
    $ingredients = $recipe->ingredients;
    $preparation =  $recipe->preparation;
    $category = $recipe->category;
}

if(isset($_POST['update'])) {
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $preparation = $_POST['preparation'];
    $category = $_POST['category'];
    $id = $_POST['recipe_id'];
    $recipeCRUD = new RecipeForm();

    $count = $recipeCRUD->updaterecipe($id, $title, $ingredients, $preparation, $category);

    if($count){
        header("Location: showrecipe.php");
    } else {
        echo "Sorry we encountered a problem while updating the recipe";
    }
}
?>
<html lang="en">

<head>
    <title>Edit</title>

</head>

<body>

<header class="bg-dark">
    <?php include 'header.php'?>
</header>
<main>
    <div class="container" style="max-width: 50%;">
        <h2 class="shadow p-4 mb-4 bg-white">Recipe Form</h2>
        <form action="" method="post">
            <input type="hidden" name="recipe_id" value="<?= $id; ?>" />
            <div class="form-group">
                <label for="title">Recipe Title:</label>
                <input type="text" class="form-control" value="<?= $title; ?>" name="title" id="title">
            </div>
            <div class="form-group">
                <label for="ingredients">Ingredients:</label>
                <textarea class="form-control" id="ingredients" value="<?= $ingredients; ?>" name="ingredients"></textarea>
            </div>
            <div class="form-group">
                <label for="preparation">Procedure:</label>
                <textarea class="form-control" id="preparation" value="<?= $preparation; ?>" name="preparation" ></textarea>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select class="custom-select" id="category" value="<?= $category; ?>" name="category" >
                    <option>Appetizers</option>
                    <option>Main Course</option>
                    <option>Deserts</option>
                    <option>Bevarages</option>
                </select>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" accept="image/*">
                <label class="custom-file-label" for="customFile">Add Attachment</label>
            </div>

            <button type="submit" id="btn" class="btn btn-success" name="update">Update</button>
        </form>
    </div>
</main>

<footer class="page-footer font-small ">
    <?php include 'footer.php'?>
</footer>


</body>
</html>

