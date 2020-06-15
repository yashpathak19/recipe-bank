<?php
    require_once 'feedCrud.php';
    $feedObj = new FeedCrud();
    $sortParam = $_GET['sortparam'];
    $value = $_GET['value'];
    $defaultSql = "select * from recipes";
    
?>