<?php
require_once 'database/database.php';
require_once 'comment.php';
if (isset($_POST['id'])) {
$id = $_POST['id'];


$dbcon = Database::getDb();
$c = new Comment();
$count=$c->del($dbcon,$id);
    if ($count) {
    header("Location: feed.php");
    } else {
    echo " problem deleting";
    }
}