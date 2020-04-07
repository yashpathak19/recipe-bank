<?php
session_start();

require_once 'database/database.php';
require_once 'comment.php';
require_once 'recipeformCRUD.php';
$dbcon = Database::getDb();
$comment = new Comment();
$mycomments = $comment->show($dbcon);
$recipe = new RecipeForm();
$myrecipes = $recipe->show($dbcon);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Feed</title>
    <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
    <!---->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="feed.js"></script>
    <script src="comment.js"></script>
    <!---->
    <link rel="stylesheet" type="text/css" href="comment.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<header>
    <?php include 'header.php'?>
</header>
<main>
    <div id="feed" class="container p-3 my-3 border" style="max-width: 50%;">
        <h2 class="shadow p-4 mb-4 bg-white">New Recipes</h2>
        <?php
        foreach($myrecipes as $recipe){

            echo "<img src=\"images/avatar.png\" alt=\"John Doe\"  class=\"mr-3 mt-3 rounded-circle\" style=\"width:60px;\">
                    <div class=\"media-body\">
                <h4>" . $recipe['title'] . "<small><i><a href=\"#\"> By Nova Belly</a> Posted on December 30, 2019</i></small></h4>
            </div>
            <div><form style='display: inline-block' action=\"updaterecipe.php\" method=\"post\">
                         <input type=\"hidden\" name=\"recipe_id\" value= " . $recipe['id'] . " />
                          <input type=\"submit\" name=\"updaterecipe\" value=\"Edit\"/>
                     </form>
                     <form style='display: inline-block' action=\"deleterecipe.php\" method=\"post\">
                         <input type=\"hidden\" name=\"recipe_id\" value= " . $recipe['id'] . " />
                          <input type=\"submit\" name=\"deleterecipe\" value=\"Delete\"/>
                     </form>
                     
                     </div>
        
    <img class=\"img-fluid\" src=\"images/maincourse0.jpg\" alt=\"image of recipe pastry\">

            <div>
                <i onclick=\"myFunction(this)\" class=\"fa fa-thumbs-up\">12</i>
                <i 	class=\"fa fa-comment\" name=\"viewcmt\" id=\"viewcmt\"></i>

            </div>
            <div method=\"post\" action=\"\">
            <div id=\"cmt1\">
                <label for =\"writecmt\"></label>
                <input type=\"text\" id= \"writecmt\" name=\"writecmt\" value=\"\" placeholder=\"...\">

                <button type=\"submit\" name=\"addcomment\" class=\"btn btn-outline-secondary btn-sm\" id=\"postbtn\">Comment</button>

            </div> 
              
             <p> " . $recipe['preparation'] . "<a href=\"#\">Read more</a></p>
                ";

        }?>
        <div>
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>
    </div>

</main>
<footer class="page-footer font-small ">
    <?php include 'footer.php'?>
</footer>
</body>
</html>
