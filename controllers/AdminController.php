<?php
// /controllers/AdminController.php

require_once __DIR__ . "/../config/auth.php";
require_once __DIR__ . "/../models/Loan.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../config/mailer.php";

class AdminController {

    // ============================================================
    // ADMIN DASHBOARD
    // ============================================================
    public function dashboard()
    {
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access denied.";
            exit;
        }

        $db = DB::connect();
        $result = $db->query("
            SELECT la.*, u.name AS user_name, u.phone, u.email
            FROM loan_applications la
            JOIN users u ON u.id = la.user_id
            ORDER BY la.created_at DESC
        ");

        return $result->fetchAll();
    }

    // ============================================================
    // UPDATE LOAN STATUS + SEND EMAIL ALERT
    // ============================================================
    public function updateStatus()
    {
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access denied.";
            exit;
        }

        $app_id = $_POST["app_id"];
        $status = $_POST["status"];

        $loanModel = new Loan();
        $userModel = new User();
        $mailer    = new Mailer();

        // Get loan + user info
        $application = $loanModel->getById($app_id);
        $user = $userModel->getById($application["user_id"]);
        $email = $user["email"];
        $name  = $user["name"];

        // 1️⃣ Update the loan status in DB
        $loanModel->updateStatus($app_id, $status);

        // 2️⃣ Prepare Email Templates
        $subject = "";
        $body    = "";

        switch ($status) {

            case "under_review":
                $subject = "Your Loan Application is Under Review";
                $body = "
                    <h2>Loan Application Update</h2>
                    <p>Hello <strong>$name</strong>,</p>
                    <p>Your loan application is now under review by Darion Finance.</p>
                    <p>We will notify you when it progresses to the next stage.</p>
                    <br><strong>Darion Finance Team</strong>
                ";
                break;


            case "sent_to_bank":
                $subject = "Your Loan Application Has Been Sent to Bank";
                $body = "
                    <h2>Loan Forwarded to Bank</h2>
                    <p>Hello <strong>$name</strong>,</p>
                    <p>Your loan application has been forwarded to the partnering bank.</p>
                    <p>The bank will now begin its verification and processing.</p>
                    <p>You will receive updates as soon as we get information from the bank.</p>
                    <br><strong>Darion Finance Team</strong>
                ";
                break;


            case "sanctioned":
                $subject = "Your Loan Has Been Sanctioned!";
                $body = "
                    <h2>Congratulations!</h2>
                    <p>Hello <strong>$name</strong>,</p>
                    <p>Your loan application has been <strong>approved and sanctioned</strong>.</p>
                    <p>Please log in to your dashboard for details.</p>
                    <br><strong>Darion Finance Team</strong>
                ";
                break;


            case "rejected":
                $subject = "Loan Application Status - Rejected";
                $body = "
                    <h2>Loan Application Update</h2>
                    <p>Hello <strong>$name</strong>,</p>
                    <p>We are sorry to inform you that your loan application has been rejected.</p>
                    <p>You may apply again or contact support for more details.</p>
                    <br><strong>Darion Finance Team</strong>
                ";
                break;
        }

        // 3️⃣ Send Email Notification (if subject exists)
        if (!empty($subject)) {
            $mailer->sendMail($email, $subject, $body);
        }

