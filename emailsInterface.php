<?php
require_once "Campaign.php";

$content = new Content();
$campaign = new PopularPosts();

$content->subscribersEmail($campaign);

?>