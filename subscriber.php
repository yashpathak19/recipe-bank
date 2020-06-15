<?php
//namespace subscriberoop;
class Subscriber {
	public function listSubscriber($dbcon){
		$sql = 'SELECT * FROM users where is_subscribed = 1';
		$pdostm = $dbcon->prepare($sql);
		$pdostm->execute();
		$subscribers = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
		return $subscribers;
	}
	

	public function getNewsletter($dbcon){
		$sql = 'SELECT * FROM newsletters';
		$pdostm = $dbcon->prepare($sql);
		$pdostm->execute();
		$newsletters = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
		return $newsletters;
	}
	

	public function addSubscriber($dbcon, $email_id){
		$sql = "Update users
                set is_subscribed = 1
                WHERE email = :email_id ";

		$pdostm = $dbcon->prepare($sql);

		$pdostm->bindParam(':email_id', $email_id);
		$pdostm->execute();

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
		$result = $pdostm->execute();
		
		if($result){
				echo "<script>alert('User is unsubscribed!');
					</script>";
			}
		
	}
}