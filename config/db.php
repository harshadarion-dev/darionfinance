<?php
// /config/db.php
// Database connection using PDO

declare(strict_types=1);

class DB {
    private static ?PDO $instance = null;

    public static function connect(): PDO {
        if (self::$instance === null) {
            $host = "127.0.0.1";      // XAMPP default
            $dbname = "darion_finance";
            $username = "root";        // XAMPP default
            $password = "";            // XAMPP default (empty)
            $charset = "utf8mb4";

            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                self::$instance = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                die("Database Connection Failed: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
