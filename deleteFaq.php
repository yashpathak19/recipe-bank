<?php
    require_once 'faqCrud.php';
    $faqId = $_GET['id'];
    $faqObj = new faqCrud();
    $count = $faqObj->deleteFaq($faqId);
    echo($count);
?>