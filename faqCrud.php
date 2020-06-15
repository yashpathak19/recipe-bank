<?php
    require "database/database.php";
    class faqCrud{
        public function custom($sql){
            $dbcon = database::getDb();
            $pdostm = $dbcon->prepare($sql);
            $pdostm->execute();
            $results = $pdostm->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        public function list($tableName){
            $dbcon = database::getDb();
            $sql = "select * from $tableName";
            $pdostm = $dbcon->prepare($sql);
            $pdostm->execute();
            $results = $pdostm->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        public function showCatFaqs($id){
            $dbcon = database::getDb();
            $sql = "select * from faqs where FaqCatID=$id";
            $pdostm = $dbcon->prepare($sql);
            $pdostm->execute();
            $results = $pdostm->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        public function showFaq($id){
            $dbcon = database::getDb();
            $sql = "select * from faqs where FaqID=$id";
            $pdostm = $dbcon->prepare($sql);
            $pdostm->execute();
            $results = $pdostm->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }

        public function addFaq($faqQtn, $faqAns, $faqCat){
            $dbcon = database::getDb();
            $sql = "INSERT INTO faqs (FaqQtn, FaqAns, FaqCatID) VALUES (:qtn, :ans, :catId)";
            $pst =   $dbcon->prepare($sql);
            $pst->bindParam(':qtn', $faqQtn);
            $pst->bindParam(':ans', $faqAns);
            $pst->bindParam(':catId',$faqCat);
            $count = $pst->execute();
            return $count;  
        }
        public function updateFaq($id, $faqQtn, $faqAns, $faqCat){
            $dbcon = database::getDb();
            $sql = "UPDATE faqs SET FaqQtn = :qtn, FaqAns = :ans, FaqCatID = :cat WHERE FaqID = :id";
            $pst =   $dbcon->prepare($sql);
            $pst->bindParam(':qtn', $faqQtn);
            $pst->bindParam(':ans', $faqAns);
            $pst->bindParam(':cat', $faqCat);
            $pst->bindParam(':id', $id);
            $count = $pst->execute();
            return $count;
        }
        public function deleteFaq($id){
            $dbcon = database::getDb();
            $sql = "DELETE FROM faqs WHERE FaqID = :id";
            $pst = $dbcon->prepare($sql);
            $pst->bindParam(':id', $id);
            $count = $pst->execute();
            return $count;
        }
        public function addFaqCat($faqCatName){
            $dbcon = database::getDb();
            $sql = "INSERT INTO faqcategories (FaqCatName) VALUES (:catName)";
            $pst =   $dbcon->prepare($sql);
            $pst->bindParam(':catName', $faqCatName);
            $count = $pst->execute();
            return $count;  
        }
    }
?>