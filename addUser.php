<?php
require_once 'websiteCRUD.php';
$fname = "";
$validation_summary = "";
if(isset($_POST['addUser'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $usertype = $_POST['user_type'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $users = new websiteCRUD();
    if ($users->validateField($fname)){
        $count = $users->addUser($fname, $lname, $usertype, $email, $pwd);
        if($count){
            header("Location: listUsers.php");
        } else {
            echo "Sorry we encountered a problem while adding a new user!";
        }
    }
    else {
        $validation_summary = "Please enter all the fields";
    }
    $count = $users->addUser($fname, $lname, $usertype, $email, $pwd);
    
}
?>
<html lang="en">
<head>
    <title>Add a new user - Food Blog</title>
    <meta name="description" content="Users">
    <meta name="keywords" content="Users">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
</head>
    <body>
        <div>
            <form class="pure-form pure-form-aligned" action="" method="post">
                <div class="pure-control-group">
                    <label for="fname">First Name :</label>
                    <input type="text" name="fname" id="fname" value="" placeholder="Enter firstname">
                </div>

                <div class="pure-control-group">
                    <label for="lname">Last Name :</label>
                    <input type="text" name="lname" id="lname" value="" placeholder="Enter lastname">
                </div>

                <div class="pure-control-group">
                    <label for="email">Email :</label>
                    <input type="text" name="email" id="email" value="" placeholder="Enter your email">
                </div>

                <div class="pure-control-group">
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password" value="" placeholder="Enter your password">
                </div>

                <div class="pure-control-group">
                    <label for="user_type">User Type</label>
                    <select id="user_type" name="user_type">
                        <option>User</option>
                        <option>Admin</option>
                    </select>
                </div>

                <button type="submit" name="addUser" class="pure-button pure-button-primary">Add</button>
                <div><?=$validation_summary?></div>
            </form>
        </div>
    </body>
</html>
