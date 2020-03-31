<?php

class Database
{
    private static $user = 'root';
    private static $password = '';
    private static $dbname = 'foodblog';
    private static $dsn = 'mysql:host=localhost;dbname=foodblog' ;
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
