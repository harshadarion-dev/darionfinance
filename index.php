<?php
// -------------------------------------
// MAIN ROUTER FOR DARION FINANCE
// -------------------------------------

session_start();

// AUTOLOAD CONTROLLERS, MODELS, CONFIG
spl_autoload_register(function ($class_name) {
    $paths = [
        "controllers/$class_name.php",
        "models/$class_name.php",
        "config/$class_name.php"
    ];

    foreach ($paths as $path) {
        $file = __DIR__ . "/" . $path;
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});


// -------------------------------------
// PROCESS POST ACTIONS
// -------------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $action = $_POST["action"] ?? "";

    switch ($action) {

        // ------------ AUTHENTICATION ------------
        case "register":
            (new AuthController())->register();
            break;

        case "login":
            (new AuthController())->login();
            break;

        case "admin_login":
            (new AuthController())->adminLogin();
            break;

        case "logout":
            (new AuthController())->logout();
            break;

        // ------------ USER LOAN PROCESS ------------
        case "apply_loan":
            (new LoanController())->apply();
            break;

        case "upload_documents":
            (new DocumentController())->upload();
            break;

        // ------------ ADMIN ACTIONS ------------
        case "update_status":
            (new AdminController())->updateStatus();
            break;

        case "mark_sanction":
            (new AdminController())->markSanctioned();
            break;

        // ------------ COMMISSION PAYMENT ------------
        case "commission_start":
            (new PaymentController())->start();
            break;

        // ------------ ADMIN MANUAL MAIL SEND ------------
        case "send_manual_mail":
            (new AdminController())->sendMailManual();
            break;

        // ------------ GOOGLE OAUTH ------------
        case "google_login":
            (new AuthController())->googleRedirect();
            break;

        default:
            echo "<h3>Unknown POST action: $action</h3>";
            exit;

       case "send_support":
        (new SupportController())->sendSupport();
        break;

        case 'admin_chart_data':
        $controller = new AdminController();
        $period = $_GET['period'] ?? 'monthly';
        $data = $controller->getChartData($period);
        header('Content-Type: application/json');
        echo json_encode([
            'labels' => array_column($data, 'label'),
            'values' => array_column($data, 'value')
        ]);
        exit;
   
    }
}
// -------------------------------------
// PAGE ROUTER — GET REQUESTS
// -------------------------------------

$page = $_GET["page"] ?? "home";

switch ($page) {

    // ---------------- PUBLIC PAGES ----------------
    case "home":
        include "views/user/home.php";
        break;

    case "register":
        include "views/user/register.php";
        break;

    case "login":
        include "views/user/login.php";
        break;

    case "about":
        include "views/user/about.php";
        break;

    case "personal_loan":
        include "views/user/personal_loan.php";
        break;

    case "business_loan":
        include "views/user/business_loan.php";
        break;

    case "loan_assistant":
        include "views/user/loan_assistant.php";
        break;

    case "two_wheeler_loan":
        include "views/user/two_wheeler_loan.php";
        break;

    case "footer":
        include "views/user/footer.php";
        break;

    case "required_documents":
        include "views/user/required_documents.php";
        break;

    case "help_center":
        include "views/user/help_center.php";
        break;

    case "contact_support":
        include "views/user/contact_support.php";
        break;

    case "loan_documents_info":
        include "views/user/loan_documents_info.php";
        break;



    // ---------------- USER PAGES ----------------
    case "dashboard":
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "user") {
            header("Location: index.php?page=login");
            exit;
        }
        include "views/user/dashboard.php";
        break;

    case "apply":
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "user") {
            header("Location: index.php?page=login");
            exit;
        }
        include "views/user/apply.php";
        break;

    case "status":
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "user") {
            header("Location: index.php?page=login");
            exit;
        }
        include "views/user/status.php";
        break;

    case "commission_pay":
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "user") {
            header("Location: index.php?page=login");
            exit;
        }
        include "views/user/commission_pay.php";
        break;

    case "payment_success":
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "user") {
            header("Location: index.php?page=login");
            exit;
        }
        (new PaymentController())->success();
        break;


    // ---------------- GOOGLE OAUTH ----------------
    case "google_login":
        (new AuthController())->googleRedirect();
        break;

    case "google_callback":
        (new AuthController())->googleCallback();
        break;


    // ---------------- ADMIN PAGES ----------------
    case "admin_login":
        include "views/admin/login.php";
        break;

    case "admin_dashboard":
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access Denied";
            exit;
        }
        include "views/admin/dashboard.php";
        break;

    case "view_app":
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access Denied";
            exit;
        }
        include "views/admin/view_application.php";
        break;

    case "admin_mail":
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access Denied";
            exit;
        }
        include "views/admin/send_mail.php";
        break;
    
    case "support_messages":
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access Denied";
            exit;
        }
        include "views/admin/support_messages.php";
        break;
    case "admin_users":
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access Denied";
            exit;
        }
        include "views/admin/users.php";
        break;

    
    // ---------------- 404 PAGE ----------------
    default:
        echo "<h2 style='padding:20px;'>404 - Page Not Found</h2>";
}
?>
