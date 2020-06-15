<?php

require_once 'websiteCRUD.php';
require_once "database/database.php";
require_once "subscriber.php";
require_once "Newsletter.php";
 require_once 'feedCRUD.php';
 
session_start();
$user = false;
$error = false;

$dbcon = Database::getDb();
//getting the logged in user
if(isset($_SESSION['email']) && isset($_SESSION['password'])){
  $websiteCRUD = new websiteCRUD();
  $user = $websiteCRUD->checkUser($_SESSION['email'], $_SESSION['password']);
	
	//list subscribers
	//calling class of subscriber
	$s = new Subscriber();
	
	//call list subscriber function from the class 
	$subscribers = $s->listSubscriber($dbcon);
	
	//unsubscribe the user from newsletter
	if(isset($_POST['deleteSubscriber'])){
		$id = $_POST['id'];

		$s = new Subscriber();
		
		//deleteSubscriber from the list that is turn subscriber to zero
		$count = $s->deleteSubscriber($dbcon, $id);

	}
	
	//list newsletters
	//calling class of newsletter
	$n = new Newsletter();
	
	//showing list of newsletters that is method of class
	$newsletters = $n->listNewsletters($dbcon);
	
  if (!$user){
    $error = "Error! No user found";
  }
}
    if ($user){
        $feedObj = new FeedCrud();
        $userEmail = $_SESSION['email'];
        $loggedUser = $feedObj->custom("SELECT * FROM users where email= '$userEmail'");
        $userId = $loggedUser[0]['id'];
        $recipes = $feedObj->custom("Select * from recipes where user_id = $userId");
    }
?>