        // 4️⃣ Redirect
        $_SESSION["success"] = "Loan status updated & user notified.";
        header("Location: index.php?page=admin_dashboard");
        exit;
    }

    // ============================================================
    // SANCTION LOAN + EMAIL
    // ============================================================
    public function markSanctioned()
    {
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access denied.";
            exit;
        }

        $app_id = $_POST["app_id"];
        $amount = (float)$_POST["sanctioned_amount"];

        $loanModel = new Loan();
        $userModel = new User();
        $mailer    = new Mailer();

        // Update DB
        $loanModel->markSanctioned($app_id, $amount);

        // Fetch user
        $application = $loanModel->getById($app_id);
        $user = $userModel->getById($application["user_id"]);

        // Send email
        $mailer->sendMail(
            $user["email"],
            "Your Loan Has Been Sanctioned",
            "
            <h2>Loan Sanctioned</h2>
            <p>Hello <strong>{$user['name']}</strong>,</p>
            <p>Your loan has been sanctioned for the amount of <strong>₹" . number_format($amount) . "</strong>.</p>
            <p>Next steps will be communicated shortly.</p>
            <br><strong>Darion Finance Team</strong>
            "
        );

        $_SESSION["success"] = "Loan sanctioned & user notified.";
        header("Location: index.php?page=admin_dashboard");
        exit;
    }

    // ============================================================
    // SEND MANUAL EMAIL
    // ============================================================
    public function sendMailManual()
    {
        require_once __DIR__ . "/../models/User.php";
        require_once __DIR__ . "/../config/mailer.php";

        $email = trim($_POST["email"]);
        $subject = trim($_POST["subject"]);
        $message = trim($_POST["message"]);

        if (!$email || !$subject || !$message) {
            $_SESSION["error"] = "All fields are required!";
            header("Location: index.php?page=admin_mail");
            exit;
        }

        $mail = new Mailer();
        $sent = $mail->sendMail($email, $subject, nl2br($message));

        if ($sent) {
            $_SESSION["success"] = "Mail sent successfully to: $email";
        } else {
            $_SESSION["error"] = "Failed to send mail!";
        }

        header("Location: index.php?page=admin_mail");
        exit;
    }

    // ============================================================
    // DASHBOARD STATISTICS
    // ============================================================
    public function dashboardStats()
    {
        $db = DB::connect();

        // 1. Total Users
        $users = $db->query("SELECT COUNT(*) AS total FROM users")->fetch()["total"];

        // 2. Total Applications
        $apps = $db->query("SELECT COUNT(*) AS total FROM loan_applications")->fetch()["total"];

        // 3. Loans by Type
        $loanTypes = $db->query("
            SELECT loan_type, COUNT(*) AS count 
            FROM loan_applications 
            GROUP BY loan_type
        ")->fetchAll();

        // 4. Monthly applications (Last 6 months)
        $monthly = $db->query("
            SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, COUNT(*) AS count
            FROM loan_applications
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
            GROUP BY month
            ORDER BY month ASC
        ")->fetchAll();

        // 5. User growth
        $userGrowth = $db->query("
            SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, COUNT(*) AS count
            FROM users
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
            GROUP BY month
            ORDER BY month ASC
        ")->fetchAll();

        // 6. Status counts
        $status = $db->query("
            SELECT status, COUNT(*) AS count 
            FROM loan_applications 
            GROUP BY status
        ")->fetchAll();

        // 7. Sanctioned applications
        $sanctioned = $db->query("SELECT COUNT(*) as count FROM loan_applications WHERE status = 'sanctioned'")->fetch()["count"];

        // 8. Pending applications
        $pending = $db->query("SELECT COUNT(*) as count FROM loan_applications WHERE status IN ('submitted', 'under_review', 'sent_to_bank')")->fetch()["count"];

        return [
            "total_users" => $users,
            "total_apps" => $apps,
            "loan_types" => $loanTypes,
            "monthly" => $monthly,
            "user_growth" => $userGrowth,
            "status" => $status,
            "sanctioned" => $sanctioned,
            "pending" => $pending
        ];
    }

    // ============================================================
    // GET CHART DATA BY PERIOD
    // ============================================================
    public function getChartData($period)
    {
        $db = DB::connect();
        
        switch($period) {
            case 'daily':
                // Get today's hourly data
                $data = $db->query("
                    SELECT 
                        DATE_FORMAT(created_at, '%h %p') as hour,
                        COUNT(*) as count
                    FROM loan_applications 
                    WHERE DATE(created_at) = CURDATE()
                    GROUP BY HOUR(created_at)
                    ORDER BY HOUR(created_at)
                ")->fetchAll();
                
                // Fill missing hours with 0
                $hourlyData = [];
                for($i = 0; $i < 24; $i++) {
                    $hour = date('h A', mktime($i, 0, 0));
                    $found = false;
                    foreach($data as $row) {
                        if($row['hour'] == $hour) {
                            $hourlyData[] = [
                                'label' => $hour,
                                'value' => $row['count']
                            ];
                            $found = true;
                            break;
                        }
                    }
                    if(!$found) {
                        $hourlyData[] = [
                            'label' => $hour,
                            'value' => 0
                        ];
                    }
                }
                return $hourlyData;
                
            case 'weekly':
                // Get last 7 days data
                $data = $db->query("
                    SELECT 
                        DATE(created_at) as date,
                        DAYNAME(created_at) as day_name,
                        COUNT(*) as count
                    FROM loan_applications 
                    WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                    GROUP BY DATE(created_at)
                    ORDER BY date ASC
                ")->fetchAll();
                
                // Fill missing days
                $weeklyData = [];
                for($i = 6; $i >= 0; $i--) {
                    $date = date('Y-m-d', strtotime("-$i days"));
                    $dayName = date('D', strtotime($date));
                    $found = false;
                    foreach($data as $row) {
                        if($row['date'] == $date) {
                            $weeklyData[] = [
                                'label' => $dayName,
                                'value' => $row['count']
                            ];
                            $found = true;
                            break;
                        }
                    }
                    if(!$found) {
                        $weeklyData[] = [
                            'label' => $dayName,
                            'value' => 0
                        ];
                    }
                }
                return $weeklyData;
                
            case 'monthly':
                // Get last 6 months data
                $data = $db->query("
                    SELECT 
                        DATE_FORMAT(created_at, '%b') as month_name,
                        MONTH(created_at) as month_num,
                        YEAR(created_at) as year,
                        COUNT(*) as count
                    FROM loan_applications 
                    WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                    GROUP BY YEAR(created_at), MONTH(created_at)
                    ORDER BY year, month_num
                ")->fetchAll();
                
                return array_map(function($row) {
                    return [
                        'label' => $row['month_name'],
                        'value' => $row['count']
                    ];
                }, $data);
                
            case 'yearly':
                // Get last 5 years data
                $data = $db->query("
                    SELECT 
                        YEAR(created_at) as year,
                        COUNT(*) as count
                    FROM loan_applications 
                    WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 5 YEAR)
                    GROUP BY YEAR(created_at)
                    ORDER BY YEAR(created_at)
                ")->fetchAll();
                
                return array_map(function($row) {
                    return [
                        'label' => $row['year'],
                        'value' => $row['count']
                    ];
                }, $data);
                
            default:
                return [];
        }
    }

    // ============================================================
    // GET ALL USERS
    // ============================================================
    public function getAllUsers()
    {
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access denied.";
            exit;
        }

        $db = DB::connect();
        $result = $db->query("
            SELECT 
                id, 
                name, 
                email, 
                phone,
                created_at,
                (SELECT COUNT(*) FROM loan_applications WHERE user_id = users.id) as total_applications,
                (SELECT COUNT(*) FROM loan_applications WHERE user_id = users.id AND status = 'sanctioned') as sanctioned_applications
            FROM users 
            ORDER BY created_at DESC
        ");

        return $result->fetchAll();
    }

    // ============================================================
    // GET USER DETAILS
    // ============================================================
    public function getUserDetails($userId)
    {
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access denied.";
            exit;
        }

        $db = DB::connect();
        
        // Get user info
        $user = $db->prepare("
            SELECT * FROM users WHERE id = ?
        ");
        $user->execute([$userId]);
        $userData = $user->fetch();
        
        if (!$userData) {
            return null;
        }
        
        // Get user's loan applications
        $applications = $db->prepare("
            SELECT * FROM loan_applications 
            WHERE user_id = ? 
            ORDER BY created_at DESC
        ");
        $applications->execute([$userId]);
        $userData['applications'] = $applications->fetchAll();
        
        return $userData;
    }

    // ============================================================
    // GET SUPPORT MESSAGES
    // ============================================================
    public function getSupportMessages()
    {
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access denied.";
            exit;
        }

        $db = DB::connect();
        $result = $db->query("
            SELECT 
                sm.*,
                u.name as user_name,
                u.email as user_email
            FROM support_messages sm
            LEFT JOIN users u ON u.id = sm.user_id
            ORDER BY sm.created_at DESC
        ");

        return $result->fetchAll();
    }

    // ============================================================
    // UPDATE SUPPORT MESSAGE STATUS
    // ============================================================
    public function updateSupportStatus($messageId, $status)
    {
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access denied.";
            exit;
        }

        $db = DB::connect();
        $stmt = $db->prepare("
            UPDATE support_messages 
            SET status = ?, updated_at = NOW() 
            WHERE id = ?
        ");
        return $stmt->execute([$status, $messageId]);
    }

    // ============================================================
    // REPLY TO SUPPORT MESSAGE
    // ============================================================
    public function replyToSupport($messageId, $replyMessage)
    {
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access denied.";
            exit;
        }

        $db = DB::connect();
        
        // Get support message details
        $stmt = $db->prepare("
            SELECT sm.*, u.email as user_email, u.name as user_name
            FROM support_messages sm
            LEFT JOIN users u ON u.id = sm.user_id
            WHERE sm.id = ?
        ");
        $stmt->execute([$messageId]);
        $supportMessage = $stmt->fetch();
        
        if (!$supportMessage) {
            return false;
        }
        
        // Send email reply
        $mailer = new Mailer();
        $subject = "Re: Your Support Request - " . $supportMessage['subject'];
        $body = "
            <h2>Response to Your Support Request</h2>
            <p>Hello <strong>{$supportMessage['user_name']}</strong>,</p>
            <p>Regarding your message: <em>{$supportMessage['message']}</em></p>
            <div style='background: #f5f5f5; padding: 15px; border-left: 4px solid #2C7446; margin: 15px 0;'>
                <strong>Our Response:</strong><br>
                {$replyMessage}
            </div>
            <p>If you need further assistance, please don't hesitate to contact us again.</p>
            <br><strong>Darion Finance Support Team</strong>
        ";
        
        $mailSent = $mailer->sendMail($supportMessage['user_email'], $subject, $body);
        
        if ($mailSent) {
            // Update support message status
            $updateStmt = $db->prepare("
                UPDATE support_messages 
                SET status = 'replied', 
                    admin_reply = ?,
                    replied_at = NOW(),
                    updated_at = NOW()
                WHERE id = ?
            ");
            return $updateStmt->execute([$replyMessage, $messageId]);
        }
        
        return false;
    }

    // ============================================================
    // EXPORT DATA (CSV)
    // ============================================================
    public function exportData($type, $format = 'csv')
    {
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            echo "Access denied.";
            exit;
        }

        $db = DB::connect();
        
        switch($type) {
            case 'users':
                $result = $db->query("
                    SELECT 
                        id, name, email, phone, created_at
                    FROM users 
                    ORDER BY created_at DESC
                ");
                $filename = "users_export_" . date('Y-m-d') . ".csv";
                $data = $result->fetchAll();
                break;
                
            case 'applications':
                $result = $db->query("
                    SELECT 
                        la.id,
                        u.name as customer_name,
                        u.email,
                        u.phone,
                        la.loan_type,
                        la.requested_amount,
                        la.sanctioned_amount,
                        la.status,
                        la.created_at,
                        la.updated_at
                    FROM loan_applications la
                    JOIN users u ON u.id = la.user_id
                    ORDER BY la.created_at DESC
                ");
                $filename = "applications_export_" . date('Y-m-d') . ".csv";
                $data = $result->fetchAll();
                break;
                
            default:
                return false;
        }
        
        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Add headers
        if (!empty($data)) {
            fputcsv($output, array_keys($data[0]));
            
            // Add data rows
            foreach ($data as $row) {
                fputcsv($output, $row);
            }
        }
        
        fclose($output);
        exit;
    }

    // ============================================================
    // GET RECENT ACTIVITY LOG
    // ============================================================
    public function getRecentActivity($limit = 20)
    {
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            return [];
        }

        $db = DB::connect();
        $stmt = $db->prepare("
            SELECT 
                al.*,
                u.name as user_name
            FROM activity_log al
            LEFT JOIN users u ON u.id = al.user_id
            ORDER BY al.created_at DESC
            LIMIT ?
        ");
        $stmt->execute([$limit]);
        
        return $stmt->fetchAll();
    }

    // ============================================================
    // GET SYSTEM STATS SUMMARY
    // ============================================================
    public function getSystemStats()
    {
        $db = DB::connect();
        
        $stats = $db->query("
            SELECT 
                (SELECT COUNT(*) FROM users) as total_users,
                (SELECT COUNT(*) FROM loan_applications) as total_applications,
                (SELECT COUNT(*) FROM loan_applications WHERE status = 'sanctioned') as sanctioned_loans,
                (SELECT COUNT(*) FROM support_messages WHERE status = 'pending') as pending_support,
                (SELECT COALESCE(SUM(sanctioned_amount), 0) FROM loan_applications WHERE status = 'sanctioned') as total_sanctioned_amount,
                (SELECT COUNT(*) FROM loan_applications WHERE DATE(created_at) = CURDATE()) as today_applications,
                (SELECT COUNT(*) FROM users WHERE DATE(created_at) = CURDATE()) as today_users
        ")->fetch();
        
        return $stats;
    }
}
?>