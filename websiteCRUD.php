<?php 
    require_once "database/database.php";
    require_once "interface/websiteInterface.php";
    require_once "traits/valtrait.php";

    class websiteCRUD implements websiteInterface{
        use Validation;
        //method for listing user
        public function listUser(){
            $dbcon = Database::getDb();
            $sql = "SELECT * FROM users";
            $pdostm = $dbcon->prepare($sql);
            $pdostm->execute();
            return $pdostm->fetchAll(PDO::FETCH_ASSOC);
        }
        //method for adding user
        public function addUser($fname, $lname, $email, $password, $type, $subscription, $notification){
            $dbcon = Database::getDb();
            $sql = "INSERT INTO users (first_name, last_name, email, password, user_role, is_subscribed, mute_notification) 
              VALUES (:fname, :lname, :email, :pwd, :usertype, :is_subscribed, :mute_notification) ";
            $pst = $dbcon->prepare($sql);

            $pst->bindParam(':fname', $fname);
            $pst->bindParam(':lname', $lname);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':pwd', $password);
            $pst->bindParam(':usertype', $type);
            $pst->bindParam(':is_subscribed', $subscription);
            $pst->bindParam(':mute_notification', $notification);
            return $pst->execute();
        }
        //method for updating user
        public function updateUser($id, $fname, $lname, $email, $password, $type, $subscription, $notification){
            $dbcon = Database::getDb();
            $sql = "Update users
                set first_name = :fname,
                last_name = :lname,
                email = :email,
                password = :pwd,
                user_role = :user_type,
                is_subscribed = :is_subscribed,
                mute_notification = :mute_notification
                WHERE id = :id
            ";

            $pst = $dbcon->prepare($sql);

            $pst->bindParam(':fname', $fname);
            $pst->bindParam(':lname', $lname);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':pwd', $password);
            $pst->bindParam(':user_type', $type);
            $pst->bindParam(':is_subscribed', $subscription);
            $pst->bindParam(':mute_notification', $notification);
            $pst->bindParam(':id', $id);

            return $pst->execute();
        }
        //method for delting user
        public function deleteUser($id){
            $dbcon = Database::getDb();
            $sql = "DELETE FROM users WHERE id = :id";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':id', $id);
            return $pst->execute();
        }
        //method to get the user
        public function getUser($id){
            $dbcon = Database::getDb();
            $sql = "SELECT * FROM users WHERE id = :id";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':id', $id);
            $pst->execute();
            return $pst->fetch(PDO::FETCH_OBJ);
        }
        //method to check the user
        public function checkUser($email, $password){
            $dbcon = Database::getDb();
            $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':password', $password);
            $pst->execute();
            return $pst->fetch(PDO::FETCH_OBJ);
        }
        //method to update like
        public function updateLike($recipe_id, $sender_user_id, $type){
            $dbcon = Database::getDb();
            $sql = "SELECT * FROM notifications WHERE recipe_id = :recipe_id AND sender_user_id = :user_id";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':recipe_id', $recipe_id);
            $pst->bindParam(':user_id', $sender_user_id);
            $pst->execute();
            $result = $pst->fetch(PDO::FETCH_OBJ);
            if ($result){
                $sql = "DELETE FROM notifications WHERE id = :id";
                $pst = $dbcon->prepare($sql);
                $pst->bindParam(':id', $result->id);
                return $pst->execute();
            }
            else {
                $sql = "INSERT INTO notifications (status, recipe_id, sender_user_id, type, notification_date) 
                VALUES (:status, :recipe_id, :sender_user_id, :type, :notification_date)";
              
                $pst = $dbcon->prepare($sql);
                $current_time = date('Y-m-d H:i:s');
                $status = "new";
                $type = 1;
                $pst->bindParam(':status', $status);
                $pst->bindParam(':recipe_id', $recipe_id);
                $pst->bindParam(':sender_user_id', $sender_user_id);
                $pst->bindParam(':type', $type);
                $pst->bindParam(':notification_date', $current_time);
                return $pst->execute();
            }
        }
        //method to check the like
        public function checkLike($recipe_id, $user_id){
            $dbcon = Database::getDb();
            $sql = "SELECT * FROM notifications WHERE recipe_id = :recipe_id AND sender_user_id = :user_id AND type = 1";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':recipe_id', $recipe_id);
            $pst->bindParam(':user_id', $user_id);
            $pst->execute();
            if ($pst->fetch(PDO::FETCH_OBJ)){
                return true;
            }
            else {
                return false;
            }
        }
        //method to get the total number of likes
        public function getTotalLikes($recipe_id){
            $dbcon = Database::getDb();
            $sql = "SELECT count(id) as total_like FROM notifications WHERE recipe_id = :recipe_id AND type = 1";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':recipe_id', $recipe_id);
            $pst->execute();
            $count = $pst->fetch(PDO::FETCH_OBJ);
            if ($count){
                return $count->total_like;
            }
            else {
                return "";
            }
        }
        //method to get total notifications
        public function getTotalNotifications($user_id){
            $dbcon = Database::getDb();
            $sql = "SELECT count(notifications.id) as total_notifications FROM notifications
                    inner join recipes on recipes.id = notifications.recipe_id 
                    inner join users on users.id = recipes.user_id 
                    WHERE recipes.user_id = :user_id AND status in ('new', '') 
                    AND recipes.user_id != notifications.sender_user_id";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':user_id', $user_id->id);
            $pst->execute();
            $count = $pst->fetch(PDO::FETCH_OBJ);
            if ($count){
                return $count->total_notifications;
            }
            else {
                return "";
            }
        }
        //method to get notifications
        public function getLikes($user_id){
            $dbcon = Database::getDb();
            $sql = "SELECT notifications.id as notification_id, notifications.notification_date 
                    as notification_date, notifications.sender_user_id as user_id, 
                    users.first_name as first_name, recipes.* , notifications.comment_desc as comment, notifications.status as status
                    FROM notifications
                    inner join recipes on recipes.id = notifications.recipe_id
                    inner join users on users.id = notifications.sender_user_id
                    WHERE recipes.user_id = :user_id AND status in ('new', 'opened', '') 
                    AND recipes.user_id != notifications.sender_user_id";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':user_id', $user_id->id);
            $pst->execute();
            return $pst->fetchAll(PDO::FETCH_ASSOC);
        }

        //method to hide notification
        public function hideNotification($id, $status="hidden"){
            $dbcon = Database::getDb();
            $sql = "update notifications set status = :status WHERE id = :id";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':id', $id);
            $pst->bindParam(':status', $status);
            return $pst->execute();
        }
        //method to get new notifiationS
        public function getnewNotifications($user_id){
            $dbcon = Database::getDb();
            $sql = "SELECT notifications.id as notification_id, notifications.notification_date 
                    as notification_date, notifications.sender_user_id as user_id, 
                    users.first_name as first_name, recipes.* , notifications.comment_desc as comment, notifications.status as status
                    FROM notifications
                    inner join recipes on recipes.id = notifications.recipe_id
                    inner join users on users.id = notifications.sender_user_id
                    WHERE recipes.user_id = :user_id AND status in ('new', '') 
                    AND recipes.user_id != notifications.sender_user_id";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':user_id', $user_id->id);
            $pst->execute();
            return $pst->fetchAll(PDO::FETCH_ASSOC);
        }
        //method to get every notification
        public function getAllNotifications(){
            $dbcon = Database::getDb();
            $sql = "SELECT notifications.id as notification_id, notifications.notification_date 
                    as notification_date, notifications.sender_user_id as user_id, 
                    users.first_name as first_name, recipes.* , notifications.comment_desc as comment, notifications.status as status
                    FROM notifications
                    inner join recipes on recipes.id = notifications.recipe_id
                    inner join users on users.id = notifications.sender_user_id
                    WHERE status in ('new', 'opened', '') 
                    AND recipes.user_id != notifications.sender_user_id";
            $pst = $dbcon->prepare($sql);
            $pst->execute();
            return $pst->fetchAll(PDO::FETCH_ASSOC);
        }


    }
?>
