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
$dbcon = Database::getDb();
//displaying the notification for current user
$notifications = $websiteCRUD->getnewNotifications($user);

$jsonprod =  json_encode($notifications);
header('Content-Type: application/json');
echo  $jsonprod;
