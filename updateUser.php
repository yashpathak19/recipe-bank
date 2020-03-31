<?php
require_once 'websiteCRUD.php';
$fname = $lname = $email = $type = $pwd = "";

if(isset($_POST['updateUser'])){
    $id= $_POST['id'];
    $websiteCRUD = new websiteCRUD();

    $user = $websiteCRUD->getUser($id);

    $fname =  $user->fname;
    $lname =  $user->lname;
    $email =  $user->email;
    $pwd =  $user->password;
    $type =  $user->type;
}

if(isset($_POST['update'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $type = $_POST['type'];
    $id = $_POST['uid'];

    $websiteCRUD = new websiteCRUD();

    $count = $websiteCRUD->updateUser($id, $fname, $lname, $email, $pwd, $type);

    if($count){
        header("Location: listUsers.php");
    } else {
        echo "Sorry we encountered a problem while updating the user";
    }
}
?>

<html lang="en">

    <head>
        <title>Update User</title>
        <meta name="description" content="Users">
        <meta name="keywords" content="Users">
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
    </head>
    <body>
        <div>
            <form class="pure-form pure-form-aligned" action="" method="post">
                <input type="hidden" name="uid" value="<?= $id; ?>" />
                <div class="pure-control-group">
                    <label for="fname">First Name :</label>
                    <input type="text" name="fname" id="fname" value="<?= $fname; ?>" placeholder="Enter firstname">
                </div>

                <div class="pure-control-group">
                    <label for="lname">Last Name :</label>
                    <input type="text" name="lname" id="lname" value="<?= $lname; ?>" placeholder="Enter lastname">
                </div>

                <div class="pure-control-group">
                    <label for="email">Email :</label>
                    <input type="text" name="email" id="email" value="<?= $email; ?>" placeholder="Enter your email">
                </div>

                <div class="pure-control-group">
                    <label for="password">Password :</label>
                    <input type="password" name="pwd" id="pwd" value="<?= $pwd; ?>" placeholder="Enter your password">
                </div>

                <div class="pure-control-group">
                    <label for="type">User Type</label>
                    <select id="type" name="type" value="<?= $type; ?>">
                        <option>User</option>
                        <option>Admin</option>
                    </select>
                </div>
                <button type="submit" name="update" class="pure-button pure-button-primary">Update</button>
            </form>
        </div>
    </body>
</html>

