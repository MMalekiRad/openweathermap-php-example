<?php
/*
* Mr OK
* 5/29/2019
*/


class DbHelper
{

    private static $db_connection = null;

    /**
     * DbHelper constructor.
     * @param $db_type
     * for using postgres set $db_type = postgres
     */
    private function __construct($db_type)
    {
        $host = HOST;
        $username = USERNAME;
        $password = PASSWORD;
        $database = DATABASE;
        $port = PORT;

        switch ($db_type) {
            case 'mysql':
                $dsn = "mysql:host={$host};dbname={$database}";
                break;
            case 'postgres':
                $dsn = "pgsql:host=$host;port=$port;dbname=$database;user=$username;password=$password";
                break;
            default:
                break;
        }
        self::$db_connection = new PDO($dsn, $username, $password);

    }

    private function __clone()
    {
    }

    public static function get_instance($db_type)
    {
        if (is_null(self::$db_connection)) {
            new self($db_type);
        }
        return self::$db_connection;
    }

}