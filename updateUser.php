<?php
require_once 'websiteCRUD.php';
session_start();
$user = false;
$error = false;
//getting the logged in user
if(isset($_SESSION['email']) && isset($_SESSION['password'])){
  $websiteCRUD = new websiteCRUD();
  $loggedin_user = $websiteCRUD->checkUser($_SESSION['email'], $_SESSION['password']);
  if (!$loggedin_user){
    $error = "Error! No user found";
  }
}
$emailerr = $passworderr = $fnameerr = $lnameerr  = "";

$fname = $lname = $email = $role = $password = $subscription = $notification = "";

//getting the user details
if(isset($_POST['updateUser'])){
    $id= $_POST['id'];
    $websiteCRUD = new websiteCRUD();

    $user = $websiteCRUD->getUser($id);

    $fname =  $user->first_name;
    $lname =  $user->last_name;
    $email =  $user->email;
    $password =  $user->password;
    $role =  $user->user_role;
    $subscription = $user->is_subscribed;
    $notification = $user->mute_notification;
}
//updating the user
if(isset($_POST['update'])) {
    $error = false;
    $message = "";
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $subscription = $_POST['subscribed'];
    $notification = $_POST['notification'];
    $id = $_POST['uid'];
    $count = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailerr = "Please enter valid email";
    }
    if($password == ""){
        $passworderr =  "Please enter the password";
    }
    if($fname == ""){
        $fnameerr =  "Please enter the firstname";
    }
    if($lname == ""){
        $lnameerr =  "Please enter the lastname";
    }
    if (!$fname || !$lname || !$email || !$password || !$id){
        $error = true;
    }
    else {
        $websiteCRUD = new websiteCRUD();
        $count = $websiteCRUD->updateUser($id, $fname, $lname, $email, $password, $role, $subscription, $notification);
    }
    echo $id, $fname, $lname, $email, $password, $role, $subscription, $notification;
    if($count && !$error){
        header("Location: adminpanel.php");
    } else {
        $message =  "Sorry we encountered a problem while updating the user";
    }
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Update User Form</title>
        <link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    </head>

    <body>
        <header>
            <?php include 'header.php'?>
        </header>
        <!--To do: validation-->
        <!-- bootstrap login card ref: https://codepen.io/amin20/details/ExxaVLa-->
        <div class="container py-5">
          <div class="row">
              <div class="col-md-12">
                  <h2 class="invisible">Update User Form</h2>
                  <div class="row">
                      <div class="col-md-6 mx-auto">
                          <div class="card rounded-0">
                              <div class="card-header">
                                  <h3 class="mb-0">Update User</h3>
                              </div>
                              <div class="card-body">
                                  <form class="form" role="form" autocomplete="off" id="userSignup" novalidate="" method="POST">
                                      <?php
                                            if ($error) {
                                        ?>
                                            <div class="alert alert-danger">
                                                <strong>Error!</strong> Please fill out all fields.
                                                <p><?=$message?></p>
                                            </div>
                                        <?php
                                            }   
                                        ?>
                                      <input type="hidden" name="uid" value="<?= $id; ?>" />
                                      <div class="form-group">
                                          <label for="firstname">Firstname</label>
                                          <input type="text" class="form-control form-control-lg rounded-0" value="<?= $fname; ?>" name="firstname" id="firstname" required>
                                          <span id="fname" class="invalid"><?=$fnameerr?></span>
                                      </div>
                                      <div class="form-group">
                                          <label for="lastname">Lastname</label>
                                          <input type="text" class="form-control form-control-lg rounded-0" value="<?= $lname; ?>" name="lastname" id="lastname" required>
                                          <span id="lname" class="invalid"><?=$lnameerr?></span>
                                      </div>
                                      <div class="form-group">
                                          <label for="email">Email</label>
                                          <input type="text" class="form-control form-control-lg rounded-0" value="<?= $email; ?>" name="email" id="email" required>
                                          <span id="e-mail" class="invalid"><?=$emailerr?></span>
                                      </div>
                                      <div class="form-group">
                                          <label for="password">Password</label>
                                          <input type="password" class="form-control form-control-lg rounded-0" value="<?=$password;?>" name="password" id="password" required>
                                          <span id="pwd" class="invalid"><?=$passworderr?></span>
                                      </div>
                                      <?php
                                            if ($loggedin_user->user_role == 1){
                                      ?>
                                        <div class="form-group">
                                            <label for="role">User Role:</label>
                                            <select class="form-control" name="role" id="role" value="<?= $role; ?>">
                                                <option value="1">Admin</option>
                                                <option value="0">User</option>
                                            </select>
                                        </div>
                                      <?php
                                            }
                                    ?>
                                       <div class="form-group">
                                        <label for="subscribed">Email Subscription?</label>
                                        <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" value="1" class="form-check-input" <?php echo ($subscription == '1') ?  "checked" : "" ;  ?> name="subscribed">Yes
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" value="0" class="form-check-input" <?php echo ($subscription == '0') ?  "checked" : "" ;  ?> name="subscribed">No
                                                </label>
											</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="notification">Notification Muted?</label>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" value="1" class="form-check-input" <?php echo ($notification == '1') ?  "checked" : "" ;  ?> name="notification">Yes
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" value="0" class="form-check-input" <?php echo ($notification == '0') ?  "checked" : "" ;  ?> name="notification">No
                                                </label>
                                            </div>
                                        </div>
                                      <button type="submit" class="btn btn-success btn-lg float-right" name="update" id="update">Update</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>      
              </div>
          </div>
      </div>
        <footer class="page-footer font-small ">
            <?php include 'footer.php'?>
        </footer>
    </body>
</html>

    </body>
</html>