<html lang="en">
<head>
  <title>Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/adminpanel.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body data-spy="scroll" data-target="#myScrollspy" data-offset="20">
	<header>
	  <?php include 'header.php'?>
	</header>
	
	<?php
		if ($user){
	?>
	
    <div class="container-fluid">
    <div class="row">
        <!-- Scrollspy example referenced from https://www.w3schools.com/bootstrap/bootstrap_scrollspy.asp-->
        <nav class="col-sm-3 col-4" id="myScrollspy">
        <ul class="nav nav-pills flex-column" id="scrollspy_menu">
            <?php
            //admin user, display everything
            if ($user->user_role == 1){
            ?>
            <li class="nav-item">
                <a class="nav-link active" href="#section1">All Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#section12">All Users</a>
            </li>
			<li class="nav-item">
                <a class="nav-link active" href="#section5">All Subscribers</a>
            </li>
			<li class="nav-item">
                <a class="nav-link active" href="#section6">All Newsletters</a>
            <li class="nav-item">
                <a class="nav-link active" href="listFaq.php">FAQs</a>
            </li>
            <?php
            } else {
            ?>
            <li class="nav-item">
                <a class="nav-link active" href="#section1">My Posts</a>
            </li>
            <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="#section2">Notifications</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#section3">My Profile</a>
            </li>
            <?php
            if ($user->user_role == 0){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="#section4">Delete My Account</a>
            </li>
            <?php
            }
            ?>
        </ul>
        </nav>
        <div class="col-sm-9 col-8">
        <div id="section1">
            <?php
            if ($user->user_role == 0){
            ?>
                <h1>My Recipes</h1>
            <?php
            } else {
            ?>
                <h1>All Posts</h1>
            <?php
            }
            ?>
             <div class="container">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
							<th>Recipe Title</th>
							<th>Category</th>
							<th>Posted Date</th>
							<th>Update</th>
							<th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($recipes as $r){
                                echo("
                                    <tr>
                                        <td>".$r['title']."</td>
                                        <td>".$r['category']."</td>
                                        <td>".$r['posted_date']."</td>
                                        <td><a href='updateRecipe.php?id=".$r['id']."'><button type='button' class='btn btn-primary'>Update</button></a></td>
                                        <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#delete".$r['id']."'>Delete</button>
                                        </td>
                                    </tr>
                                    <div class='modal fade' id='delete".$r['id']."' tabindex='-1' role='dialog' aria-labelledby='deleterecipe-Title' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                            <h5 class='modal-title' id='deleterecipeTitle'>Delete recipe</h5>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                            </button>
                                            </div>
                                            <div class='modal-body'>
                                            <p class='lead'>Are you sure you want to delete this recipe?</p>
                                            </div>
                                            <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                            <button type='button' class='btn btn-danger' onclick='deleterecipe(".$r['id'].")'>Delete</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>      
                                ");
                            }
                        ?>
                    </tbody>
                </table>
            </div>
		</div>
        <?php
            if ($user->user_role == 1){
        ?>
            <div id="section12"> 
                
                <div class="container table-responsive">
                    <table class="table table-dark table-hover">
                    <h1>Users</h1>
                    <form action="signup.php" method="post">
                        <input type="hidden" name="id" value="<?= $users['id'] ?>"/>
                        <input type="submit" class="btn btn-success" id="adminUserCreate" name="adminUserCreate" value="Add User"/>
                    </form>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Subscription</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($websiteCRUD->listUser() as $users)
                            {
                        ?>
                            <tr>
                                <td><?=$users['first_name']?></td>
                                <td><?=$users['last_name']?></td>
                                <td><?=$users['email']?></td>

                                <td>
                                <?php
                                     if(($users['user_role']) == 1) 
                                     { echo "Admin"; } 
                                     else { echo "User"; }
                            ?>
                                 </td>

                                <td><?php if(($users['is_subscribed']) == 0){echo 'No';} else { echo 'Yes';}?></td>

                                <td>
                                    <form action="updateUser.php" method="post">
                                        <input type="hidden" name="id" value="<?= $users['id'] ?>"/>
                                        <input type="submit" class="btn btn-warning" name="updateUser" value="Update"/>
                                    </form>
                                </td>
                                <td>
                                    <form action="deleteUser.php" method="post">
                                        <input type="hidden" name="id" value="<?= $users['id'] ?>"/>
                                        <input type="submit" class="btn btn-danger" name="deleteUser" value="Delete"/>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
        <?php
            } if($user->user_role == 1){
        ?>     
		<div id="section5">
				
			<div class="container table-responsive">
				<table class="table table-dark table-hover">
					<h1>Subscribers</h1>
					<thead>
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
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
										<button type="submit" class="btn btn-danger" name="deleteSubscriber" id="deleteButton">Unsubscribe</i></button>
									</form>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		
		<div id="section6">
			<div class="container table-responsive">
				
				<form action="addNewsletter.php" method="post">
				<h1>Newsletters</h1>
					<input type="submit" class="btn btn-success" name="addNewsletter" style="margin-bottom:5px;" value="Add Newsletter"/>
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
									<input type="submit" class="btn btn-warning" name="updateNewsletter" value="Update"/>
								</form>
							</td>
							<td>
								<form action="confirmDeleteLetter.php" method="post">
									<input type="hidden" name="id" value="<?= $newsletter['id']; ?>"/>
									<input type="submit" class="btn btn-danger" name="deleteNewsletter" value="Delete"/>
								</form>
							</td>
							<td>
								
								<form action="sendNewsletters.php" method="post">
									<input type="hidden" name="id" value="<?= $newsletter['id']; ?>"/>
									<input type="submit" class="btn btn-info" name="viewNewsletter" value="View"/>
								</form>
							</td>
						</tr>	
					</tbody>
					<?php } ?>
				</table>
				<div id="demo"></div>
			</div>
		</div>
		<?php } ?>
        <div id="section2"> 
            
            <div class="container table-responsive">
                <table class="table table-dark table-hover">
				<h1>Notifications</h1>
                <thead>
                    <tr>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Author</th>
                    <th>Hide</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($websiteCRUD->getAllNotifications() as $like)
                    {
                ?>
                    <tr>
                        <?php
                            if ($like['comment']) {
                        ?>
                            <td><?=$like['first_name']?> commented "<?=$like['comment']?>" your "<?=$like['title']?>" recipe</td>
                        <?php
                            } else {
                        ?>
                            <td><?=$like['first_name']?> liked your "<?=$like['title']?>" recipe</td>
                        <?php
                            }
                        ?>
                        <td><?=$like['notification_date']?></td>
                        <td><?=$like['first_name']?></td>
                        <td>
                            <form action="notifications.php" method="post" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?= $like['notification_id'] ?>"/>
                                <input type="submit" class="btn btn-danger" name="removeNotification" value="Hide"/>
                            </form>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
                </table>
            </div>
        </div>        
            <div id="section3">
                <div class="container">
                    <h2>My Profile</h2>       
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="fname" class="form-control" disabled value="<?=$user->first_name?>" id="fname">
                            <label for="lname">Last Name:</label>
                            <input type="lname" class="form-control" disabled id="lname" value="<?=$user->last_name?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" id="email" disabled value="<?=$user->email?>">
                        </div>
                        <div class="form-group">
                            <label for="subscription">Subscription:</label>
                            <input type="text" class="form-control" disabled 
                                value="<?php if($user->is_subscribed == 1) { echo "Yes";} else { echo "No";}?>" id="subscription">
                        </div>
                        <div class="form-group">
                            <label for="notification">Mute Notification:</label>
                            <input type="text" class="form-control" disabled 
                                value="<?php if($user->mute_notification == 1) { echo "Yes";} else { echo "No";}?>" id="notification">
                        </div>
                        <form action="updateUser.php" method="post">
                            <input type="hidden" name="id" value="<?= $user->id ?>"/>
                            <input type="submit" class="btn btn-warning" name="updateUser" value="Update"/>
                        </form>
                </div>
            </div>
        <div class="container">
            <div id="section4">
                <h2>Delete Account</h2>         
                <p>This will delete your account and log you out?</p>
                <form action="deleteUser.php" method="post">
                    <button type="button" type="submit" name="deleteUser" class="btn btn-danger mb-3">Yes, Delete Everything!</button>
                    <input type="hidden" name="id" value="<?= $users['id'] ?>"/>
                    <input type="hidden" name="logout" value="logout"/>
                </form>
            </div>
        </div>
    </div>
    </div>
<?php
    } else {
?>
        <div class="alert alert-danger mt-3">
            <strong>Error!</strong> You need to log in first, in order to view your Panel!
        </div>
<?php
    }
?>
<footer class="page-footer font-small ">
  <?php include 'footer.php';?>
</footer>
</body>
</html>
