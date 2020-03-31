<?php
require_once 'websiteCRUD.php';
if(isset($_POST['id'])){
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
