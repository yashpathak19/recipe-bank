<?php
require_once 'websiteCRUD.php';
$user = false;
if(isset($_SESSION['email']) && isset($_SESSION['password'])){
  $websiteCRUD = new websiteCRUD();
  $user = $websiteCRUD->checkUser($_SESSION['email'], $_SESSION['password']);
}
if (isset($_POST['signOut'])){
	session_start();
	$_SESSION = [];
	header('Location: login.php');
}
?>


<div class="row">
	<!-- Future Implement overall search for website -->
	<form class="form-inline col-md-5 invisible" id="searchbar">
		<div class="form-group has-search">
			<span class="fa fa-search form-control-feedback"></span>
			<input type="text" class="form-control btn-sm" placeholder="Search">
		</div>
	</form>
	<a class="navbar-brand col-sm-4" href="index.php"><img src="images/logo.png" alt="logo of the recipe bank."></a>
	<!-- if there is no user logged in then prompt login and signup -->
	<?php
		if (!$user) {
	?>
		<div class="col-sm-1 sinlog">
			<a class="btn btn-md btn-outline-success my-2 my-sm-0" href="login.php">Login</a>
		</div>
		<div class="col-sm-0 sinlog">
			<a class="btn btn-md btn-outline-success my-2 my-sm-0" href="signup.php">SignUp</a>
		</div>
	<?php
		} else {
	?>
		<div class="col-sm-0 sinlog">
			<form method="post" action="header.php">
				<span class="text-white"> Hello, <?=$user->first_name?>!&nbsp;</span>
				<input class="btn btn-outline-danger" type="submit" name="signOut" value="Logout">
			</form>
		</div>
	<?php
		}
	?>
		
</div>
<div class="row">
	<nav class="navbar navbar-expand-lg navbar-dark">
	
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarColor01">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="feed.php">Feed <span class="sr-only"></span></a>
				</li>
				
				<?php
					if ($user) {
				?>
					<li class="nav-item">
						<a class="nav-link" href="adminpanel.php">Dashboard</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="notifications.php">Notification <span class="badge badge-danger"><?=$websiteCRUD->getTotalNotifications($user)?></span></a>
					</li>
				<?php
					}
				?>
			</ul>
		</div>
	</nav>
</div>
	<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>