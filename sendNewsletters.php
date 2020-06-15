<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//require_once "Campaign.php";
require_once "database/database.php";
require_once "subscriber.php";
require_once "Newsletter.php";
session_start();
$dbcon = Database::getDb();

//$s = new \subscriberoop\Subscriber();
$s = new Subscriber();
$n = new Newsletter();
$subscribers = $s->listSubscriber($dbcon);
$subject = $body = "";
// $content = new Content();
// $campaign = new PopularPosts();

if(isset($_POST['viewNewsletter'])){
		$id = $_POST['id'];
		
		$newsletter = $n->getNewsletter($dbcon, $id);
		
		//var_dump($newsletter);
		$subject = $newsletter[0]['subject'];
		
		//var_dump($subject);
		$body = $newsletter[0]['body'];
}

if(isset($_POST['backtolist'])){
	header('Location:adminpanel.php#section6');
}

if(isset($_POST['sendcampaign'])){
		$id = $_POST['nid'];
		$newsletter = $n->getNewsletter($dbcon, $id);
		
		//var_dump($newsletter);
		
		$subject = $newsletter[0]['subject'];
		
		//var_dump($subject);
		
		$body = $newsletter[0]['body'];
	foreach($subscribers as $useremail){
	//Load Composer's autoloader
		require 'vendor/autoload.php';
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
			//Server settings
		   // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'foodrecipebank';                 // SMTP username
			$mail->Password = 'wad2Project';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;
			// TCP port to connect to
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			//Recipients
			$mail->setFrom('foodrecipebank@gmail.com', 'Recipie Bank');
		
			// Add a recipient
			$addresses = explode(',', $useremail['email']);                
			foreach ($addresses as $address) {
				$mail->addAddress($address);
			}
				
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Recipie Bank Mailing List';
			$mail->Body    = $body;
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			$mail->send();
			
		}
		
		catch (Exception $e) {
			$mail = false;
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	
	}
	
	if($mail)
	{
		echo '<div id="successmsg">
			<!-- Success Alert -->
			<div class="alert alert-success alert-dismissible fade show">
				<strong>Success!</strong> Your message has been sent successfully.
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		</div>';
	}
}
?>
<html lang="en">
	<head>
		<title>Newsletter</title>
		
		<meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	</head>
	
	<body>
	<header class="bg-dark">
            <?php include 'header.php'?>
        </header>

		<div class="d-flex justify-content-center" style="margin:2% 0;">
			<form action="" method="post" >
				<input type="hidden" name="nid" value="<?= $id; ?>" />
				<div style="margin:4% 0;" class="display-4"><strong><?= $subject;?></strong></div>
				<div style="margin:4% 0;" class="display-5"><?= $body;?></div>
				<div>
					<button type="submit" name="backtolist" class="btn btn-success col-sm-2">Back</button>
					<button type="submit" class="btn btn-success" name="sendcampaign" id="sendcampaign">Send to all subscribers</button>
				</div>
			</form>
		</div>
		 <footer class="page-footer font-small ">
            <?php include 'footer.php'?>
        </footer>
	</body>
</html>