<?php 
	//CRUD for newsletters feature
	// Common steps for crud : 
	// Step : 1 sql to get data from the database 
	// Step : 2 prepare and bind the sql query
	// here The database parses, compiles, and performs query optimization on the SQL statement template, and stores the result without executing it
	// Step : 3 the application binds the values to the parameters, and the database executes the statement
	// The application may execute the statement as many times as it wants with different values
	
	class Newsletter{
		
		//function to list all the newsletters only for the admin
		public function listNewsletters($dbcon){
			
			//Step : 1 sql to get all newsletters 
			$sql = 'SELECT * FROM newsletters';
			
			//Step : 2
			$pdostm = $dbcon->prepare($sql);
			
			//Step : 3
			$pdostm->execute();
			
			//geting data in associative form
			$newsletters = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
			return $newsletters;
		}
		
		//function to send particular newsletter to all subscribers
		public function getNewsletter($dbcon, $id){
			
			//Step : 1
			$sql = 'SELECT * FROM newsletters where id = :id';
			
			//Step : 2
			$pdostm = $dbcon->prepare($sql);
			$pdostm->bindParam(':id',$id);
			
			//Step : 3
			$pdostm->execute();
			$newsletter = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
			return $newsletter;
		}
		
		//function to add new the newsletter only by the admin
		public function addNewsletter($dbcon, $subject, $body){
			
			//Step : 1
			$sql = 'insert into newsletters (subject, body) values (:subject, :body)';

			//Step : 2
			$pdostm = $dbcon->prepare($sql);
			$pdostm->bindParam(':subject', $subject);
			$pdostm->bindParam(':body', $body);
			
			//Step : 3
			$result = $pdostm->execute();
			
			if($result){
				echo "<script>alert('Newsletter Added!')</script>";
			}
			
		}
		
		//function to update the selected newsletter can be done only by the admin
		public function updateNewsletter($dbcon, $id, $subject, $body){
			
			//Step : 1
			$sql = 'update newsletters set subject = :subject, body = :body where id = :id';

			//Step : 2
			$pdostm = $dbcon->prepare($sql);

			$pdostm->bindParam(':id', $id);
			$pdostm->bindParam(':subject', $subject);
			$pdostm->bindParam(':body', $body);
			
			//Step : 3
			$pdostm->execute();
			//echo $sql;
			
			header("Location:adminpanel.php#section6");

		}
		
		//function to delete the newsletter only by the admin.
		public function deleteNewsletter($dbcon, $id){
			
			//Step : 1
			$sql = 'delete from newsletters WHERE id = :id';
			
			//Step : 2
			$pdostm = $dbcon->prepare($sql);
			
			$pdostm->bindParam(':id',$id);
			
			//Step : 3
			$result = $pdostm->execute();
			return $result;
				
			
		}
	}
?>