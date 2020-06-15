<?php
    require_once 'feedCrud.php';
    $recipe_id = $_GET['id'];
    $recipe = new FeedCrud();
    $count = $recipe->deleterecipe($recipe_id);
    echo($count);
?>