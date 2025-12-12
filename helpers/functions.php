<?php
// helpers/functions.php
declare(strict_types=1);

session_start();

function e(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): void {
    header("Location: $url");
    exit;
}

function is_logged_in(): bool {
    return isset($_SESSION['user_id']);
}

function current_user_id(): ?int {
    return $_SESSION['user_id'] ?? null;
}

function require_login(): void {
    if (!is_logged_in()) {
        redirect('/index.php?page=login');
    }
}
