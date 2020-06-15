<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['deleteSubscriber'])){
	
	//Load Composer's autoloader
	require 'vendor/autoload.php';
	$usremail = $_POST['useremail'];
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
		$mail->addAddress($usremail, 'Recipe Bank Subscriber');     // Add a recipient

		

		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'UnSubscription Confirmation';
		$mail->Body    = '<div>Sad to see you go.</div><div>I hope you enjoyed your time with us.</div>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		$mail->send();
		
	} 	catch (Exception $e) {
		echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}
}




