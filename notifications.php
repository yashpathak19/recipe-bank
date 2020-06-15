<?php

require_once 'database/database.php';
require_once 'websiteCRUD.php';
session_start();
$user = false;
$error = false;
//getting the logged in user
if(isset($_SESSION['email']) && isset($_SESSION['password'])){
  $websiteCRUD = new websiteCRUD();
  $user = $websiteCRUD->checkUser($_SESSION['email'], $_SESSION['password']);
  if (!$user){
    echo "Error! No user found";
  }
}
//code for hiding the notification
if(isset($_POST['removeNotification'])){
    $notificationid = $_POST['id'];

    $notification = new websiteCRUD();

    $count = $notification->hideNotification($notificationid);
    if($count){
        header("Location: notifications.php");
    }
    else {
        echo "Unfortunately the notification cannot be Hidden";
    }
}
//code for marking it as viewed notification
if(isset($_POST['markAsViewedNotification'])){
    $notificationid = $_POST['id'];

    $notification = new websiteCRUD();

    $count = $notification->hideNotification($notificationid, "opened");
    if($count){
        header("Location: notifications.php");
    }
    else {
        echo "Unfortunately the notification cannot be marked as Viewed";
    }
}

//code for marking the notifications as unread
if(isset($_POST['markAsUnreadNotification'])){
    $notificationid = $_POST['id'];

    $notification = new websiteCRUD();

    $count = $notification->hideNotification($notificationid, "new");
    if($count){
        header("Location: notifications.php");
    }
    else {
        echo "Unfortunately the notification cannot be marked as Viewed";
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
        <header>
            <?php include 'header.php'?>
        </header>
        <div class="container">
            <h1>Notifications</h1>
            <?php
                if ($user){
                    foreach ($websiteCRUD->getLikes($user) as $like)
                    { 
                        if (!$like['status']){
                            $like['status'] = 'new';
                        }
                        if ($like['status'] != 'new') 
                        {
                ?>
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <?php
                                    if ($like['comment'] != '')
                                    {
                                ?>
                                    <span><strong><?=$like['first_name']?></strong> commented "<?=$like['comment']?>" on your <a href="showRecipe.php?id=<?=$like['id']?>"> <?=$like['title']?></a> recipe</span>
                                <?php
                                    } else { 
                                ?>
                                    <span><?=$like['first_name']?> liked your <a href="showRecipe.php?id=<?=$like['id']?>"> <?=$like['title']?></a> recipe</span>
                                <?php
                                    }
                                ?>
                                <form action="notifications.php" method="post" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?= $like['notification_id'] ?>"/>
                                    <input type="submit" class="btn btn-success" name="markAsUnreadNotification" value="Mark as Unread"/>
                                </form>
                                <form action="notifications.php" method="post" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?= $like['notification_id'] ?>"/>
                                    <input type="submit" class="btn btn-danger" name="removeNotification" value="Hide"/>
                                </form>
                            </div> 
                        </div>
            <?php
                } else {
            ?>
                    <div class="card bg-primary text-white">
                            <div class="card-body">
                                <?php
                                    if ($like['comment'] != '')
                                    {
                                ?>
                                    <span><?=$like['first_name']?> commented "<?=$like['comment']?>" on your <a class="text-dark" href="showRecipe.php?id=<?=$like['id']?>"> <?=$like['title']?></a> recipe</span>
                                <?php
                                    } else { 
                                ?>
                                    <span><?=$like['first_name']?> liked your <a class="text-dark" href="showRecipe.php?id=<?=$like['id']?>"> <?=$like['title']?></a> recipe</span>
                                <?php
                                    }
                                ?>
                                <form action="notifications.php" method="post" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?= $like['notification_id'] ?>"/>
                                    <input type="submit" class="btn btn-warning" name="markAsViewedNotification" value="Mark as Viewed"/>
                                </form>
                                <form action="notifications.php" method="post" style="display:inline-block;">
                                    <input type="hidden" name="id" value="<?= $like['notification_id'] ?>"/>
                                    <input type="submit" class="btn btn-danger" name="removeNotification" value="Hide"/>
                                </form>
                            </div> 
                        </div>
            <?php
                }
                } } else {
            ?>
            <!-- error handelling -->
            <div class="alert alert-danger">
                <strong>Error!</strong> You need to log in first, in order to view your notifications!
            </div>
            <?php
                }
            ?>
        </div>
        <footer class="page-footer font-small ">
            <?php include 'footer.php'?>
        </footer>
    </body>
</html>
