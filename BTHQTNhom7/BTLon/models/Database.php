<?php
class Database
{
    public static function connect()
    {
        $host = 'localhost';
        $dbname = 'btlon';
        $username = 'root';
        $password = '';
        return new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    }
}