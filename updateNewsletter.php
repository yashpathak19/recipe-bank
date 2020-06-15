<?php
	
	$subject = $body = "";
	
	if(isset($_POST['updateNewsletter'])){
		$id = $_POST['id'];
		
		require_once "database/database.php";
		require_once "Newsletter.php";
		
		$dbcon = Database::getDb();
		$n = new Newsletter();
		$newsletter = $n->getNewsletter($dbcon, $id);
		
		//var_dump($newsletter);
		
		$subject = $newsletter[0]['subject'];
		
		//var_dump($subject);
		
		$body = $newsletter[0]['body'];
		

	}
	
	if(isset($_POST['updateletter'])){
		
		$subject = $_POST['subjectn'];
		$body = $_POST['bodyn'];
		$id = $_POST['nid'];
		
		require_once "database/database.php";
		require_once "Newsletter.php";
		
		$dbcon = Database::getDb();
		$n = new Newsletter();
		$count = $n->updateNewsletter($dbcon, $id, $subject, $body);

	}
	
	if(isset($_POST['backtolist'])){
		header('Location:adminpanel.php');
	}
	
?>
<html lang="en">
	<head>
		<title>Update Newsletter</title>
		
		<meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	</head>
	
	<body>
		<header>
			<?php include 'header.php'?>
		</header>
		<div class="justify-content-center" id="updateLetterForm">
            <form class="pure-form pure-form-aligned" action="" method="post">
				<fieldset>
					<legend class="d-flex justify-content-center">Update Newsletter</legend>
					<input type="hidden" name="nid" value="<?= $id; ?>" >
					<div class="form-group d-flex justify-content-center">
						<label for="subject" class="col-sm-1 col-form-label">Subject</label>
						<div class="col-sm-5">
							<input type="text" class="form-control"  name="subjectn" id="subject" value="<?= $subject;?>" placeholder="Enter Subject">
						</div>
					</div>
					<div class="form-group d-flex justify-content-center">
						<label for="body" class="col-sm-1 col-form-label">Body</label>
						<div class="col-sm-5">
							<textarea type="text" class="form-control"  name="bodyn" id="body" placeholder="Enter Text"><?= $body;?></textarea>
						</div>
					</div>
					<div class="d-flex justify-content-center">
						<button type="submit" name="backtolist" class="btn btn-success col-sm-1">Back</button>
						<button type="submit" name="updateletter" class="btn btn-success col-sm-1">Update</button>
					</div>
				</fieldset>
            </form>
        </div>
		<footer class="page-footer font-small ">
			<?php include 'footer.php'?>
		</footer>
	</body>
</html>