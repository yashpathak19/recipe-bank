<?php

class database{
    //static variables, requirements for connection
    private static $user = 'root';
    private static $password = '';
    private static $dbname = 'recipes';
    private static $dsn = 'mysql:host=localhost;dbname=recipes' ;
    private static $dbcon;
    //constructor for database class
    private function __construct()
    {
    }

    //get pdo connection
    public static function getDb()
    {
        //checks if the connections is first time if it is first time then make connection
        if (!isset(self::$dbcon)) {

            try {
                self::$dbcon = new PDO(self::$dsn, self::$user, self::$password);
            } catch (PDOException $e) {
                $msg = $e->getMessage();
               // include "showerror.php";
                exit();

            }
        }
        return self::$dbcon;
    }


}
