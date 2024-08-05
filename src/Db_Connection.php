<?php
declare(strict_types=1);

namespace Ledz\LoginPHP;

use PDO;

class Db_Connection
{
    protected static ?PDO $_db = null;

    public static function connect()
    {
        if (self::$_db === null) {
            self::$_db = new PDO('sqlite:' . __DIR__ . '/../db/db.sqlite');
        }

        return self::$_db;
    }
}

