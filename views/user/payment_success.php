<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Success - Darion Finance</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darion: "#ff6600",
                        dlight: "#ff8c42",
                        success: "#28a745"
                    }
                }
            }
        }
    </script>

    <style>
        /* Success Icon Animation */
        .success-icon {
            animation: pop 0.6s ease-out forwards;
        }

        @keyframes pop {
            0% { transform: scale(0); opacity: 0; }
            70% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(1); }
        }

        /* Pulse glow */
        .glow {
            animation: glow 1.5s infinite ease-in-out;
        }

        @keyframes glow {
            0% { box-shadow: 0 0 0 0 rgba(255,102,0,0.5); }
            50% { box-shadow: 0 0 20px 5px rgba(255,102,0,0.3); }
            100% { box-shadow: 0 0 0 0 rgba(255,102,0,0.2); }
        }
    </style>

</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="flex items-center justify-between px-6 py-4 bg-white shadow-md fixed top-0 left-0 right-0">
    <div class="text-2xl font-bold text-darion">Darion Finance</div>

    <div class="hidden md:flex gap-6 font-semibold">
        <a href="index.php?page=dashboard" class="hover:text-darion">Dashboard</a>
        <a href="index.php?page=status" class="hover:text-darion">Status</a>
    </div>
</nav>

<div class="h-20"></div>

<!-- SUCCESS MESSAGE -->
<div class="flex justify-center items-center min-h-[70vh] px-6">

    <div class="bg-white p-10 shadow-xl rounded-2xl text-center w-full max-w-lg">

        <!-- Animated Success Icon -->
        <div class="w-24 h-24 mx-auto rounded-full border-4 border-success flex items-center justify-center mb-6 success-icon glow">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-success" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                      d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h1 class="text-3xl font-bold text-success mb-2">
            Payment Successful!
        </h1>

        <p class="text-gray-600 mb-6">
            Thank you! Your commission payment has been successfully processed.
        </p>

        <a href="index.php?page=dashboard"
           class="bg-gradient-to-r from-darion to-dlight text-white font-semibold px-6 py-3 rounded-lg shadow hover:opacity-90 transition">
            Back to Dashboard
        </a>
    </div>

</div>

<!-- FOOTER -->
<footer class="text-center py-6 bg-gray-100 text-gray-600 text-sm mt-10">
    © <?= date("Y") ?> Darion Finance — All Rights Reserved.
</footer>

</body>
</html>
