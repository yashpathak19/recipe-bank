<?php

require_once 'database/database.php';
require_once 'comment.php';
require_once 'recipeformCRUD.php';
require_once 'websiteCRUD.php';

session_start();
$user = false;
$error = false;
if(isset($_SESSION['email']) && isset($_SESSION['password'])){
  $websiteCRUD = new websiteCRUD();
  $user = $websiteCRUD->checkUser($_SESSION['email'], $_SESSION['password']);
  if (!$user){
    $error = "Error! No user found";
  }
}
$dbcon = Database::getDb();
$comment = new Comment();
$mycomments = $comment->show($dbcon);
$recipe = new RecipeForm();
$myrecipes = $recipe->show($dbcon);

if (isset($_POST['updateLike'])) {
    $uid = $_POST['uid'];
    $recipe_id = $_POST['recipe_id'];
    $websiteCRUD = new websiteCRUD();
    $like = $websiteCRUD->updateLike($recipe_id, $uid, 1);

    if ($like) {
        header("Location: feed.php");
    } else
    {
        echo "We encountered a problem!";
    }

}

if (isset($_POST['addcomment'])) {

        $desc = $_POST['writecmt'];
        if(!empty($desc))
        {


        $recipe_id = $_POST['addcomment'];
        $count = $comment->create($dbcon, $desc, $recipe_id);

            if ($count) {
                header("Location: feed.php");
            } else {
                echo "problem adding a comment";
            }
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
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="feed.js"></script>
    <script src="js/feed.js"></script>
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
    <div class="container mt-3">
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Notifications</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body" id="modal-body">
                Modal body..
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <form action="notifications.php" method="post">
                        <input type="submit" class="btn btn-info" value="Open Notifications"/>
                    </form>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                
            </div>
            </div>
        </div>
        
        </div>
        <div id="feed" class="container p-3 my-3 border" style="max-width: 50%;">
            <h2 class="shadow p-4 mb-4 bg-white">New Recipes</h2>
            <?php
            if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
                header("Location: showerror.php");
            }
            else{

            foreach($myrecipes as $recipe){
               // var_dump((int)$recipe['user_id']);
                //echo $comment->showuserRecipe($recipe['user_id']);

                echo "<img src=\"images/avatar.png\" alt=\"John Doe\"  class=\"mr-3 mt-3 rounded-circle\" style=\"width:60px;\">
                    <div class=\"media-body\">
                <h4>" . $recipe['title'] . "<small><i> By " . $comment->showuserRecipe($recipe['user_id']) . "</i></small></h4>
            </div>
         "?>
    <img class=\"img-fluid\" src=' <?php echo $recipe['image']?>' alt=\"image of recipe\">

		 <form action="feed.php" method="post">
                    <input type="hidden" name="uid" value="<?= $user->id ?>"/>
                    <input type="hidden" name="recipe_id" value=<?=$recipe['id']?>/>
                    <span><?=$websiteCRUD->getTotalLikes($recipe['id'])?></span>
            <?php
                if ($websiteCRUD->checkLike($recipe['id'], $user->id)){
            ?>
                    <input type="submit"  class="btn btn-warning" name="updateLike" value="Unlike"/>
            <?php
                } else {
            ?>
                    <input type="submit" class="btn btn-warning" name="updateLike" value="Like"/>
               
            <?php
                } 
            ?>
            </form>
            <?php
            echo "<div>
                <i 	class=\"fa fa-comment\" onclick = 'displayComments(" . $recipe['id'] .")' name=\"viewcmt\" value=" . $recipe['id'] ." id=\"viewcmt\"></i>

            </div>
            <form method=\"post\" action=\"\">
          
            <div id=\"cmt1\">
                <label for =\"writecmt\"></label>
                <input type=\"text\" id= \"writecmt\" name=\"writecmt\" value=\"\" placeholder=\"...\">

                <button type=\"submit\" name=\"addcomment\" value=" . $recipe['id'] . " class=\"btn btn-outline-secondary btn-sm\"  id=\"postbtn\">Comment</button>
            <div id='showcmt'>  
               
            </div>
             </form>
             <p> Preparation <a href=\"showrecipe.php\">Read more</a></p>";

            }?>


            <div>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </div>
        </div>
<?php } ?>
    </main>
	<section>
			<?php include 'subscription.php';?>
	</section>
    <footer class="page-footer font-small ">
        <?php include 'footer.php'?>
    </footer>
    <script>
        function displayComments(id){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    document.querySelector('#showcmt').innerHTML = this.responseText;
                    console.log(this.responseText);
                }
            }
            xmlhttp.open("GET", "displayComment.php?id="+id, true);
            xmlhttp.send();
        }
    </script>
</body>
</html>
