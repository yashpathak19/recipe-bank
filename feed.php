<?php

require_once 'database/database.php';
require_once 'comment.php';
require_once 'recipeformCRUD.php';
$dbcon = Database::getDb();
$comment = new Comment();
$mycomments = $comment->show($dbcon);
$recipe = new RecipeForm();
$myrecipes = $recipe->show($dbcon);

if (isset($_POST['addcomment'])) {
    $desc = $_POST['writecmt'];
    $recipe_id = $_POST['addcomment'];
    $count = $comment->create($dbcon,$desc,$recipe_id);

    if ($count) {
        header("Location: feed.php");
    } else
    {
        echo "problem adding a comment";
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8"/>
    <title>Feed</title>
    <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
    <!---->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="feed.js"></script>
   <!---->
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
        
    <img class=\"img-fluid\" src=\"\" alt=\"image of recipe\">

            <div>
                <i onclick=\"myFunction(this)\" class=\"fa fa-thumbs-up\">12</i>
                <i 	class=\"fa fa-comment\" onclick='displayComments(" . $recipe['id'] .")' name=\"viewcmt\" id=\"viewcmt\"></i>

            </div>
            <form method=\"post\" action=\"\">
            <div id=\"cmt1\">
                <label for =\"writecmt\"></label>
                <input type=\"text\" id= \"writecmt\" name=\"writecmt\" value=\"\" placeholder=\"...\">

                <button type=\"submit\" name=\"addcomment\" value=" . $recipe['id'] . " class=\"btn btn-outline-secondary btn-sm\"  id=\"postbtn\">Comment</button>
            <div id='showcmt'>  
               
            </div>
             </form>
             <p> " . $recipe['preparation'] . "<a href=\"#\">Read more</a></p>";

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
    <script>
        function displayComments(id){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('showcmt').innerHTML = this.responseText;
                    console.log(this.responseText);
                }
            }
            xmlhttp.open("GET", "displayComment.php?id="+id, true);
            xmlhttp.send();
        }
    </script>
</body>
</html>
