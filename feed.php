<?php
    require_once 'feedCrud.php';
    require_once 'database/database.php';
    require_once 'comment.php';
    require_once 'recipeformCRUD.php';
    require_once 'websiteCRUD.php';

    session_start();
    $user = false;
    $error = false;
	$websiteCRUD = new websiteCRUD();
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

    //function for updating like
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
    $feedObj = new FeedCrud();
    $recipes = $feedObj->listRecipes('recipes')
?>

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
    <script src="js/feed.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <?php include 'header.php'?>
    </header>
    <main>
    <!-- if the user has mute notification on this won't show up -->
    <?php
        if ($user && $user->mute_notification == 0){
    ?>
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
        <?php
            } if ($user) {
        ?>
            <div id="feed" class="container p-3 my-3" style="max-width: 50%;">
                <a class="btn btn-outline-secondary btn-lg btn-block" href="createRecipe.php">Add new Recipe</a>
            </div>
        <?php
            }
        ?>
        <div class="container">
            <form id="sorting-form" method="post">
                <div class="row sorting-container">
                    <div class="sorting-dd">
                        <select id="sortmeal" >
                            <option value="0">Sort by meals</option>
                            <option value ="appetizers">Appetizers</option>
                            <option value="main">Main Course</option>
                            <option value="deserts">Deserts</option>
                            <option value="beverages">Bevarages</option>
                        </select>
                    </div>   
                    <!-- <div class="sorting-dd">
                        <select id="sortpopular">
                            <option value="">Sort by popularity</option>
                            <option value="mp">Most Popular</option>
                            <option value="lp">Least Popular</option>
                        </select>
                    </div> -->
                    <div class="sorting-dd">
                        <select id="sortdate">
                            <option value="0">Sort by date</option>
                            <option value="asc">Newest</option>
                            <option value="desc">Oldest</option>
                        </select>
                    </div>
                    
                </div>
            </form>
            <div class="sorting-dd">
                        <button class="btn btn-sm btn-secondary" onclick = "sortFeed()">Apply filters</button>
                    </div>
        </div>
        <div class="container feed-main-container" id="feed-main-container" style="margin: 1em auto">
            <?php
				
                foreach($recipes as $r){
                    echo("
                        <div class='card feed-card' style='width: 18rem;'>
                            <a href='showRecipe.php?id=".$r['id']."'>
                                <img class='card-img-top' src='upload/".$r['recipe_img']."' alt='Card image cap'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$r['title']."</h5>
                                    <p class='card-text'>Likes ".$websiteCRUD->getTotalLikes($r['id'])."</p>
                                </div>
                            </a>
                        </div>
                    ");
                }
            ?>
        </div>
        
    </main>
	<section>
		<?php include "subscription.php" ?>
	</section>
    <footer class="page-footer font-small ">
        <?php include 'footer.php'?>
    </footer>
    <script>
        function sortFeed(){
            mealparam = $("#sortmeal option:selected").val();
           
            dateparam = $("#sortdate option:selected").val();
            response = $.ajax({
                type: "POST",
                url: 'sortRecipe.php',
                data: {meal: mealparam, date:dateparam},
                success: function(data){
                   $('#feed-main-container').html(data);
                    //document.getElementById('feed-main-container').innerHTML = data;
                    console.log(data);
                },
                error: function() {
                    alert('There was some error performing the AJAX call!'+err);
                }
            });
        }
    </script>
</body>
</html>
