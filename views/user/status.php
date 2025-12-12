<?php
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php?page=login");
    exit;
}

require_once __DIR__ . "/../../models/Loan.php";
$loan = new Loan();
$applications = $loan->getByUser($_SESSION["user_id"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan Status - Darion Finance</title>

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

        /* Table Styling */
        .table-header {
            background: linear-gradient(135deg, var(--darion-primary) 0%, var(--darion-primary-light) 100%);
        }

        /* Status Badge Styling */
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

<body class="darion-bg-effect text-darion-text font-inter">

<!-- NAVBAR -->
<nav class="flex items-center justify-between px-6 py-4 bg-darion-panel/70 backdrop-blur-darion fixed top-0 left-0 right-0 z-50 border-b border-darion-border">
    <div class="flex items-center gap-3">
        <div class="logo-stipple"></div>
        <a href="index.php?page=dashboard" class="text-2xl font-light tracking-tight">Darion Finance</a>
    </div>

    <div class="hidden md:flex gap-6 font-medium">
        <a href="index.php?page=apply" class="px-4 py-2 rounded-darion-sm hover:bg-darion-glass hover:text-darion-primary-light transition-colors">
            Apply Loan
        </a>
        <a href="index.php?page=status" class="px-4 py-2 rounded-darion-sm bg-darion-glass text-darion-primary-light border-l-2 border-darion-primary">
            Status
        </a>

        <form action="index.php?page=logout" method="POST" class="flex items-center">
            <input type="hidden" name="action" value="logout">
            <button class="px-4 py-2 rounded-darion-sm hover:bg-red-900/20 hover:text-red-300 text-darion-text-muted transition-colors">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="h-20"></div>

<!-- CONTENT -->
<div class="max-w-6xl mx-auto px-4 py-10">

    <!-- Page Header -->
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-12 h-12 bg-darion-primary/20 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-light">Your Loan Applications</h1>
        </div>
        
        <p class="text-darion-text-muted">Track the status of all your loan applications in one place.</p>
    </div>

    <!-- Success/Error Messages -->
    <?php if (!empty($_SESSION["success"])): ?>
        <div class="bg-darion-primary/20 border-l-4 border-darion-primary-light text-darion-primary-light p-4 rounded-darion-sm mb-6">
            <?= $_SESSION["success"]; unset($_SESSION["success"]); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION["error"])): ?>
        <div class="bg-red-900/30 border-l-4 border-darion-red text-red-200 p-4 rounded-darion-sm mb-6">
            <?= $_SESSION["error"]; unset($_SESSION["error"]); ?>
        </div>
    <?php endif; ?>

    <!-- Applications Table -->
    <div class="glass-card shadow-xl rounded-darion-lg overflow-hidden border border-darion-border">

        <?php if (empty($applications)): ?>
            <div class="p-12 text-center">
                <div class="w-16 h-16 bg-darion-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-medium mb-2">No Applications Yet</h3>
                <p class="text-darion-text-muted mb-6">You haven't submitted any loan applications.</p>
                <a href="index.php?page=apply" 
                   class="inline-flex items-center gap-2 bg-darion-primary text-white px-6 py-3 rounded-darion-sm hover:bg-darion-primary-light transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Apply for Loan
                </a>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="table-header">
                            <th class="py-4 px-6 text-left font-medium">Application ID</th>
                            <th class="py-4 px-6 text-left font-medium">Loan Type</th>
                            <th class="py-4 px-6 text-left font-medium">Amount</th>
                            <th class="py-4 px-6 text-left font-medium">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-darion-border/30">
                        <?php foreach ($applications as $app): ?>
                            <tr class="hover:bg-darion-glass/30 transition-colors">

                                <td class="py-4 px-6 font-medium">#<?= $app["id"] ?></td>

                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-darion-primary/10 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <span><?= htmlspecialchars($app["loan_type"]) ?></span>
                                    </div>
                                </td>

                                <td class="py-4 px-6 font-medium">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-darion-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        ₹<?= number_format($app["requested_amount"]) ?>
                                    </div>
                                </td>

                                <td class="py-4 px-6">
                                    <?php
                                    $status = $app["status"];
                                    $statusConfig = [
                                        "submitted" => ["color" => "bg-gray-700 text-gray-300", "icon" => "M9 12h6m-6 4h6"],
                                        "documents_verified" => ["color" => "bg-blue-900/30 text-blue-300", "icon" => "M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"],
                                        "missing_documents" => ["color" => "bg-red-900/30 text-red-300", "icon" => "M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"],
                                        "processing" => ["color" => "bg-yellow-900/30 text-yellow-300", "icon" => "M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"],
                                        "sent_to_ruloans" => ["color" => "bg-indigo-900/30 text-indigo-300", "icon" => "M13 10V3L4 14h7v7l9-11h-7z"],
                                        "sent_to_bank" => ["color" => "bg-purple-900/30 text-purple-300", "icon" => "M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"],
                                        "sanctioned" => ["color" => "bg-darion-primary/30 text-darion-primary-light", "icon" => "M5 13l4 4L19 7"],
                                        "rejected" => ["color" => "bg-red-900/50 text-red-300", "icon" => "M6 18L18 6M6 6l12 12"]
                                    ][$status] ?? ["color" => "bg-gray-700 text-gray-300", "icon" => "M9 12h6m-6 4h6"];
                                    ?>

                                    <div class="status-badge <?= $statusConfig["color"] ?>">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="<?= $statusConfig["icon"] ?>"></path>
                                        </svg>
                                        <?= htmlspecialchars(ucfirst(str_replace("_", " ", $status))) ?>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Status Legend -->
    <div class="glass-card rounded-darion-lg p-6 mt-8 border border-darion-border">
        <h3 class="font-medium mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Status Guide
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-darion-primary-light"></div>
                <span class="text-sm text-darion-text-muted">Sanctioned</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-blue-300"></div>
                <span class="text-sm text-darion-text-muted">Processing</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-yellow-300"></div>
                <span class="text-sm text-darion-text-muted">Under Review</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-red-300"></div>
                <span class="text-sm text-darion-text-muted">Rejected</span>
            </div>
        </div>
    </div>

</div>

<!-- FOOTER -->
<footer class="text-center py-8 text-darion-text-muted text-sm mt-12 border-t border-darion-border/30">
    <div class="flex items-center justify-center gap-3 mb-3">
        <div class="logo-stipple w-5 h-5"></div>
        <span class="font-light">Darion Finance</span>
    </div>
    © <?= date("Y"); ?> Darion Finance — All Rights Reserved.
</footer>

</body>
</html>