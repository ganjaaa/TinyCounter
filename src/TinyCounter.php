<?php
namespace Ganjaaa;
use \PDO;

class TinyCounter {
     static $dbFile = __DIR__ . '/counter.db';

    public static function _install() {
        $pdo = self::getHandler();
        return $pdo->query('CREATE TABLE counter ( `id` VARCHAR(255) NOT NULL,`cnt` INT NULL DEFAULT 0, PRIMARY KEY (`id`));');
    }

    public static function get($ID) {
        $pdo = self::getHandler();
        $query = "SELECT cnt FROM counter WHERE id = " . $pdo->quote($ID);
        $s0 = $pdo->query($query);
        if ($s0 === FALSE) {
            return 0;
        }
        $row = $s0->fetch(PDO::FETCH_ASSOC);
        if (!isset($row['cnt'])) {
            return 0;
        }
        return $row['cnt'];
    }

    public static function set($ID, $VALUE) {
        $pdo = self::getHandler();
        $pdo->query("INSERT OR IGNORE INTO counter VALUES (" . $pdo->quote($ID) . ", 0);");
        $pdo->query("UPDATE counter SET cnt=" . (int) $VALUE . " WHERE id=" . $pdo->quote($ID));
        return self::get($ID);
    }

    public static function inc($ID) {
        $pdo = self::getHandler();
        $pdo->query("INSERT OR IGNORE INTO counter VALUES (" . $pdo->quote($ID) . ", 0);");
        $pdo->query("UPDATE counter SET cnt=cnt+1 WHERE id=" . $pdo->quote($ID));
        return self::get($ID);
    }

    public static function dec($ID) {
        $pdo = self::getHandler();
        $pdo->query("INSERT OR IGNORE INTO counter VALUES (" . $pdo->quote($ID) . ", 0);");
        $pdo->query("UPDATE counter SET cnt=cnt-1 WHERE id=" . $pdo->quote($ID));
        return self::get($ID);
    }

    public static function getHandler() {
        return new PDO('sqlite:' . self::$dbFile);
    }
}
