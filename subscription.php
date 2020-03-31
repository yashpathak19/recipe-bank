<html>
	<head>
		<meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Home Page</title>
        <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		
	</head>
	<body>
	<header class="bg-dark">
		<?php include 'header.php'?>
	</header>

	<form class="form-inline justify-content-center" method="post" action="thankyouSubscriber.php">
		<h4>Get&nbsp;<span class="display-4"> Latest Recipies </span>right into your inbox</h4>
		<input class="form-control btn-sm mr-sm-2" type="email" placeholder="enter your email address" aria-label="Search">
	   <button class="btn btn-md btn-outline-success my-2 my-sm-0" name="subscribebtn" id="subscribebtn" type="submit">Subscribe</button>
	</form>
	
	<footer class="page-footer font-small ">
		<?php include 'footer.php'?>
	</footer>
	<body>
</html>


