<?php

    interface websiteInterface {
        public function listUser();
        public function addUser($fname, $lname, $email, $password, $type, $subscription, $notification);
        public function deleteUser($id);
        public function updateUser($id, $fname, $lname, $email, $password, $type, $subscription, $notification);
        public function getUser($id);
    }
?>
