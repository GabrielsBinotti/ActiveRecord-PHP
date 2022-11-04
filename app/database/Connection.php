<?php

namespace App\database;

final class Connection
{
    protected static $pdo;

    private function __construct() {

        $host   = "127.0.0.1";
        $port   = "3306";
        $user   = "";
        $pass   = "";
        $dbname = "";

        $dsn = "mysql:host={$host};dbname={$dbname};port={$port}";

        try{
            self::$pdo = new \PDO($dsn, $user, $pass);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            //self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC); Retorna no formato de array
            self::$pdo->exec('SET NAMES utf8');

        }catch(\PDOException $e){
            echo $e->getMessage();
        }

    }

    public static function getConnection() {
        
        if(!self::$pdo){
            new Connection();
        }
        return self::$pdo;
    }
}