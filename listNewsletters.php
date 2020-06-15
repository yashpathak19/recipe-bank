<?php
	
	require_once "database.php";
	require_once "Newsletter.php";
	
	$dbcon = Database::getDb();
	
	$n = new Newsletter();
	$newsletters = $n->listNewsletters($dbcon);
	
	if(isset($_POST['deleteletter'])){
		$id = $_POST['id'];
		require_once "database.php";
		require_once "Newsletter.php";
		
		$dbcon = Database::getDb();
		$n = new Newsletter();
		$count = $n->deleteNewsletter($dbcon, $id);
		
	}

?>
<html lang="en">
	<head>
		<title>List Newsletters</title>
		
		<meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Home Page</title>
        <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	</head>
	
	<body>
		<h1>Newsletters</h1>
		<form action="addNewsletter.php" method="post">
			<input type="submit" class="button-warning" name="addNewsletter" value="Add Newsletter"/>
		</form>
			<table class="table table-dark table-hover">
                <thead>
                    <tr>
						<th>Subject</th>
						<th>Body</th>
						<th>Action</th>
                    </tr>
                </thead>
                <tbody>
					<?php 
						foreach($newsletters as $newsletter){ ?>
                    <tr>
						<td><?= $newsletter['subject'];?></td>
						<td><?= $newsletter['body'];?></td>
						<td>
							<form action="updateNewsletter.php" method="post">
								<input type="hidden" name="id" value="<?= $newsletter['id']; ?>"/>
								<input type="submit" class="button-warning" name="updateNewsletter" value="Update"/>
							</form>
						</td>
						<td>
							<form action="" method="post">
								<input type="hidden" name="id" value="<?= $newsletter['id']; ?>"/>
								<input type="submit" class="button-error" name="deleteletter" value="Delete"/>
							</form>
						</td>
						<td>
							
							<form action="sendNewsletters.php" method="post">
								<input type="hidden" name="id" value="<?= $newsletter['id']; ?>"/>
								<input type="submit" class="button-error" name="viewNewsletter" value="View"/>
							</form>
						</td>
                    </tr>	
				</tbody>
				<?php } ?>

	</body>
</html>