<?php
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    echo "Access Denied";
    exit;
}

require_once __DIR__ . "/../../models/Loan.php";
require_once __DIR__ . "/../../models/Document.php";
require_once __DIR__ . "/../../models/User.php";
require_once __DIR__ . "/../../config/mailer.php";

$loanModel = new Loan();
$docModel  = new Document();
$userModel = new User();
$mailer    = new Mailer();

$app_id = $_GET["app_id"] ?? 0;
$application = $loanModel->getById($app_id);

if (!$application) {
    echo "<h2 class='text-center mt-20 text-red-600 text-2xl'>Application not found.</h2>";
    exit;
}

// Prevent duplicate emails on refresh (optional but good practice)
// Here we assume email is only sent on first view — you may want to track this in DB in production
$user = $userModel->getById($application["user_id"]);
$documents = $docModel->getDocs($app_id);

// --------------------------
// Email Trigger: Admin opened application
// --------------------------
$mailer->sendMail(
    $user["email"],
    "Your Loan Application is Under Review",
    "
    <h2>Your Application is Being Processed</h2>
    <p>Hello <strong>" . htmlspecialchars($user['name']) . "</strong>,</p>
    <p>Your loan application (ID: {$application['id']}) has been opened by the Darion Finance admin and is under review.</p>
    <p>We will notify you as soon as it moves to the next stage.</p>
    <br>
    <strong>Darion Finance Team</strong>
    "
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Application - Admin</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- DARION DASHBOARD FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- Custom Tailwind Config with Darion Colors -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'darion-bg': '#090c10',
                        'darion-panel': '#161b22',
                        'darion-primary': '#2C7446',
                        'darion-primary-light': '#4a9e86',
                        'darion-slate': '#5e7a7d',
                        'darion-text': '#ffffff',
                        'darion-text-muted': '#8b949e',
                        'darion-gold': '#d4a94e',
                        'darion-red': '#c94646',
                        'darion-glass': 'rgba(22, 27, 34, 0.7)',
                        'darion-border': 'rgba(255, 255, 255, 0.1)',
                    },
                    borderRadius: {
                        'darion-lg': '16px',
                        'darion-sm': '8px',
                    },
                    backdropBlur: {
                        'darion': '10px',
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS for Darion Effects -->
    <style>
        /* Darion Background Effects */
        .darion-bg-effect {
            background-color: #090c10;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(44, 116, 70, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(94, 122, 125, 0.1) 0%, transparent 40%);
            min-height: 100vh;
        }

        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(22, 27, 34, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Logo Stipple Effect */
        .logo-stipple {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: radial-gradient(circle, #fff 20%, transparent 21%), #161b22;
            background-size: 3px 3px;
            border: 1px solid rgba(255,255,255,0.3);
        }

        /* Sidebar active state */
        .sidebar-active {
            background: linear-gradient(90deg, rgba(44, 116, 70, 0.2) 0%, transparent 100%);
            color: #4a9e86;
            border-left: 2px solid #2C7446;
        }

        /* Input field styling */
        .darion-input {
            background: rgba(22, 27, 34, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .darion-input:focus {
            outline: none;
            border-color: rgba(74, 158, 134, 0.5);
            box-shadow: 0 0 0 2px rgba(74, 158, 134, 0.2);
        }

        /* Status badge styling */
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
    </style>
</head>

<body class="darion-bg-effect text-darion-text font-inter flex">

<!-- SIDEBAR -->
<div class="w-64 bg-darion-panel/90 backdrop-blur-darion h-screen fixed left-0 top-0 border-r border-darion-border">
    <!-- Sidebar Header -->
    <div class="p-6 border-b border-darion-border">
        <div class="flex items-center gap-3">
            <div class="logo-stipple"></div>
            <div>
                <a href="index.php?page=admin_dashboard" class="text-2xl font-light tracking-tight">Darion Finance</a>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="mt-6 px-4">
        <nav class="space-y-1">
            <form action="index.php?page=logout" method="POST" class="mt-8 pt-8 border-t border-darion-border">
                <input type="hidden" name="action" value="logout">
                <button type="submit" 
                        class="flex items-center gap-3 w-full px-4 py-3 rounded-darion-sm hover:bg-red-900/20 hover:text-red-300 text-darion-text-muted transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </button>
            </form>
        </nav>
    </div>
</div>

<div class="ml-64 w-full p-10">

    <!-- Page Header -->
    <div class="mb-10">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-light mb-2">
                    Application #<?= (int)$application["id"] ?>
                </h1>
                <p class="text-darion-text-muted">Review and manage this loan application</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="glass-card px-4 py-2 rounded-darion-sm">
                    <span class="text-darion-text-muted text-sm">Status:</span>
                    <span class="ml-2 font-medium">
                        <?= htmlspecialchars(ucfirst(str_replace("_", " ", $application["status"]))) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Applicant Info -->
<div class="glass-card shadow-xl rounded-darion-lg p-8 mb-8 border border-darion-border">
    <h2 class="text-xl font-medium mb-6 flex items-center gap-3">
        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        Applicant Information
    </h2>
    <div class="grid md:grid-cols-2 gap-6">
        <div class="space-y-3">
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">Name</p>
                    <p class="font-medium"><?= htmlspecialchars($application["full_name"] ?? $user["name"]) ?></p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">Email</p>
                    <p class="font-medium"><?= htmlspecialchars($application["email"] ?? $user["email"]) ?></p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">Date of Birth</p>
                    <p class="font-medium"><?= htmlspecialchars($application["dob"] ?? "N/A") ?></p>
                </div>
            </div>
        </div>
        <div class="space-y-3">
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">Phone</p>
                    <p class="font-medium"><?= htmlspecialchars($application["phone"] ?? $user["phone"]) ?></p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">User ID</p>
                    <p class="font-medium"><?= (int)$user["id"] ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loan Details -->
<div class="glass-card shadow-xl rounded-darion-lg p-8 mb-8 border border-darion-border">
    <h2 class="text-xl font-medium mb-6 flex items-center gap-3">
        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        Loan Details
    </h2>
    <div class="grid md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">Loan Type</p>
                    <p class="font-medium"><?= htmlspecialchars($application["loan_type"]) ?></p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">Requested Amount</p>
                    <p class="font-medium">₹<?= number_format($application["requested_amount"] ?? $application["amount"]) ?></p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">Tenure</p>
                    <p class="font-medium"><?= htmlspecialchars($application["tenure"] ?? "N/A") ?> Months</p>
                </div>
            </div>
        </div>
        <div class="space-y-4">
            <?php if (!empty($application["business_name"])): ?>
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">Business Name</p>
                    <p class="font-medium"><?= htmlspecialchars($application["business_name"]) ?></p>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($application["purpose"])): ?>
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">Loan Purpose</p>
                    <p class="font-medium"><?= htmlspecialchars($application["purpose"]) ?></p>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($application["sanctioned_amount"])): ?>
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">Sanctioned Amount</p>
                    <p class="font-medium text-darion-primary-light">₹<?= number_format($application["sanctioned_amount"]) ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Loan Type Specific Details -->
    <?php 
    $loanSpecificFields = [
        'purpose' => 'Loan Purpose',
        'salary_account' => 'Salary Account Bank',
        'business_name' => 'Business Name',
        'udyam_number' => 'Udyam Registration Number',
        'gst_number' => 'GST Number',
        'business_age' => 'Business Age (Years)',
        'institute_name' => 'Educational Institute',
        'course_name' => 'Course Name',
        'course_duration' => 'Course Duration (Months)',
        'student_id' => 'Student ID Number',
        'vehicle_brand' => 'Vehicle Brand',
        'vehicle_model' => 'Vehicle Model',
        'vehicle_number' => 'Vehicle Number',
        'vehicle_type' => 'Vehicle Type',
        'previous_loan_number' => 'Previous Loan Reference',
        'previous_lender' => 'Previous Lender',
        'previous_loan_amount' => 'Previous Loan Amount',
        'repayment_history' => 'Repayment History',
        'property_type' => 'Property Type',
        'property_address' => 'Property Address',
        'property_value' => 'Property Value',
        'property_ownership' => 'Property Ownership'
    ];
    
    $hasSpecificFields = false;
    foreach ($loanSpecificFields as $field => $label) {
        if (!empty($application[$field]) && $application[$field] !== 'N/A') {
            $hasSpecificFields = true;
            break;
        }
    }
    ?>
    
    <?php if ($hasSpecificFields): ?>
    <div class="mt-8 pt-6 border-t border-darion-border">
        <h3 class="text-lg font-medium mb-4">Loan Specific Details</h3>
        <div class="grid md:grid-cols-2 gap-4">
            <?php foreach ($loanSpecificFields as $field => $label): ?>
                <?php if (!empty($application[$field]) && $application[$field] !== 'N/A'): ?>
                <div class="flex items-start gap-3">
                    <svg class="w-4 h-4 text-darion-text-muted mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-darion-text-muted text-sm"><?= $label ?></p>
                        <p class="font-medium">
                            <?php 
                            if (strpos($field, 'amount') !== false || strpos($field, 'value') !== false) {
                                echo '₹' . number_format($application[$field]);
                            } elseif ($field === 'property_value') {
                                echo '₹' . number_format($application[$field]);
                            } else {
                                echo htmlspecialchars($application[$field]);
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Employment Details -->
<div class="glass-card shadow-xl rounded-darion-lg p-8 mb-8 border border-darion-border">
    <h2 class="text-xl font-medium mb-6 flex items-center gap-3">
        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
        Employment Details
    </h2>
    <div class="grid md:grid-cols-2 gap-6">
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">Employment Type</p>
                    <p class="font-medium"><?= htmlspecialchars($application["employment_type"] ?? "N/A") ?></p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">Monthly Income</p>
                    <p class="font-medium">₹<?= number_format($application["monthly_income"] ?? 0) ?></p>
                </div>
            </div>
        </div>
        <div class="space-y-4">
            <?php if (!empty($application["company_name"])): ?>
            <div class="flex items-center gap-3">
                <svg class="w-4 h-4 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <div>
                    <p class="text-darion-text-muted text-sm">Company/Business Name</p>
                    <p class="font-medium"><?= htmlspecialchars($application["company_name"]) ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Two Column Layout for Actions -->
<div class="grid md:grid-cols-2 gap-8 mb-8">

    <!-- Update Status -->
    <div class="glass-card shadow-xl rounded-darion-lg p-8 border border-darion-border">
        <h2 class="text-xl font-medium mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Update Status
        </h2>
        <form action="index.php?page=admin_update_status" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="update_status">
            <input type="hidden" name="app_id" value="<?= (int)$application["id"] ?>">

            <select name="status" required 
                    class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50">
                <option value="submitted" <?= ($application["status"] ?? '') == 'submitted' ? 'selected' : '' ?>>Submitted</option>
                <option value="documents_verified" <?= ($application["status"] ?? '') == 'documents_verified' ? 'selected' : '' ?>>Documents Verified</option>
                <option value="missing_documents" <?= ($application["status"] ?? '') == 'missing_documents' ? 'selected' : '' ?>>Missing Documents</option>
                <option value="processing" <?= ($application["status"] ?? '') == 'processing' ? 'selected' : '' ?>>Processing</option>
                <option value="sent_to_ruloans" <?= ($application["status"] ?? '') == 'sent_to_ruloans' ? 'selected' : '' ?>>Sent to Ruloans</option>
                <option value="sent_to_bank" <?= ($application["status"] ?? '') == 'sent_to_bank' ? 'selected' : '' ?>>Sent to Bank</option>
                <option value="sanctioned" <?= ($application["status"] ?? '') == 'sanctioned' ? 'selected' : '' ?>>Sanctioned</option>
                <option value="rejected" <?= ($application["status"] ?? '') == 'rejected' ? 'selected' : '' ?>>Rejected</option>
            </select>

            <div class="space-y-3">
                <label class="font-medium text-darion-text-muted">Update Notes (Optional)</label>
                <textarea name="admin_notes" 
                          class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50"
                          rows="3"
                          placeholder="Add any notes or comments about this status update..."></textarea>
            </div>

            <button class="w-full bg-darion-primary text-white py-3 rounded-darion-sm font-medium hover:bg-darion-primary-light transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Update Status
            </button>
        </form>
    </div>

    <!-- Sanction Loan -->
    <div class="glass-card shadow-xl rounded-darion-lg p-8 border border-darion-border">
        <h2 class="text-xl font-medium mb-6 flex items-center gap-3">
            <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Sanction Loan
        </h2>
        <form action="index.php?page=mark_sanctioned" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="mark_sanction">
            <input type="hidden" name="app_id" value="<?= (int)$application["id"] ?>">

            <div class="relative">
                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-darion-text-muted">₹</span>
                <input type="number" name="sanctioned_amount" required 
                       placeholder="Enter sanctioned amount"
                       min="1" 
                       value="<?= $application['requested_amount'] ?? $application['amount'] ?? '' ?>"
                       class="w-full pl-10 pr-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50">
            </div>

            <div class="space-y-3">
                <label class="font-medium text-darion-text-muted">Sanction Notes (Optional)</label>
                <textarea name="sanction_notes" 
                          class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50"
                          rows="3"
                          placeholder="Add any notes about the sanction..."></textarea>
            </div>

            <button class="w-full bg-green-700 text-white py-3 rounded-darion-sm font-medium hover:bg-green-600 transition-colors flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                Sanction Loan
            </button>
        </form>
    </div>

</div>

<!-- Documents -->
<div class="glass-card shadow-xl rounded-darion-lg p-8 border border-darion-border">
    <h2 class="text-xl font-medium mb-6 flex items-center gap-3">
        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        Uploaded Documents
    </h2>

    <?php if (empty($documents)): ?>
        <div class="text-center py-8">
            <div class="w-16 h-16 bg-darion-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <p class="text-darion-text-muted">No documents uploaded yet.</p>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-darion-primary to-darion-primary-light">
                        <th class="py-4 px-6 text-left font-medium">Document Type</th>
                        <th class="py-4 px-6 text-left font-medium">Status</th>
                        <th class="py-4 px-6 text-left font-medium">Upload Date</th>
                        <th class="py-4 px-6 text-left font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-darion-border/30">
                    <?php foreach ($documents as $d): ?>
                        <?php
                        $documentTypes = [
                            'aadhaar' => 'Aadhaar Card',
                            'pan' => 'PAN Card',
                            'bankstmt' => 'Bank Statement',
                            'address_proof' => 'Address Proof',
                            'udyam_certificate' => 'Udyam Certificate',
                            'gst_certificate' => 'GST Certificate',
                            'business_license' => 'Business License',
                            'itr_3years' => 'ITR 3 Years',
                            'admission_letter' => 'Admission Letter',
                            'fee_structure' => 'Fee Structure',
                            'marksheets' => 'Marksheets',
                            'vehicle_quotation' => 'Vehicle Quotation',
                            'rc_copy' => 'RC Copy',
                            'insurance_copy' => 'Insurance Copy',
                            'previous_loan_statement' => 'Previous Loan Statement',
                            'repayment_track' => 'Repayment Track',
                            'noc_previous_lender' => 'NOC from Previous Lender',
                            'property_papers' => 'Property Papers',
                            'property_tax_receipt' => 'Property Tax Receipt',
                            'navigational_map' => 'Navigational Map',
                            'valuation_report' => 'Valuation Report'
                        ];
                        
                        $displayName = $documentTypes[$d["doc_type"]] ?? ucfirst(str_replace("_", " ", $d["doc_type"]));
                        ?>
                        <tr class="hover:bg-darion-glass/30 transition-colors">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-darion-primary/10 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <?= htmlspecialchars($displayName) ?>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <?php
                                $statusColor = 'text-green-500';
                                $statusText = 'Verified';
                                if (strpos(strtolower($d["file_path"]), 'pending') !== false) {
                                    $statusColor = 'text-yellow-500';
                                    $statusText = 'Pending';
                                } elseif (strpos(strtolower($d["file_path"]), 'rejected') !== false) {
                                    $statusColor = 'text-red-500';
                                    $statusText = 'Rejected';
                                }
                                ?>
                                <span class="px-3 py-1 rounded-full text-xs font-medium <?= $statusColor ?> bg-opacity-20 <?= str_replace('text-', 'bg-', $statusColor) ?>">
                                    <?= $statusText ?>
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <p class="text-darion-text-muted text-sm">
                                    <?= !empty($d["uploaded_at"]) ? date('M d, Y', strtotime($d["uploaded_at"])) : 'N/A' ?>
                                </p>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex gap-2">
                                    <a href="<?= htmlspecialchars($d["file_path"]) ?>" target="_blank"
                                       class="inline-flex items-center gap-2 px-3 py-2 glass-card rounded-darion-sm hover:bg-darion-glass hover:text-darion-primary-light transition-colors text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View
                                    </a>
                                    <a href="<?= htmlspecialchars($d["file_path"]) ?>" download
                                       class="inline-flex items-center gap-2 px-3 py-2 glass-card rounded-darion-sm hover:bg-darion-glass hover:text-darion-primary-light transition-colors text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Upload New Document -->
        <div class="mt-8 pt-6 border-t border-darion-border">
            <h3 class="text-lg font-medium mb-4">Upload Additional Document</h3>
            <form action="index.php?page=upload_document" method="POST" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="action" value="upload_document">
                <input type="hidden" name="app_id" value="<?= (int)$application["id"] ?>">
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <label class="font-medium text-darion-text-muted">Document Type</label>
                        <select name="doc_type" required class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50">
                            <option value="" disabled selected>Select document type</option>
                            <?php foreach ($documentTypes as $key => $label): ?>
                                <option value="<?= $key ?>"><?= $label ?></option>
                            <?php endforeach; ?>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="space-y-3">
                        <label class="font-medium text-darion-text-muted">Document File</label>
                        <div class="darion-file-input rounded-darion-sm p-4">
                            <input type="file" name="document" required accept=".pdf,.jpg,.jpeg,.png"
                                   class="w-full text-darion-text-muted file:mr-4 file:py-2 file:px-4 file:rounded-darion-sm file:border-0 file:text-sm file:bg-darion-primary/20 file:text-darion-primary-light hover:file:bg-darion-primary/30">
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="bg-darion-primary text-white px-6 py-3 rounded-darion-sm font-medium hover:bg-darion-primary-light transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Upload Document
                </button>
            </form>
        </div>
    <?php endif; ?>
</div>

<!-- Application History -->
<?php if (!empty($applicationHistory)): ?>
<div class="glass-card shadow-xl rounded-darion-lg p-8 border border-darion-border mt-8">
    <h2 class="text-xl font-medium mb-6 flex items-center gap-3">
        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        Application History
    </h2>
    
    <div class="space-y-4">
        <?php foreach ($applicationHistory as $history): ?>
        <div class="flex items-start gap-4 p-4 glass-card rounded-darion-sm">
            <div class="w-10 h-10 rounded-full bg-darion-primary/10 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-medium"><?= ucfirst(str_replace("_", " ", $history["status"])) ?></p>
                        <?php if (!empty($history["admin_notes"])): ?>
                            <p class="text-darion-text-muted text-sm mt-1"><?= htmlspecialchars($history["admin_notes"]) ?></p>
                        <?php endif; ?>
                    </div>
                    <span class="text-darion-text-muted text-sm"><?= date('M d, Y H:i', strtotime($history["updated_at"])) ?></span>
                </div>
                <?php if (!empty($history["updated_by"])): ?>
                    <p class="text-darion-text-muted text-sm mt-2">Updated by: <?= htmlspecialchars($history["updated_by"]) ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<!-- Notes Section -->
<div class="glass-card shadow-xl rounded-darion-lg p-8 border border-darion-border mt-8">
    <h2 class="text-xl font-medium mb-6 flex items-center gap-3">
        <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
        Admin Notes
    </h2>
    
    <form action="index.php?page=add_note" method="POST" class="space-y-4">
        <input type="hidden" name="action" value="add_note">
        <input type="hidden" name="app_id" value="<?= (int)$application["id"] ?>">
        
        <div class="space-y-3">
            <label class="font-medium text-darion-text-muted">Add Note</label>
            <textarea name="note" required 
                      class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50"
                      rows="4"
                      placeholder="Add your notes here..."></textarea>
        </div>
        
        <div class="flex gap-3">
            <button type="submit" class="bg-darion-primary text-white px-6 py-3 rounded-darion-sm font-medium hover:bg-darion-primary-light transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
                Add Note
            </button>
            
            <button type="button" onclick="printApplication()" class="bg-gray-700 text-white px-6 py-3 rounded-darion-sm font-medium hover:bg-gray-600 transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print Application
            </button>
        </div>
    </form>
    
    <?php if (!empty($notes)): ?>
    <div class="mt-8 space-y-4">
        <h3 class="text-lg font-medium">Previous Notes</h3>
        <?php foreach ($notes as $note): ?>
        <div class="p-4 glass-card rounded-darion-sm">
            <div class="flex justify-between items-start mb-2">
                <p class="font-medium"><?= htmlspecialchars($note["added_by"] ?? "Admin") ?></p>
                <span class="text-darion-text-muted text-sm"><?= date('M d, Y H:i', strtotime($note["created_at"])) ?></span>
            </div>
            <p class="text-darion-text-muted"><?= htmlspecialchars($note["note"]) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<script>
function printApplication() {
    window.print();
}

// Set current status in dropdown
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.querySelector('select[name="status"]');
    const currentStatus = "<?= $application['status'] ?? 'submitted' ?>";
    
    if (statusSelect) {
        statusSelect.value = currentStatus;
    }
});
</script>

</div>

</body>
</html>