<?php 

require_once "database/database.php";
require_once "Newsletter.php";

$dbcon = Database::getDb();

//$s = new \subscriberoop\Subscriber();
$subject = $body = "";
// $content = new Content();
// $campaign = new PopularPosts();

if(isset($_POST['deleteNewsletter'])){
		$id = $_POST['id'];
		
		$n = new Newsletter();
		$newsletter = $n->getNewsletter($dbcon, $id);
		
		//var_dump($newsletter);
		$subject = $newsletter[0]['subject'];
		
		//var_dump($subject);
		$body = $newsletter[0]['body'];
}

if(isset($_POST['backtolist'])){
	header('Location:adminpanel.php#section6');
}
//to delete the newsletter
	if(isset($_POST['deleteletter'])){
		$id = $_POST['nid'];
		
		$dbcon = Database::getDb();
		$n = new Newsletter();
		$newsletter = $n->getNewsletter($dbcon, $id);
		
		//var_dump($newsletter);
		$subject = $newsletter[0]['subject'];
		
		//var_dump($subject);
		$body = $newsletter[0]['body'];
		$count = $n->deleteNewsletter($dbcon, $id);
		if($count){
			header("Location: adminpanel.php#section6");
		}
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
	<header>
            <?php include 'header.php'?>
        </header>

		<div class="d-flex justify-content-center" style="margin:2% 0;">
			<form method="post">
				<input type="hidden" name="nid" value="<?= $id; ?>" />
				<div style="margin:4% 0;" class="display-4"><strong><?= $subject;?></strong></div>
				<div style="margin:4% 0;" class="display-5"><?= $body;?></div>
				<div>
					<button type="submit" name="backtolist" class="btn btn-success col-sm-2">Back to List</button>
					<button type="submit" class="btn btn-success" name="deleteletter" id="deleteletter">Delete</button>
				</div>
			</form>
		</div>
		 <footer class="page-footer font-small ">
            <?php include 'footer.php'?>
        </footer>
	</body>
</html>