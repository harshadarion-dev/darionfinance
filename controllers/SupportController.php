<?php

require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../config/mailer.php";

class SupportController {

    public function sendSupport()
    {
        // Ensure user logged in
        if (!isset($_SESSION["user_id"])) {
            $_SESSION["error"] = "Please login to send a message.";
            header("Location: index.php?page=login");
            exit;
        }

        $user_id = $_SESSION["user_id"]; 
        $name    = trim($_POST["name"] ?? "");
        $email   = trim($_POST["email"] ?? "");
        $msg     = trim($_POST["message"] ?? "");

        if (!$name || !$email || !$msg) {
            $_SESSION["error"] = "Please fill in all fields.";
            header("Location: index.php?page=contact_support");
            exit;
        }

        // Validate user exists in DB
        $db = DB::connect();
        $check = $db->prepare("SELECT id FROM users WHERE id = :id LIMIT 1");
        $check->execute([":id" => $user_id]);
        $userExists = $check->fetch();

        if (!$userExists) {

            // Force logout if session corrupt
            session_destroy();
            session_start();
            $_SESSION["error"] = "Session invalid. Please login again.";
            header("Location: index.php?page=login");
            exit;
        }

        // Insert support message
        $query = $db->prepare("
            INSERT INTO support_messages (user_id, name, email, message)
            VALUES (:uid, :name, :email, :message)
        ");

        $query->execute([
            ":uid"     => $user_id,
            ":name"    => $name,
            ":email"   => $email,
            ":message" => $msg
        ]);

        $_SESSION["success"] = "Your message has been sent!";
        header("Location: index.php?page=contact_support");
        exit;
    }
}
?>
