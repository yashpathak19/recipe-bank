<?php
    trait Validation{
        public function checkValidation($field){
            if($field == ""){
                return false;
            }
        }
    }
?>