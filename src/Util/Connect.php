<?php

namespace Dipoengoro\GudangBase\Util;

use PDO;

class Connect
{

    static function getConnection(): PDO
    {
        $host = "localhost";
        $port = "3306";
        $database = "gudang";
        $username = "root";
        $password = "Koplolo00--";
        $dsn = "mysql:host=$host;port=$port;dbname=$database";

        return new PDO(
            dsn: $dsn,
            username: $username,
            password: $password
        );
    }
}
