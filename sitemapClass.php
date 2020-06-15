<?php 
class sitemapClass{
	public function listPages($dbcon){
		$sql = 'SELECT * FROM menu where is_subscribed = 1';
		$pdostm = $dbcon->prepare($sql);
		$pdostm->execute();
		$subscribers = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
		return $subscribers;
	}
}
?>