<?php 
    require_once "database.php";
    require_once "interface/websiteInterface.php";
    require_once "traits/valtrait.php";

    class websiteCRUD implements websiteInterface{
        use Validation;
        public function listUser(){
            $dbcon = Database::getDb();
            $sql = "SELECT * FROM users";
            $pdostm = $dbcon->prepare($sql);
            $pdostm->execute();
            return $pdostm->fetchAll(PDO::FETCH_ASSOC);
        }

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

        public function deleteUser($id){
            $dbcon = Database::getDb();
            $sql = "DELETE FROM users WHERE id = :id";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':id', $id);
            return $pst->execute();
        }

        public function getUser($id){
            $dbcon = Database::getDb();
            $sql = "SELECT * FROM users WHERE id = :id";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':id', $id);
            $pst->execute();
            return $pst->fetch(PDO::FETCH_OBJ);
        }

        public function checkUser($email, $password){
            $dbcon = Database::getDb();
            $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':password', $password);
            $pst->execute();
            return $pst->fetch(PDO::FETCH_OBJ);
        }


    }
?>
