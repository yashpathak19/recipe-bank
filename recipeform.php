<?php

require_once 'database/database.php';
require_once 'recipeformCRUD.php';

$dbcon = Database::getDb();
$recipe = new RecipeForm();
$myrecipes = $recipe->show($dbcon);


if (isset($_POST['addrecipe'])) {
    $title = $_POST['title'];
    $ingredients =$_POST['ingredients'];
    $preparation = $_POST['proc'];
    $category = $_POST['category'];

    $count = $recipe->create($dbcon,$title,$ingredients,$preparation,$category);

    if ($count) {
        header("Location: feed.php");
    } else
    {
        echo "problem adding a recipe";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Home Page</title>
    <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>
    <header class="bg-dark">
        <?php include 'header.php'?>
    </header>
    <main>
        <div class="container" style="max-width: 50%;">
            <h2 class="shadow p-4 mb-4 bg-white">Recipe Form</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="title">Recipe Title:</label>
                    <input type="text" class="form-control"  name="title" id="title" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="ingred">Ingredients:</label>
                    <textarea class="form-control" id="ingred" name="ingredients" placeholder="Enter ingredients"></textarea>
                </div>
                <div class="form-group">
                    <label for="proc">Procedure:</label>
                    <textarea class="form-control" id="proc" name="proc" placeholder="Write Procedure here..."></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select class="custom-select" id="category" name="category" placeholder="Write Procedure here...">
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

                <button type="submit" id="btn" class="btn btn-success" name="addrecipe">Submit</button>
            </form>
        </div>
    </main>

    <footer class="page-footer font-small ">
        <?php include 'footer.php'?>
    </footer>
</body>
</html>