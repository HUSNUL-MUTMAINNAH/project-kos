<?php
class Database {
    private static $conn;

    public static function getConnection() {
        if (!self::$conn) {
            $host = "localhost";
            $db   = "kos";
            $user = "root";
            $pass = "";
            $dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            try {
                self::$conn = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die("Database error: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
