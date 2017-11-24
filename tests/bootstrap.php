<?php

class DB
{
    protected static $pdo;

    public static function pdo()
    {
        if (null === self::$pdo) {
            $pdo = new PDO('mysql:host=127.0.0.1', 'root', 'root');
            $pdo->exec('CREATE DATABASE IF NOT EXISTS test_validation');
            $pdo->exec('USE test_validation');
            $pdo->exec('CREATE TABLE IF NOT EXISTS test ('.
                       'col_1 int not null,'.
                       'col_2 varchar(30) not null,'.
                       'col_3 varchar(30) not null'.
                       ')'
            );
            self::$pdo = $pdo;
        }

        return self::$pdo;
    }

    public static function deleteData()
    {
        self::pdo()->exec('DELETE FROM test');
    }

    public static function insertData()
    {
        self::pdo()->exec('INSERT INTO test VALUES'.
            '(1, "row 1 col 2", "row 1 col 3"),'.
            '(2, "row 2 col 2", "row 2 col 3"),'.
            '(3, "row 3 col 2", "row 3 col 3"),'.
            '(4, "row 4 col 2", "row 4 col 3"),'.
            '(5, "row 5 col 2", "row 5 col 3")'
        );
    }
}

class MyTestCase extends PHPUnit\Framework\TestCase {}
