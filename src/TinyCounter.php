<?php

namespace Ganjaaa;

use \PDO;

class TinyCounter {
    // Database File
    static $dbFile = __DIR__ . '/counter.db';

    /**
     * Install Database
     * 
     * @return PDOStatment
     * @return false
     */
    public static function _install() {
        $pdo = static::getHandler();
        return $pdo->query('CREATE TABLE counter ( `id` VARCHAR(255) NOT NULL,`cnt` INT NULL DEFAULT 0, PRIMARY KEY (`id`));');
    }

    /**
     * Get Value
     * 
     * @param string $ID
     * @return int
     */
    public static function get($ID) {
        $pdo = static::getHandler();
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

    /**
     * Set Value
     * 
     * @param string $ID
     * @param int $VALUE
     * @return int return $VALUE from the DB
     */
    public static function set($ID, $VALUE) {
        $pdo = static::getHandler();
        $pdo->query("INSERT OR IGNORE INTO counter VALUES (" . $pdo->quote($ID) . ", 0);");
        $pdo->query("UPDATE counter SET cnt=" . (int) $VALUE . " WHERE id=" . $pdo->quote($ID));
        return static::get($ID);
    }

    /**
     * Increase value
     * 
     * @param string $ID
     * @return int returns the increased value
     */
    public static function inc($ID) {
        $pdo = static::getHandler();
        $pdo->query("INSERT OR IGNORE INTO counter VALUES (" . $pdo->quote($ID) . ", 0);");
        $pdo->query("UPDATE counter SET cnt=cnt+1 WHERE id=" . $pdo->quote($ID));
        return static::get($ID);
    }

    /**
     * Decreased value
     * 
     * @param string $ID
     * @return int returns the decreased value
     */
    public static function dec($ID) {
        $pdo = static::getHandler();
        $pdo->query("INSERT OR IGNORE INTO counter VALUES (" . $pdo->quote($ID) . ", 0);");
        $pdo->query("UPDATE counter SET cnt=cnt-1 WHERE id=" . $pdo->quote($ID));
        return static::get($ID);
    }

    /**
     * Get PDO Handler
     * 
     * @return PDO
     */
    public static function getHandler() {
        return new PDO('sqlite:' . static::$dbFile);
    }

}
