<?php
	require_once "database.php";
	require_once "subscriber.php";
	
	$dbcon = Database::getDb();
	
	//$s = new \subscriberoop\Subscriber();
	$s = new Subscriber();
	$subscribers = $s->listSubscriber($dbcon);
	
	if(isset($_POST['deleteSubscriber'])){
		$id = $_POST['id'];

		$dbcon = Database::getDb();
		$s = new Subscriber();
		$count = $s->deleteSubscriber($dbcon, $id);

	}

?>
<html lang="en">
	<head>
		<title>List Subscribers</title>
		
		<meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Home Page</title>
        <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	</head>
	
	<body>
		<h1>Subscribers</h1>
			<table class="table table-dark table-hover">
                <thead>
                    <tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Unsubscribe</th>
                    </tr>
                </thead>
                <tbody>
					<?php 
						foreach($subscribers as $subscriber){ ?>
                    <tr>
						<td><?= $subscriber['first_name']?></td>
						<td><?= $subscriber['last_name']?></td>
						<td><?= $subscriber['email']?></td>
						<td>
							<form method="post">
									<input type="hidden" name="id" value="<?= $subscriber['id'] ?>"/>
									<button type="submit" class="btn-danger" name="deleteSubscriber" style="font-size:24px" id="deleteButton"><i class="fa fa-trash-o"></i></button>
							</form>
						</td>
                    </tr>	
				</tbody>
				<?php } ?>

	</body>
</html>