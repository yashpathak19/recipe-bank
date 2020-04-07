<?php
require_once 'comment.php';
$recipe_id = $_GET['id'];
$recipecmt = new Comment();
$cmts = $recipecmt->showRecipeComment($recipe_id);
$responseText = "";
foreach($cmts as $cmt){
    $responseText .= "<div>". $cmt['comment_desc'] ."</div>";
}
echo $responseText;
?>
