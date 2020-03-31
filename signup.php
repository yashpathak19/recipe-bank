<?php
require_once 'websiteCRUD.php';
$emailerr = $passworderr = $fnameerr = $lnameerr  = "";
$firstname = $lastname = $password = $email = $subscription = $notification = "";
session_start();
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = $_POST['role'];
    $subscription = $_POST['subscribed'];
    $notification = $_POST['notification'];
    $user = new websiteCRUD();
    $user->addUser($firstname, $lastname, $email, $password, $role, $subscription, $notification);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailerr = "Please enter valid email";
    }
    if($password == ""){
        $passworderr =  "Please enter the password";
    }
    if($firstname == ""){
        $fnameerr =  "Please enter the firstname";
    }
    if($lastname == ""){
        $lnameerr =  "Please enter the lastname";
    }
    if ($user){
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        header("Location: feed.php");
    }
    else {
        echo "problem encountered while creating a user";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Sign Up Form</title>
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
                  <h2 class="invisible">Sign Up Form</h2>
                  <div class="row">
                      <div class="col-md-6 mx-auto">
                          <div class="card rounded-0">
                              <div class="card-header">
                                  <h3 class="mb-0">Sign Up</h3>
                              </div>
                              <div class="card-body">
                                  <form class="form" role="form" autocomplete="off" id="userSignup" novalidate="" method="POST">
                                  <div class="form-group">
                                          <label for="firstname">Firstname</label>
                                          <input type="text" class="form-control form-control-lg rounded-0" value="<?= $firstname; ?>" name="firstname" id="firstname" required>
                                          <span id="fname" class="invalid"><?=$fnameerr?></span>
                                      </div>
                                      <div class="form-group">
                                          <label for="lastname">Lastname</label>
                                          <input type="text" class="form-control form-control-lg rounded-0" value="<?= $lastname; ?>" name="lastname" id="lastname" required>
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
                                      <div class="form-group">
                                        <label for="role">User Role:</label>
                                        <select class="form-control" name="role" id="role" value="<?= $role; ?>">
                                            <option>Admin</option>
                                            <option>User</option>
                                        </select>
                                       </div>
                                       <div class="form-group">
                                        <label for="subscribed">Email Subscription?</label>
                                        <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" value="1" checked class="form-check-input" <?php echo ($subscription == '1') ?  "checked" : "" ;  ?> name="subscribed">Yes
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
                                                    <input type="radio" value="1" checked class="form-check-input" <?php echo ($notification == '1') ?  "checked" : "" ;  ?> name="notification">Yes
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="radio" value="0" class="form-check-input" <?php echo ($notification == '0') ?  "checked" : "" ;  ?> name="notification">No
                                                </label>
                                            </div>
                                        </div>
                                      <button type="submit" class="btn btn-success btn-lg float-right" name="submit" id="submit">Sign Up</button>
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
