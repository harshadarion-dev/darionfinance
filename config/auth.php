<?php

// REMOVE session_start() from here – index.php already starts session

// Check if user is logged in
function is_logged_in(): bool {
    return isset($_SESSION["user_id"]);
}

// Get current user ID
function current_user_id(): ?int {
    return $_SESSION["user_id"] ?? null;
}

// Require login for a page
function require_login(): void {
    if (!isset($_SESSION["user_id"])) {
        header("Location: index.php?page=login");
        exit;
    }
}

// Logout helper
function logout_user(): void {
    session_unset();
    session_destroy();
    session_start(); // safe to restart here
}

?>
