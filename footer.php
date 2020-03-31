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
	<head></head>
	<body>
	<form class="form-inline justify-content-center" method="post">
    <h4>Get&nbsp;<span class="display-4"> Latest Recipies </span>right into your inbox</h4>
    <input class="form-control btn-sm mr-sm-2" type="email" name="useremail" placeholder="enter your email address" aria-label="Search">
   <button class="btn btn-md btn-outline-success my-2 my-sm-0" name="subscribebtn" id="subscribebtn" type="submit">Subscribe</button>
</form>
<div class="p-3 bg-dark text-white">
    <!-- Footer Links -->
    <div class="container justify-content-center">

        <!-- Grid row-->
        <div class="row text-center d-flex">

            <!-- Grid column -->
            <div class="col-sm-1">
                <h6>
                    <a class="text-white" href="#">Feed</a>
                </h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-sm-1">
                <h6>
                    <a class="text-white" href="#">About</a>
                </h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-sm-1">
                <h6>
                    <a class="text-white" href="sitemap.php">SiteMap</a>
                </h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-sm-1">
                <h6>
                    <a class="text-white" href="#">FAQ</a>
                </h6>
            </div>

            <!-- Copyright -->
            <div class="page-footer footer-copyright text-right col-sm-8">© 2020 Copyright:
                <a class="text-white" href="https://recipebank.com/"> RecipeBank.com</a>
            </div>
            <!-- Copyright -->
            <!-- Grid column -->
        </div>
        <!-- Grid row-->

    </div>
    <!-- Footer Links -->
</div>
	</body>
</html>
