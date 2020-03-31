<?php
require_once 'websiteCRUD.php';
$emailerr = $passworderr = $fnameerr = $lnameerr  = "";

$fname = $lname = $email = $role = $password = $subscription = $notification = "";

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

if(isset($_POST['update'])) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $role = $_POST['role'];
    $subscription = $_POST['subscribed'];
    $notification = $_POST['notications'];
    $id = $_POST['uid'];

    $websiteCRUD = new websiteCRUD();

    $count = $websiteCRUD->updateUser($id, $fname, $lname, $email, $pwd, $role, $subscription, $notification);

    if($count){
        header("Location: adminpanel.php");
    } else {
        echo "Sorry we encountered a problem while updating the user";
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
                                      <input type="hidden" name="uid" value="<?= $id; ?>" />
                                      <div class="form-group">
                                          <label for="firstname">Firstname</label>
                                          <input type="text" class="form-control form-control-lg rounded-0" value="<?= $fname; ?>" name="firstname" id="firstname" required>
                                          <span id="fname" class="invalid"><?=$fnameerr?></span>
                                      </div>
                                      <div class="form-group">
                                          <label for="lastname">Lastname</label>
                                          <input type="text" class="form-control form-control-lg rounded-0" value="<?= $lname; ?>" name="lastname" id="lastname" required>
                                      </div>
                                      <div class="form-group">
                                          <label for="email">Email</label>
                                          <input type="text" class="form-control form-control-lg rounded-0" value="<?= $email; ?>" name="email" id="email" required>
                                      </div>
                                      <div class="form-group">
                                          <label for="password">Password</label>
                                          <input type="password" class="form-control form-control-lg rounded-0" value="<?=$password;?>" name="password" id="password" required>
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

