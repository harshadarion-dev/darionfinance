<?php
// /config/app.php
// Global application configuration

define("APP_NAME", "Darion Finance");
define("APP_URL", "http://localhost/darionfinance");

// File upload settings
define("UPLOAD_DIR", __DIR__ . "/../uploads/");

// Allowed uploads
$ALLOWED_FILE_TYPES = [
    "image/jpeg",
    "image/png",
    "application/pdf"
];

// Google OAuth

define('GOOGLE_REDIRECT_URI', 'http://localhost/darionfinance/index.php?page=google_callback');

?>
