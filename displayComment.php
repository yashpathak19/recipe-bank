<?php
require_once 'comment.php';
$recipe_id = $_GET['id'];
$recipecmt = new Comment();
$cmts = $recipecmt->showRecipeComment($recipe_id);
$responseText = "";
foreach($cmts as $cmt){
    $responseText .= "<div>". $cmt['comment_desc'] ." 
                <form action='UpdateComment.php' method='post'>
                <input type='hidden' name='id' value=" . $cmt['id'] . ">
                  <input type='submit' name='UpdateComment' value='Edit'>
                </form>
                <form action='DeleteComment.php' method='post'>
                <input type='hidden' name='id' value=" . $cmt['id'] . ">
                  <input type='submit' name='DeleteComment' value='Remove'>
                </form>
                
                </div>";
}
echo $responseText;
?>
