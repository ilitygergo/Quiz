<?php

class Database {

    public static $username = 'system';
    public static $password = 'Aladar12';
    public static $host = 'localhost:1522';
    public static $dbname = 'orcl';

    public static function connect() {
        return oci_connect(self::$username, self::$password, self::$host . '/' . self::$dbname);
    }

    public static function query($query) {
        $conn = self::connect();

        $result = oci_parse($conn, $query);

        oci_execute($result);

        return $result;
    }
}