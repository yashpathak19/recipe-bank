<?php

require_once 'database/database.php';
require_once 'comment.php';

$comment_desc = "";
$dbcon = Database::getDb();
if(isset($_POST['UpdateComment'])){
    $id= $_POST['id'];
    $c =new Comment();
    $comment_desc = $c->showupd($dbcon,$id);

}

if(isset($_POST['editcomment']))
{
    $comment_desc = $_POST['comment_desc'];

    $id = $_POST['id'];

    $c = new Comment();
    $count= $c->update($dbcon,$comment_desc,$id);

    if($count){
        header("Location: feed.php");

    } else {
        echo "problem updating a comment";
    }
}
?>
<html lang="en">

    <head>
        <title>Edit</title>

    </head>

    <body>

    <div>

        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $id; ?>" />
            <div class="form-group">
                <label for="comment_desc">Desc :</label>
                <input type="text" class="form-control" name="comment_desc" id="comment_desc" value="<?= $comment_desc; ?>"
                       placeholder="Enter...">
                <span style="color: red">

                </span>
            </div>

            <a href="feed.php" id="btn_back" class="btn btn-success float-left">Back</a>
            <button type="submit" name="editcomment"
                    class="btn btn-primary float-right" id="btn-submit">
              Edit
            </button>
        </form>
    </div>


    </body>
</html>
