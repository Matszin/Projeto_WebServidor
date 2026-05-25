<?php

class Database {

    public static function connect(): PDO {

        $host   = $_ENV['DB_HOST'] ?? 'localhost';
        $dbname = $_ENV['DB_NAME'] ?? 'eventos';
        $user   = $_ENV['DB_USER'] ?? 'root';
        $pass   = $_ENV['DB_PASS'] ?? '';

        try {

            $pdo = new PDO(
                "mysql:host={$host};dbname={$dbname};charset=utf8",
                $user,
                $pass
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {

            die("Erro no banco: " . $e->getMessage());
        }
    }
}
