<?php
	require_once 'database.php';
	require_once 'subscriber.php';
	require_once 'traits/valtrait.php';

	if(isset($_POST['subscribebtn'])) {
	$email_id = $_POST['useremail'];
	$msg = "Please enter email id";

	require_once 'validation.php';

	//checking that user dont leave any field empty.
	$obj = new subscriberTrait();
	$result = $obj->validateContent($email_id);
	
	if($result != true){
		$email_id = $_POST['useremail'];
		$dbcon = Database::getDb();
		$s = new Subscriber();
		$subscribers = $s->addSubscriber($dbcon, $email_id);
		
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
			<h4>Get&nbsp;<span class="display-4"> Latest Recipies </span>right into your inbox</h4>
			<input class="form-control btn-sm mr-sm-2" type="email" name="useremail" placeholder="enter your email address" aria-label="Search">
		   <button class="btn btn-md btn-outline-success my-2 my-sm-0" name="subscribebtn" id="subscribebtn" type="submit">Subscribe</button>
		</form>
	</footer>
</html>


