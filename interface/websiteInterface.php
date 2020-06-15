<?php
    // interface file
    interface websiteInterface {
        public function listUser();
        public function addUser($fname, $lname, $email, $password, $type, $subscription, $notification);
        public function deleteUser($id);
        public function updateUser($id, $fname, $lname, $email, $password, $type, $subscription, $notification);
        public function getUser($id);
        public function updateLike($recipe_id, $sender_user_id, $type);
        public function checkLike($recipe_id, $user_id);
        public function getTotalLikes($recipe_id);
        public function getLikes($user_id);
        public function hideNotification($id, $status="hidden");
        public function getTotalNotifications($user_id);
        public function getnewNotifications($user_id);
        public function getAllNotifications();
    }
?>
