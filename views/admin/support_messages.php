<?php
require_once __DIR__ . "/../../models/Support.php";

$model = new Support();
$messages = $model->getAll();

// Ensure $messages is an array
$messages = $messages ?? [];

// Calculate counts
$newCount = count(array_filter($messages, fn($m) => ($m['status'] ?? 'new') === 'new'));
$inProgressCount = count(array_filter($messages, fn($m) => ($m['status'] ?? 'new') === 'in_progress'));
$resolvedCount = count(array_filter($messages, fn($m) => ($m['status'] ?? 'new') === 'resolved'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support Messages - Admin | Darion Finance</title>

    <!-- TAILWIND CSS CDN -->
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
                        'darion-green': '#2C7446',
                        'darion-blue': '#4a7b9e',
                        'darion-glass': 'rgba(22, 27, 34, 0.7)',
                        'darion-border': 'rgba(255, 255, 255, 0.1)',
                    },
                    borderRadius: {
                        'darion-lg': '16px',
                        'darion-sm': '8px',
                    },
                    backdropBlur: {
                        'darion': '10px',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
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
        }

        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(22, 27, 34, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(22, 27, 34, 0.5);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(74, 158, 134, 0.5);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(74, 158, 134, 0.7);
        }

        /* Message Status Badges */
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        /* Priority Indicators */
        .priority-high {
            border-left: 3px solid #c94646;
        }

        .priority-medium {
            border-left: 3px solid #d4a94e;
        }

        .priority-low {
            border-left: 3px solid #4a9e86;
        }
    </style>
</head>

<body class="darion-bg-effect font-inter text-darion-text min-h-screen">
    <!-- Main Container -->
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="glass-card rounded-darion-lg p-6 mb-6 border border-darion-border/50 sticky top-6 z-40">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-semibold">Support Messages</h1>
                        <p class="text-darion-text-muted text-sm">Manage customer inquiries and support tickets</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="index.php?page=admin_dashboard"
                       class="px-4 py-2 glass-card border border-darion-border rounded-darion-sm hover:bg-darion-glass transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                    <button onclick="exportMessages()"
                            class="px-4 py-2 bg-darion-primary text-white rounded-darion-sm hover:bg-darion-primary-light transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Export CSV
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8 animate-fade-in">
            <div class="glass-card rounded-darion-lg p-6 border border-darion-border/30">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-darion-text-muted text-sm mb-1">Total Messages</p>
                        <p class="text-2xl font-semibold"><?= count($messages) ?></p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-darion-glass flex items-center justify-center">
                        <svg class="w-5 h-5 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-darion-lg p-6 border border-green-900/30">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-darion-text-muted text-sm mb-1">New</p>
                        <p class="text-2xl font-semibold text-green-400"><?= $newCount ?></p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-green-900/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-darion-lg p-6 border border-blue-900/30">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-darion-text-muted text-sm mb-1">In Progress</p>
                        <p class="text-2xl font-semibold text-blue-400"><?= $inProgressCount ?></p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-blue-900/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-darion-lg p-6 border border-darion-slate/30">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-darion-text-muted text-sm mb-1">Resolved</p>
                        <p class="text-2xl font-semibold text-darion-slate"><?= $resolvedCount ?></p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-darion-slate/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-darion-slate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="glass-card rounded-darion-lg p-6 mb-6 border border-darion-border/50 animate-slide-up">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="relative flex-1 w-full">
                    <svg class="w-5 h-5 absolute left-4 top-1/2 transform -translate-y-1/2 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input id="searchBar"
                           onkeyup="filterMessages()"
                           type="text"
                           placeholder="Search messages by name, email, or content..."
                           class="w-full pl-12 pr-4 py-3 darion-input rounded-darion-sm text-darion-text placeholder-darion-text-muted/50">
                </div>
                
                <div class="flex gap-2">
                    <select id="statusFilter" onchange="filterMessages()"
                            class="px-4 py-3 darion-input rounded-darion-sm text-darion-text">
                        <option value="all">All Status</option>
                        <option value="new">New</option>
                        <option value="in_progress">In Progress</option>
                        <option value="resolved">Resolved</option>
                    </select>
                    
                    <select id="priorityFilter" onchange="filterMessages()"
                            class="px-4 py-3 darion-input rounded-darion-sm text-darion-text">
                        <option value="all">All Priority</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                </div>
            </div>

            <!-- Status Filters -->
            <div class="flex gap-3 mt-4 overflow-x-auto pb-2">
                <button onclick="setStatusFilter('all')" 
                        class="status-badge bg-darion-primary/20 text-darion-primary-light border border-darion-primary/30 whitespace-nowrap">
                    All Messages
                </button>
                <button onclick="setStatusFilter('new')" 
                        class="status-badge bg-green-900/20 text-green-400 border border-green-900/30 whitespace-nowrap">
                    New (<?= $newCount ?>)
                </button>
                <button onclick="setStatusFilter('in_progress')" 
                        class="status-badge bg-blue-900/20 text-blue-400 border border-blue-900/30 whitespace-nowrap">
                    In Progress (<?= $inProgressCount ?>)
                </button>
                <button onclick="setStatusFilter('resolved')" 
                        class="status-badge bg-darion-slate/20 text-darion-slate border border-darion-slate/30 whitespace-nowrap">
                    Resolved (<?= $resolvedCount ?>)
                </button>
            </div>
        </div>

        <!-- Messages List -->
        <div id="messagesContainer" class="space-y-4 animate-slide-up" style="animation-delay: 0.1s;">
            <?php if (empty($messages)): ?>
                <div class="glass-card rounded-darion-lg p-12 text-center">
                    <div class="w-20 h-20 bg-darion-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium mb-2">No Support Messages</h3>
                    <p class="text-darion-text-muted">All support messages have been addressed.</p>
                </div>
            <?php else: ?>
                <?php foreach ($messages as $msg): 
                    $status = $msg['status'] ?? 'new';
                    $priority = $msg['priority'] ?? 'medium';
                    $category = $msg['category'] ?? 'general';
                    
                    $statusColors = [
                        'new' => ['bg' => 'bg-green-900/20', 'text' => 'text-green-400', 'border' => 'border-green-900/30'],
                        'in_progress' => ['bg' => 'bg-blue-900/20', 'text' => 'text-blue-400', 'border' => 'border-blue-900/30'],
                        'resolved' => ['bg' => 'bg-darion-slate/20', 'text' => 'text-darion-slate', 'border' => 'border-darion-slate/30']
                    ];
                    
                    $priorityClasses = [
                        'high' => 'priority-high',
                        'medium' => 'priority-medium',
                        'low' => 'priority-low'
                    ];
                    
                    $statusConfig = $statusColors[$status] ?? $statusColors['new'];
                ?>
                <div class="glass-card rounded-darion-lg p-6 border border-darion-border/50 hover:border-darion-border transition-all message-item <?= $priorityClasses[$priority] ?> animate-fade-in"
                     data-status="<?= $status ?>"
                     data-priority="<?= $priority ?>"
                     data-category="<?= $category ?>">
                    
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-4">
                        <!-- User Info -->
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-12 h-12 rounded-full bg-darion-primary/20 flex items-center justify-center flex-shrink-0">
                                <span class="font-medium text-darion-primary-light text-sm">
                                    <?= strtoupper(substr($msg["name"] ?? 'Unknown', 0, 2)) ?>
                                </span>
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-3 mb-2">
                                    <h3 class="text-lg font-semibold text-darion-text"><?= htmlspecialchars($msg["name"] ?? 'Unknown User') ?></h3>
                                    <span class="status-badge <?= $statusConfig['bg'] ?> <?= $statusConfig['text'] ?> <?= $statusConfig['border'] ?>">
                                        <?= ucfirst(str_replace('_', ' ', $status)) ?>
                                    </span>
                                    <?php if (!empty($msg["category"])): ?>
                                        <span class="text-xs px-2 py-1 bg-darion-glass rounded-darion-sm text-darion-text-muted">
                                            <?= htmlspecialchars(ucfirst(str_replace('_', ' ', $msg["category"]))) ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="flex flex-wrap items-center gap-4 text-sm text-darion-text-muted">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <?= htmlspecialchars($msg["email"] ?? 'No email') ?>
                                    </span>
                                    <?php if (!empty($msg["phone"])): ?>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            <?= htmlspecialchars($msg["phone"]) ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <?php if ($status === 'new'): ?>
                                <button onclick="updateStatus(<?= $msg['id'] ?? 0 ?>, 'in_progress')"
                                        class="px-3 py-2 bg-blue-700 text-white rounded-darion-sm text-sm hover:bg-blue-600 transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    Start Progress
                                </button>
                            <?php elseif ($status === 'in_progress'): ?>
                                <button onclick="updateStatus(<?= $msg['id'] ?? 0 ?>, 'resolved')"
                                        class="px-3 py-2 bg-green-700 text-white rounded-darion-sm text-sm hover:bg-green-600 transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Mark Resolved
                                </button>
                            <?php endif; ?>
                            
                            <a href="mailto:<?= htmlspecialchars($msg['email'] ?? '') ?>?subject=Re: Your Darion Finance Support Inquiry&body=Dear <?= urlencode($msg['name'] ?? 'User') ?>,\n\nThank you for contacting Darion Finance support.\n\n"
                               class="px-3 py-2 glass-card border border-darion-border rounded-darion-sm text-sm hover:bg-darion-glass transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Reply
                            </a>
                            
                            <button onclick="showMessageDetails(<?= htmlspecialchars(json_encode($msg)) ?>)"
                                    class="px-3 py-2 glass-card border border-darion-border rounded-darion-sm text-sm hover:bg-darion-glass transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Message Content -->
                    <div class="mb-4">
                        <?php if (!empty($msg["subject"])): ?>
                            <h4 class="font-medium text-darion-text mb-2"><?= htmlspecialchars($msg["subject"]) ?></h4>
                        <?php endif; ?>
                        <div class="p-4 bg-darion-glass/50 border border-darion-border/30 rounded-darion-sm text-darion-text-muted leading-relaxed">
                            <?= nl2br(htmlspecialchars($msg["message"] ?? 'No message content')) ?>
                        </div>
                    </div>

                    <!-- Footer with Metadata -->
                    <div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-darion-border/30">
                        <div class="flex flex-wrap items-center gap-4 text-sm text-darion-text-muted">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <?= isset($msg["created_at"]) ? date("F j, Y, g:i A", strtotime($msg["created_at"])) : 'Unknown date' ?>
                            </span>
                            
                            <?php if (!empty($msg["application_ref"])): ?>
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Ref: <?= htmlspecialchars($msg["application_ref"]) ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <?php if (!empty($msg["admin_reply"])): ?>
                                <span class="text-xs px-2 py-1 bg-darion-primary/20 text-darion-primary-light rounded-darion-sm">
                                    Replied
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <!-- Empty State (hidden by default) -->
        <div id="noResults" class="hidden glass-card rounded-darion-lg p-12 text-center">
            <div class="w-20 h-20 bg-darion-glass rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-darion-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-medium mb-2">No messages found</h3>
            <p class="text-darion-text-muted">Try adjusting your search or filter criteria</p>
        </div>
    </div>

    <script>
        // Filter messages based on search and filters
        function filterMessages() {
            const searchTerm = document.getElementById('searchBar').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const priorityFilter = document.getElementById('priorityFilter').value;
            const messages = document.getElementsByClassName('message-item');
            let visibleCount = 0;
            
            for (let message of messages) {
                const text = message.textContent.toLowerCase();
                const status = message.getAttribute('data-status');
                const priority = message.getAttribute('data-priority');
                
                const matchesSearch = text.includes(searchTerm);
                const matchesStatus = statusFilter === 'all' || status === statusFilter;
                const matchesPriority = priorityFilter === 'all' || priority === priorityFilter;
                
                if (matchesSearch && matchesStatus && matchesPriority) {
                    message.style.display = 'block';
                    visibleCount++;
                } else {
                    message.style.display = 'none';
                }
            }
            
            // Show/hide no results message
            const noResults = document.getElementById('noResults');
            if (visibleCount === 0 && messages.length > 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        }
        
        // Set status filter from button click
        function setStatusFilter(status) {
            document.getElementById('statusFilter').value = status;
            filterMessages();
            
            // Update active button
            document.querySelectorAll('.status-badge').forEach(btn => {
                btn.classList.remove('bg-darion-primary', 'text-white');
            });
            event.target.classList.add('bg-darion-primary', 'text-white');
        }
        
        // Update message status
        function updateStatus(messageId, newStatus) {
            if (confirm('Are you sure you want to update the status?')) {
                // Send AJAX request to update status
                fetch('index.php?page=update_support_status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `message_id=${messageId}&status=${newStatus}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to update status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating status');
                });
            }
        }
        
        // Show message details modal
        function showMessageDetails(message) {
            const modalContent = `
                <div class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 p-4">
                    <div class="glass-card rounded-darion-lg p-6 max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-semibold">Message Details</h3>
                            <button onclick="closeModal()" class="text-darion-text-muted hover:text-darion-text">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm text-darion-text-muted mb-1">Subject</label>
                                <p class="text-darion-text font-medium">${message.subject || 'No subject'}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm text-darion-text-muted mb-1">Message</label>
                                <div class="p-4 bg-darion-glass rounded-darion-sm">
                                    <p class="text-darion-text whitespace-pre-wrap">${message.message}</p>
                                </div>
                            </div>
                            
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm text-darion-text-muted mb-1">User</label>
                                    <p class="text-darion-text">${message.name}</p>
                                </div>
                                <div>
                                    <label class="block text-sm text-darion-text-muted mb-1">Email</label>
                                    <p class="text-darion-text">${message.email}</p>
                                </div>
                                <div>
                                    <label class="block text-sm text-darion-text-muted mb-1">Phone</label>
                                    <p class="text-darion-text">${message.phone || 'Not provided'}</p>
                                </div>
                                <div>
                                    <label class="block text-sm text-darion-text-muted mb-1">Category</label>
                                    <p class="text-darion-text">${message.category || 'General'}</p>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm text-darion-text-muted mb-1">Submitted</label>
                                <p class="text-darion-text">${new Date(message.created_at).toLocaleString()}</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            const modal = document.createElement('div');
            modal.innerHTML = modalContent;
            document.body.appendChild(modal);
        }
        
        function closeModal() {
            const modal = document.querySelector('.fixed.inset-0.bg-black\\/70');
            if (modal) {
                modal.remove();
            }
        }
        
        // Export messages to CSV
        function exportMessages() {
            // This is a simplified export function
            // In a real implementation, you would fetch data from the server
            const messages = <?= json_encode($messages) ?>;
            let csv = 'Name,Email,Phone,Subject,Message,Category,Status,Priority,Created At\n';
            
            messages.forEach(msg => {
                csv += `"${msg.name || ''}","${msg.email || ''}","${msg.phone || ''}","${msg.subject || ''}","${(msg.message || '').replace(/"/g, '""')}","${msg.category || ''}","${msg.status || ''}","${msg.priority || ''}","${msg.created_at || ''}"\n`;
            });
            
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `support_messages_${new Date().toISOString().split('T')[0]}.csv`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            window.URL.revokeObjectURL(url);
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Add keyboard shortcut for search
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    document.getElementById('searchBar').focus();
                }
            });
            
            // Clear search on Escape key
            document.getElementById('searchBar').addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    this.value = '';
                    filterMessages();
                }
            });
        });
    </script>
</body>
</html>