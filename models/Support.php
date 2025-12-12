<?php
require_once __DIR__ . "/../config/db.php";

class Support
{
    public function createMessage($name, $email, $message)
    {
        $db = DB::connect();
        $stmt = $db->prepare("
            INSERT INTO support_messages(name, email, message)
            VALUES (:name, :email, :message)
        ");
        return $stmt->execute([
            ":name" => $name,
            ":email" => $email,
            ":message" => $message
        ]);
    }

    public function getAll()
    {
        $db = DB::connect();
        $stmt = $db->query("SELECT * FROM support_messages ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
}
?>
