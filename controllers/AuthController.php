<?php

require_once __DIR__ . "/../config/app.php";   // Google OAuth
require_once __DIR__ . "/../models/User.php";

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // ============================================================
    // Helper: Send POST Request (Used for Google OAuth)
    // ============================================================
    private function httpPost($url, $params)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    // ============================================================
    // Google OAuth – Redirect user to Google
    // ============================================================
    public function googleRedirect()
    {
        $state = bin2hex(random_bytes(16));
        $_SESSION["oauth2state"] = $state;

        $params = [
            "client_id"     => GOOGLE_CLIENT_ID,
            "redirect_uri"  => GOOGLE_REDIRECT_URI,
            "response_type" => "code",
            "scope"         => "openid email profile",
            "state"         => $state,
            "access_type"   => "offline",
            "prompt"        => "select_account"
        ];

        header("Location: https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query($params));
        exit;
    }

    // ============================================================
    // Google OAuth Callback
    // ============================================================
    public function googleCallback()
    {
        if (
            empty($_GET["state"]) ||
            !hash_equals($_SESSION["oauth2state"] ?? "", $_GET["state"])
        ) {
            $_SESSION["error"] = "Invalid OAuth state!";
            unset($_SESSION["oauth2state"]);
            header("Location: index.php?page=login");
            exit;
        }

        if (!isset($_GET["code"])) {
            $_SESSION["error"] = "Google login failed!";
            header("Location: index.php?page=login");
            exit;
        }

        // Exchange code for token
        $tokenData = $this->httpPost("https://oauth2.googleapis.com/token", [
            "code"          => $_GET["code"],
            "client_id"     => GOOGLE_CLIENT_ID,
            "client_secret" => GOOGLE_CLIENT_SECRET,
            "redirect_uri"  => GOOGLE_REDIRECT_URI,
            "grant_type"    => "authorization_code"
        ]);

        if (!isset($tokenData["access_token"])) {
            $_SESSION["error"] = "Failed to verify Google login.";
            header("Location: index.php?page=login");
            exit;
        }

        // Fetch Google user info
        $ch = curl_init("https://www.googleapis.com/oauth2/v3/userinfo");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer " . $tokenData["access_token"]]);
        $googleUser = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if (!$googleUser || empty($googleUser["sub"])) {
            $_SESSION["error"] = "Google data fetch failed.";
            header("Location: index.php?page=login");
            exit;
        }

        // Extract fields
        $googleId  = $googleUser["sub"];
        $email     = $googleUser["email"] ?? null;
        $name      = $googleUser["name"] ?? "Google User";
        $avatar    = $googleUser["picture"] ?? null;
        $verified  = $googleUser["email_verified"] ? 1 : 0;

        // 1️⃣ Check Google ID exists
        $exists = $this->userModel->getByGoogleId($googleId);
        if ($exists) {
            $_SESSION["user_id"] = $exists["id"];
            $_SESSION["user_name"] = $exists["name"];
            $_SESSION["user_email"] = $exists["email"];
            $_SESSION["role"] = "user";
            header("Location: index.php?page=dashboard");
            exit;
        }

        // 2️⃣ Check email exists → attach Google
        if ($email) {
            $byMail = $this->userModel->getByEmail($email);
            if ($byMail) {
                $this->userModel->attachGoogleId($byMail["id"], $googleId);

                $_SESSION["user_id"] = $byMail["id"];
                $_SESSION["user_name"] = $byMail["name"];
                $_SESSION["user_email"] = $byMail["email"];
                $_SESSION["role"] = "user";

                header("Location: index.php?page=dashboard");
                exit;
            }
        }

        // 3️⃣ Create new user
        $newId = $this->userModel->createWithGoogle([
            "name"           => $name,
            "email"          => $email,
            "google_id"      => $googleId,
            "avatar"         => $avatar,
            "email_verified" => $verified
        ]);

        $_SESSION["user_id"] = $newId;
        $_SESSION["user_name"] = $name;
        $_SESSION["user_email"] = $email;
        $_SESSION["role"] = "user";

        header("Location: index.php?page=dashboard");
        exit;
    }

    // ============================================================
    // User Registration
    // ============================================================
    public function register()
    {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $phone = trim($_POST["phone"]);
        $password = $_POST["password"];
        $confirm = $_POST["confirm"];

        if ($password !== $confirm) {
            $_SESSION["error"] = "Passwords do not match!";
            header("Location: index.php?page=register");
            exit;
        }

        if ($this->userModel->getByEmail($email)) {
            $_SESSION["error"] = "Email already exists!";
            header("Location: index.php?page=register");
            exit;
        }

        $hashed = password_hash($password, PASSWORD_BCRYPT);

        $this->userModel->create([
            "name"     => $name,
            "email"    => $email,
            "phone"    => $phone,
            "password" => $hashed
        ]);

        $_SESSION["success"] = "Registration successful!";
        header("Location: index.php?page=login");
        exit;
    }

    // ============================================================
    // USER LOGIN
    // ============================================================
    public function login()
    {
        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        $user = $this->userModel->getByEmail($email);

        if (!$user || !password_verify($password, $user["password"])) {
            $_SESSION["error"] = "Invalid email or password!";
            header("Location: index.php?page=login");
            exit;
        }

        // Store full session
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
        $_SESSION["user_email"] = $user["email"];   // IMPORTANT
        $_SESSION["role"] = "user";

        header("Location: index.php?page=dashboard");
        exit;
    }

    // ============================================================
    // ADMIN LOGIN (USING DATABASE)
    // ============================================================
    public function adminLogin()
    {
        require_once __DIR__ . "/../models/Admin.php";
        $adminModel = new Admin();

        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        $admin = $adminModel->getByEmail($email);

        if (!$admin) {
            $_SESSION["error"] = "Admin not found!";
            header("Location: index.php?page=admin_login");
            exit;
        }

        if (!password_verify($password, $admin["password"])) {
            $_SESSION["error"] = "Incorrect password!";
            header("Location: index.php?page=admin_login");
            exit;
        }

        // SUCCESS
        $_SESSION["role"] = "admin";
        $_SESSION["admin_id"] = $admin["id"];
        $_SESSION["admin_name"] = $admin["name"];

        header("Location: index.php?page=admin_dashboard");
        exit;
    }

    // ============================================================
    // LOGOUT
    // ============================================================
    public function logout()
    {
        session_destroy();
        header("Location: index.php?page=login");
        exit;
    }
}

?>
