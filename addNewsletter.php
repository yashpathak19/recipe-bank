<?php
require_once 'Newsletter.php';
require_once 'database/database.php';
$subjecterr = $bodyerr = "";
$subject = $body = "";
if(isset($_POST['addletter'])) {
	
	//validating the subject input
   if(empty($_POST['subject'])){
        $subjecterr =  "Please enter the subject.";
    }
	else{
		$subject = $_POST['subject'];
	}
	
	//validating body
	if(empty($_POST['body'])){
        $bodyerr =  "Please enter the recipe.";
    }
	else{
		$body = $_POST['body'];
	}
    
	if($subjecterr == "" && $bodyerr == ""){
		$dbcon = Database::getDb();

		$n = new Newsletter();
		
		$count = $n->addNewsletter($dbcon, $subject, $body);
	}
	
	
	}


if(isset($_POST['backtolist'])){
	header('Location:adminpanel.php#section6');
}
?>
<html lang="en">
<head>
		<title>Add Newsletter</title>
		
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
        <div class="justify-content-center" id="newLetterForm">
            <form action="" method="post" >
			<fieldset>
				<legend class="d-flex justify-content-center">Add Newsletter</legend>
					<div class="form-group d-flex justify-content-center">
						<label for="subject" class="col-sm-1 col-form-label">Subject</label>
						<div class="col-sm-5">
							<input type="text" class="form-control"  name="subject" id="subject" value="" placeholder="Enter Subject">
							<span id="subjecterr txt-danger"><?php echo $subjecterr?></span>
						</div>
						
					</div>

					<div class="form-group d-flex justify-content-center">
						<label for="body" class="col-sm-1 col-form-label">Body</label>
						<div class="col-sm-5">
							<textarea type="text" name="body" class="form-control" id="body" value="" placeholder="Enter Text"></textarea>
							<span id="bodyerr"><?php echo $bodyerr?></span>
						</div>
					</div>
					<div class="d-flex justify-content-center">
						<button type="submit" name="backtolist" class="btn btn-success col-sm-1">Back</button>
						<button type="submit" name="addletter" class="btn btn-success col-sm-1">Add</button>
					</div>
					<div>
						<?php $message; ?>
					</div>
				</fieldset>
            </form>
        </div>
		<footer class="page-footer font-small ">
			<?php include 'footer.php'?>
		</footer>
    </body>
</html>
