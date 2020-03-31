<?php
require_once 'websiteCRUD.php';
$websiteCRUD = new websiteCRUD();

$users = $websiteCRUD->listUser();

?>

<html lang="en">
    <head>
        <title>Skay Food Blog</title>
        <meta name="description" content="Users">
        <meta name="keywords" content="Users">
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css" integrity="sha384-oAOxQR6DkCoMliIh8yFnu25d7Eq/PHS21PClpwjOTeU2jRSq11vu66rf90/cZr47" crossorigin="anonymous">
    </head>

    <body>
        <h1>Users</h1>
        <div>
            <table class="pure-table pure-table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Type</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><?= $user['fname'] ?></td>
                            <td><?= $user['lname'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['password'] ?></td>
                            <td><?= $user['type'] ?></td>
                            <td>
                                <form action="updateUser.php" method="post">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>"/>
                                    <input type="submit" class="button-warning pure-button" name="updateUser" value="Update"/>
                                </form>
                            </td>
                            <td>
                                <form action="deleteUser.php" method="post">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>"/>
                                    <input type="submit" class="button-error pure-button" name="deleteUser" value="Delete"/>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="addUser.php" id="btn_addStudent" class="pure-button pure-button-primary">Add user</a>
        </div>
    </body>
</html>
