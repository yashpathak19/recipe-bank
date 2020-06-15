<?php

require_once 'websiteCRUD.php';
require_once 'database/database.php';
require_once 'subscriber.php';
require_once 'traits/valtrait.php';

$signed_user = false;

if(isset($_POST['newSubscription'])){
	//checking if the user is logged in 
	if(isset($_SESSION['email']) && isset($_SESSION['password'])){
		
		$websiteCRUD = new websiteCRUD();
		$signed_user = $websiteCRUD->checkUser($_SESSION['email'], $_SESSION['password']);

		$dbcon = Database::getDb();
		$s = new Subscriber();
		$subscribers = $s->addSubscriber($dbcon, $signed_user->email);	
		
		if($signed_user->is_subscribed == 1){
			echo "<script>alert('You are alreay subscribed!')</script>";
		}
		else{
			$subscribers = $s->addSubscriber($dbcon, $signed_user->email);	
			echo "<script>alert('Thank You for subscribing, Please check your email for further details.')</script>";
		}
		
	}
	
	else{
		echo "<script>alert('Please first log in.')</script>";
	}
	
}
	
?>

<html>
	<head>
		<meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		
	</head>
	<footer>
		<form class="form-inline justify-content-center" method="post">
			<h4>Get&nbsp;<span class="display-4"> Latest Recipies </span>right into your inbox&nbsp;&nbsp;</h4>
		   <button class="btn btn-md my-2 my-sm-0" name="newSubscription" id="newSubscription" type="submit">Subscribe</button>
		</form>
	</footer>
</html>


