<?php

namespace Blog\Models;

Class Model
{

    function getConnectionToDb()
    {
        $dbConfig = parse_ini_file(INI_FILE);
        $dsn = 'mysql:host=%s;dbname=%s';
        $dsn = sprintf($dsn, $dbConfig['DB_HOST'], $dbConfig['DB_NAME']);
        $user = $dbConfig['DB_USER'];
        $pass = $dbConfig['DB_PASS'];
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_SILENT,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ];
        try {
            $cx = new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            die($e->getMessage());
        };

        return $cx;
    }
}