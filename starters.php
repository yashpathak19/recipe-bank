<?php

require_once 'database/database.php';
require_once 'comment.php';
require_once 'websiteCRUD.php';

$dbcon = Database::getDb();
$comment = new Comment();
$mycomments = $comment->show($dbcon);

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

if (isset($_POST['addcomment'])) {
    $comment_desc = $_POST['writecmt'];

    $count = $comment->create($dbcon,$comment_desc);

    if ($count) {
        header("Location: starters.php");
    } else
    {
        echo "problem adding a comment";
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Starters</title>
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
            <h2 class="shadow p-4 mb-4 bg-white">Starters</h2>
            <img src="images/avatar.png" alt="John Doe"  class="mr-3 mt-3 rounded-circle" style="width:60px;">
            <div class="media-body">
                <h4>Orange Toast <small><i><a href="#">By Ameen Marie</a> Posted on February 28, 2017</i></small></h4>
            </div>
            <img class="img-fluid" src="images/recipe0.jpg" alt="image of recipe pastry">

            <div>
                <i onclick="myFunction(this)" class="fa fa-thumbs-up">12</i>
                <i 	class="fa fa-comment"></i>

            </div>
            <form method="post" action="">
            <div id="cmts">
                <label for ="writecmt"></label>
                <input type="text" id= "writecmt" name="writecmt" value="" placeholder="...">
                <button type="submit" name="addcomment" class="btn btn-outline-secondary btn-sm" id="postbtn">Comment</button>

            </div>
            </form>
            <?php
            foreach($mycomments as $comment){
                echo "<div id='listcmts'>" . $comment['comment_desc'] ."
                     <form style='display: inline-block' action=\"DeleteComment.php\" method=\"post\">
                         <input type=\"hidden\" name=\"id\" value= " . $comment['id'] . " />
                          <input type=\"submit\" name=\"deleteComment\" value=\"Delete\"/>
                     </form>
                      <form style='display: inline-block' action=\"UpdateComment.php\" method=\"post\">
                         <input type=\"hidden\" name=\"id\" value= " . $comment['id'] . " />
                          <input type=\"submit\" name=\"updateComment\" value=\"Edit\"/>
                     </form>
                    </div>";

            }?>
            <p>Take a bread and cut into triangular pieces . <a href="#">Read more</a></p>
            <div>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </div>
        </div>

    </main>
	<section>
			<?php include 'subscription.php';?>
	</section>
    <footer class="page-footer font-small ">
        <?php include 'footer.php'?>
    </footer>
</body>
</html>
