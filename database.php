<?php
/**
 * Created by PhpStorm.
 * User: E4gleKnight
 * Date: 25/07/2017
 * Time: 11:26
 */

class database
{
    private static $instance;

    private static function getPDO(){
        $dsn = "mysql:host=sql11.freemysqlhosting.net;dbname=sql11186896;charset=utf8";
        $user = "sql11186896";
        $pass = "Us5S8V2wa9";

        return new PDO(
            $dsn,$user,$pass,
            [PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION]
        );
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = self::getPDO();
        }
        return self::$instance;
    }
}