<?php
// /models/User.php

require_once __DIR__ . "/../config/db.php";

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    // ---------------------------------------
    // Get user by ID
    // ---------------------------------------
    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute([":id" => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    // ---------------------------------------
    // Get user by email
    // ---------------------------------------
    public function getByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([":email" => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    // ---------------------------------------
    // Create user (regular registration)
    // Accepts array with keys: name, email, phone, password (hashed)
    // ---------------------------------------
    public function create(array $data): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO users (name, email, phone, password, created_at)
            VALUES (:name, :email, :phone, :password, NOW())
        ");

        $stmt->execute([
            ":name" => $data["name"],
            ":email" => $data["email"],
            ":phone" => $data["phone"] ?? null,
            ":password" => $data["password"]
        ]);

        return (int)$this->db->lastInsertId();
    }

    // ---------------------------------------
    // Search users by name / email / phone
    // Returns up to 50 rows
    // ---------------------------------------
    public function search(string $q): array
    {
        $like = '%' . $q . '%';
        $stmt = $this->db->prepare("
            SELECT id, name, email, phone, created_at
            FROM users
            WHERE name LIKE :q OR email LIKE :q OR phone LIKE :q
            ORDER BY created_at DESC
            LIMIT 50
        ");

        $stmt->execute([":q" => $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ---------------------------------------
    // OAuth helpers
    // ---------------------------------------
    public function getByGoogleId(string $googleId): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE google_id = :gid LIMIT 1");
        $stmt->execute([":gid" => $googleId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function attachGoogleId(int $userId, string $googleId): bool
    {
        $stmt = $this->db->prepare("UPDATE users SET google_id = :gid, email_verified = 1 WHERE id = :id");
        return $stmt->execute([":gid" => $googleId, ":id" => $userId]);
    }

    public function createWithGoogle(array $data): int
    {
        $stmt = $this->db->prepare("
            INSERT INTO users (name, email, google_id, avatar, email_verified, created_at)
            VALUES (:name, :email, :gid, :avatar, :email_verified, NOW())
        ");

        $stmt->execute([
            ":name" => $data["name"] ?? null,
            ":email" => $data["email"] ?? null,
            ":gid" => $data["google_id"] ?? null,
            ":avatar" => $data["avatar"] ?? null,
            ":email_verified" => !empty($data["email_verified"]) ? 1 : 0
        ]);

        return (int)$this->db->lastInsertId();
    }
}
