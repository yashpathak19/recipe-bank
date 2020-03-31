<?php
namespace subscriberoop;
class Subscriber {
	public function listSubscriber($dbcon){
		$sql = 'SELECT * FROM users where is_subscribed = 1';
		$pdostm = $dbcon->prepare($sql);
		$pdostm->execute();
		$subscribers = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
		return $subscribers;
	}
	
	public function addSubscriber($dbcon, $email_id){
		$sql = "Update users
                set is_subscribed = 1
                WHERE email = :email_id ";

		$pst = $dbcon->prepare($sql);

		$pst->bindParam(':email_id', $email_id);
		$pst->execute();
		
		//echo $sql;
		include 'thankyouSubscriber.php';

	}
	
	public function deleteSubscriber($dbcon, $id){
		$sql = "Update users
                set is_subscribed = 0
                WHERE id = :id";
		$pdostm = $dbcon->prepare($sql);
		$pdostm->bindParam(':id',$id);
		$pdostm->execute();
	}
}