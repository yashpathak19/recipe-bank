<?php

    interface websiteInterface {
        public function listUser();
        public function addUser($fname, $lname, $email, $password, $type);
        public function deleteUser($id);
        public function updateUser($id, $fname, $lname, $email, $password, $type);
        public function getUser($id);
    }
?>
