<?php
require_once 'websiteCRUD.php';
//delete user function
//if the admin is deleting from the list
if(isset($_POST['id']) && !isset($_POST['logout'])){
    $id = $_POST['id'];

    $users = new websiteCRUD();

    $count = $users->deleteUser($id);
    if($count){
        header("Location: adminpanel.php");
    }
    else {
        echo "Unfortunately the user cannot be deleted";
    }
}
//if the user is deleting from their profile
else if (isset($_POST['id']) && isset($_POST['logout'])) {
    $id = $_POST['id'];

    $users = new websiteCRUD();

    $count = $users->deleteUser($id);
    if($count){
        header("Location: feed.php");
    }
    else {
        echo "Unfortunately the user cannot be deleted";
    }
}
