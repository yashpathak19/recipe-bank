<?php

	if(isset($_POST['deleteNewsletter'])){
		$id = $_POST['id'];
		
		require_once "database/database.php";
		require_once "Newsletter.php";
		
		
		$dbcon = Database::getDb();
		$n = new Newsletter();
		
		$letterdata = $n->getNewsletter($dbcon, $id);
		
		$subject = $letterdata[0]['subject'];
		$body = $letterdata[0]['body'];
			
	}

	if(isset($_POST['deleteletter'])){
		$id = $_POST['nid'];
		require_once "database/databasedatabase.php";
		require_once "Newsletter.php";
		
		$dbcon = Database::getDb();
		$n = new Newsletter();
		$count = $n->deleteNewsletter($dbcon, $id);
		
	
	}
		
?>
<html lang="en">

	<head>
		<title>Delete Newsletter</title>
		
		<meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	</head>

	<body>
		<form method="post">
			<input type="hidden" name="nid" value="<?= $letterdata['id']; ?>"/>
			<div>
				<label>Subject : </label><?= $subject;?>
				
			</div>
			
			<div>
				<label>Body : </label><?= $body;?>
			</div>
			
			<div>
				<button type="submit" class="pure-button pure-button-primary" name="deleteletter">Delete</button>
			</div>
		</form>
		
	</body>
</html>