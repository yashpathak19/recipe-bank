<?php
require_once 'feedCRUD.php';
session_start();
$userEmail = $_SESSION['email'];
$loggedUser = $feedObj->custom("SELECT * FROM users where email= '$userEmail'");
$userId = $loggedUser[0]['id'];
$recipe = new FeedCrud();
$max_id = $recipe->custom('select max(id) from recipes');
$max_recipe_id = $max_id[0]['max(id)'];
if($max_recipe_id == null){
    $max_recipe_id = 0;
}
$recipe_id = $max_recipe_id+1;
if (isset($_POST['addrecipe'])) {
    if(!empty($_FILES["image"]["tmp_name"])) {
        $title = $_POST['title'];
        $ingredients = $_POST['ingredients'];
        $preparation = $_POST['preparation'];
        $category = $_POST['category']; 
        //uploading image
        $allowTypes = array('jpg','png','jpeg','gif');
        $img = $_FILES["image"]["name"];
        $temp = explode(".", $img);
        if(in_array(strtolower(end($temp)), $allowTypes)){
            $img_name = "r".($recipe_id);
            $newfilename =  $img_name . '.' . end($temp);
            move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $newfilename);
        }else{
            var_dump('file format not okay');
        }
        $count = $recipe->createRecipe($title, $ingredients, $preparation, $category, $newfilename, $userId, date("Y-m-d\TH:i:s", time()));
        if ($count) {
            header("Location: listRecipe.php");
        } else {
            echo "problem adding a recipe";
        }
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
                <h2 class="shadow p-4 mb-4 bg-white">Add Recipe</h2>
                <form action="" method="post" enctype="multipart/form-data">
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
                        <textarea class="form-control" id="proc" name="preparation" placeholder="Write Procedure here..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select class="custom-select" id="category" name="category" placeholder="Write Procedure here...">
                            <option value ="appetizers">Appetizers</option>
                            <option value="main">Main Course</option>
                            <option value="deserts">Deserts</option>
                            <option value="beverages">Bevarages</option>
                        </select>
                    </div>
                    <div class="custom-file">
                        Select image: <input type="file" name="image" id="upfile">
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