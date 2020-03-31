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

        public function addUser($fname, $lname, $email, $password, $type){
            $dbcon = Database::getDb();
            $sql = "INSERT INTO users (fname, lname, email, password, type) 
              VALUES (:fname, :lname, :email, :pwd, :usertype) ";
            $pst = $dbcon->prepare($sql);

            $pst->bindParam(':fname', $fname);
            $pst->bindParam(':lname', $lname);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':pwd', $password);
            $pst->bindParam(':usertype', $type);
            return $pst->execute();
        }

        public function updateUser($id, $fname, $lname, $email, $password, $type){
            $dbcon = Database::getDb();
            $sql = "Update users
                set fname = :fname,
                lname = :lname,
                email = :email,
                password = :pwd,
                type = :type
                WHERE id = :id
            ";

            $pst = $dbcon->prepare($sql);

            $pst->bindParam(':fname', $fname);
            $pst->bindParam(':lname', $lname);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':pwd', $password);
            $pst->bindParam(':type', $type);
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


    }
?>
