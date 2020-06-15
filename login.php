<?php

require_once 'websiteCRUD.php';
$emailerr = $passworderr = $email = $password = "";
$user = false;
//getting the logged in user
if(isset($_SESSION['email']) && isset($_SESSION['password'])){
  $websiteCRUD = new websiteCRUD();
  $user = $websiteCRUD->checkUser($_SESSION['email'], $_SESSION['password']);
}
$error = false;
session_start();
//getting the fields
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $websiteCRUD = new websiteCRUD();

    $user = $websiteCRUD->checkUser($email, $password);
    if (!$user){
        $error = true;
    }
    else {
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        header('Location: feed.php');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailerr = "Please enter valid email";
    }
    if($password == ""){
        $passworderr =  "Please enter the type";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
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
        <header>
            <?php include 'header.php'?>
        </header>
        <!--To do: validation-->
        <!-- bootstrap login card ref: https://codepen.io/amin20/details/ExxaVLa-->
        <?php
            if (!$user){
        ?>
            <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="invisible">Login Form</h2>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
                            <div class="card rounded-0">
                                <div class="card-header">
                                    <h3 class="mb-0">Login</h3>
                                </div>
                                <div class="card-body">
                                        <?php 
                                            if ($error == true)
                                            {
                                        ?>
                                                <div class="alert alert-danger">
                                                    <strong>Error!</strong> Invalid Login Credentials.
                                                </div>
                                        <?php
                                            }
                                        ?>
                                    <form class="form" id="userLogin" method="POST">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control form-control-lg rounded-0" value="<?=$email?>" name="email" id="email" required>
                                            <span id="emailerr" class="invalid"><?=$emailerr?></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control form-control-lg rounded-0" value="<?=$password?>" name="password" id="password" required>
                                            <span id="passworderr" class="invalid"><?=$passworderr?></span>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-success btn-lg float-right" id="login">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>      
                </div>
            </div>
            </div>
        <?php
            } else {
        ?>
        <div class="alert alert-warning">
            <strong>Warning!</strong> You are already logged in as "<?=$user->first_name?>" 
            <p>Click on <strong>Logout</strong> button to sign out from your account!.</p>
        </div>
        <?php
            }
        ?>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <footer class="page-footer font-small ">
        <?php include 'footer.php'?>
    </footer>
</html>
