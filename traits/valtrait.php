<?php
    trait Validation{
        public function checkValidation($field){
            if($field == ""){
                return false;
            }
        }
		
		public function validateContent($email_id){
		
		$patternname = "/^[a-zA-Z]*$/";
		//echo 'empty string validation';
		if (!filter_var($email_id, FILTER_VALIDATE_EMAIL)){
			echo "Please enter valid email format";
			return true;
		}
		else{
			return false;
		}
   }
    }
?>