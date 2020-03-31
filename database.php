<?php

class Database
{
    private static $user = 'root';
    private static $password = '';
    private static $dbname = 'foodrecipienetwork';
    private static $dsn = 'mysql:host=localhost;dbname=foodrecipienetwork' ;
    private static $dbcon;

    private function __construct()
    {
    }

    //get pdo connection
    public static function getDb()
    {
        if (!isset(self::$dbcon)) {

            try {
                self::$dbcon = new PDO(self::$dsn, self::$user, self::$password);
            } catch (PDOException $e) {
                $msg = $e->getMessage();
                include "customerror.php";
                exit();

            }
        }
        return self::$dbcon;
    }


}

//Database::getDb();
//class Database
//{
//    private $user = 'root';
//    private $password = '';
//    private $dbname = 'phpclass';
//    private $dsn = 'mysql:host=localhost;dbname=phpclass' ;
//    private $dbcon;
//
//
//    public function getDb(){
//        $this->dbcon = new PDO($this->dsn, $this->user, $this->password);
//        return $this->dbcon;
//    }
//
//
//}

//$db = new Database();
//$dbconn = $db->getDb();
