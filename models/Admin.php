<?php
// /models/Admin.php

require_once __DIR__ . "/../config/db.php";

class Admin
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    // -------------------------------------------------------
    // GET ADMIN BY EMAIL
    // -------------------------------------------------------
    public function getByEmail(string $email): ?array
    {
        $query = $this->db->prepare("
            SELECT * FROM admins
            WHERE email = :email
            LIMIT 1
        ");

        $query->execute([":email" => $email]);
        $admin = $query->fetch(PDO::FETCH_ASSOC);

        return $admin ?: null;
    }

    // -------------------------------------------------------
    // GET ADMIN BY ID
    // -------------------------------------------------------
    public function getById(int $id): ?array
    {
        $query = $this->db->prepare("
            SELECT * FROM admins
            WHERE id = :id
            LIMIT 1
        ");

        $query->execute([":id" => $id]);
        $admin = $query->fetch(PDO::FETCH_ASSOC);

        return $admin ?: null;
    }

    // -------------------------------------------------------
    // CREATE ADMIN ACCOUNT
    // -------------------------------------------------------
    public function create(array $data): int
    {
        $query = $this->db->prepare("
            INSERT INTO admins (name, email, password)
            VALUES (:name, :email, :password)
        ");

        $query->execute([
            ":name"     => $data["name"],
            ":email"    => $data["email"],
            ":password" => $data["password"]
        ]);

        return (int)$this->db->lastInsertId();
    }

    // -------------------------------------------------------
    // UPDATE ADMIN PASSWORD
    // -------------------------------------------------------
    public function updatePassword(int $id, string $hashedPassword): bool
    {
        $query = $this->db->prepare("
            UPDATE admins
            SET password = :password
            WHERE id = :id
        ");

        return $query->execute([
            ":password" => $hashedPassword,
            ":id"       => $id
        ]);
    }

    // -------------------------------------------------------
    // CHECK IF ADMIN ALREADY EXISTS BY EMAIL
    // -------------------------------------------------------
    public function exists(string $email): bool
    {
        $query = $this->db->prepare("
            SELECT id FROM admins
            WHERE email = :email
            LIMIT 1
        ");

        $query->execute([":email" => $email]);
        return (bool)$query->fetch();
    }
}
?>
