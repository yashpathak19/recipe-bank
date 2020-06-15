<?php
    require_once 'faqCrud.php';
    $newFaqCatName = $_POST['faqCatName'];
    $faqObj = new faqCrud();
    $count = $faqObj->addFaqCat($newFaqCatName);
    $cat = $faqObj->custom('Select max(FaqCatID) from faqcategories');
?>