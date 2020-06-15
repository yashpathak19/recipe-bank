<?php
    require_once 'feedCrud.php';
    require_once 'comment.php';
    require_once 'websiteCRUD.php';
    session_start();
    //$userEmail = $_SESSION['email'];
    $recipeId = $_GET['id'];
    $feedObj = new FeedCrud();
    $commentObj = new Comment();
    $websiteCRUD = new websiteCRUD();


    //---
    require_once 'database/database.php';
    require_once 'websiteCRUD.php';

    $user = false;
    $error = false;
    if(isset($_SESSION['email']) && isset($_SESSION['password'])){
		$userEmail = $_SESSION['email'];
        $user = $websiteCRUD->checkUser($_SESSION['email'], $_SESSION['password']);
    if (!$user){
        $error = "Error! No user found";
    }
    }

    if (isset($_POST['updateLike'])) {
        $uid = $_POST['uid'];
        $recipe_id = $_POST['recipe_id'];
        $like = $websiteCRUD->updateLike($recipe_id, $uid, 1);

        if ($like) {
            header("Location: showRecipe.php?id=" . $recipe_id);
        } else
        {
            echo "We encountered a problem!";
        }

    }
    //----
	if(isset($_SESSION['email']) && isset($_SESSION['password'])){
		$loggedUser = $feedObj->custom("SELECT * FROM users where email= '$userEmail'");
		$userId = $loggedUser[0]['id'];
		$userFullname = $loggedUser[0]['first_name']." ".$loggedUser[0]['last_name'];
	}
    
    $author = $feedObj->showAuthor($recipeId);
    $authorFullName = $author['first_name'].' '.$author['last_name'];
    $recipeComments = $commentObj->showRecipeComment($recipeId);
    $recipe = $feedObj->showRecipe($recipeId);
    $recipeTitle = $recipe['title'];
    $recipeIng = $recipe['ingredients'];
    $recipePrep = $recipe['preparation'];
    $recipeImg = $recipe['recipe_img'];
    $recipeDate = $recipe['posted_date'];

    if (isset($_POST['addcomment'])) {

        $desc = $_POST['writecmt'];
        if(!empty($desc))
        {
        $count = $commentObj->create($desc, $recipeId,$userId,date("Y-m-d\TH:i:s", time()));
            if ($count) {
                header("Refresh:0");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
   <!---->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark">
        <?php include 'header.php'?>
    </header>
    <main>
        <div class="container">
            <h1 class="mt-4"><?=$recipeTitle?></h1>
            <p class="lead">
                by
                <?=$authorFullName?>
            </p>
            <hr>

            <p>Posted on <?=$recipeDate?></p>
            
            <hr>

            <img class="img-fluid rounded" width="500"  src="upload/<?=$recipeImg?>" alt="">

            <hr>

            <h2>Ingredients</h2>
            <p>
                <!--Ingredients content-->
                <?=$recipeIng?>
            </p>

            <hr>

            <h2>Preparations</h2>
            <p>
                <!--preparations content-->
                <?=$recipePrep?>
            </p>
            <div class="container">
                <form action="showRecipe.php?id=<?=$recipe['id']?>" method="post">
                        <input type="hidden" name="uid" value="<?= $user->id ?>"/>
                        <input type="hidden" name="recipe_id" value=<?=$recipe['id']?>/>
                <?php
                    if ($user && $websiteCRUD->checkLike($recipe['id'], $user->id)){
                ?>
                        <button type="submit"  class="btn btn-primary" name="updateLike"><span class="badge badge-light"><?=$websiteCRUD->getTotalLikes($recipe['id'])?></span> Unlike</button>
                <?php
                    } else if ($user) {
                ?>
                        <button type="submit" class="btn btn-primary" name="updateLike"><span class="badge badge-light"><?=$websiteCRUD->getTotalLikes($recipe['id'])?></span> Like</button>
                
                <?php
                    } else {
                ?>
                    <div class="alert alert-danger mt-3">
                        Please log-in or Sign Up in order to like posts or comment!
                    </div>
                    <button type="button" class="btn btn-primary mb-3" disabled><span class="badge badge-light"><?=$websiteCRUD->getTotalLikes($recipe['id'])?></span> Like</button>
                <?php
                    }
                ?>
            </div>
            <?php
                if ($user)
                {
            ?>
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <textarea name="writecmt" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit"  name="addcomment" value="<?=$recipeId?>" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            <?php
                }
            ?>
            <div id="display-comments">
                <?php
                    foreach($recipeComments as $comment){
                        echo("
                        <div class='media mb-4'>
                            <img class='d-flex mr-3 rounded-circle' src='http://placehold.it/50x50' alt=''>
                            <div class='media-body'>
                                <h5 class='mt-0'>".$comment['first_name']."</h5>
                                ".$comment['comment_desc']."
                             </div>
                         </div>
                        ");
                    }
                ?>
                
            </div>

        </div>
    </main>
    <footer class="page-footer font-small ">
        <?php include 'footer.php'?>
    </footer>
</body>
</html>
