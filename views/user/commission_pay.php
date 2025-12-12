<?php
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php?page=login");
    exit;
}

$payment_id = $_GET["payment_id"] ?? 0;
if (!$payment_id) {
    echo "Invalid Payment Request";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commission Payment - Darion Finance</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darion: "#ff6600",
                        dlight: "#ff8c42"
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="flex items-center justify-between px-6 py-4 bg-white shadow-md fixed top-0 left-0 right-0 z-50">
    <div class="text-2xl font-bold text-darion">Darion Finance</div>

    <div class="hidden md:flex gap-6 font-semibold">
        <a href="index.php?page=dashboard" class="hover:text-darion">Dashboard</a>
        <a href="index.php?page=status" class="hover:text-darion">Status</a>

        <form action="index.php?page=logout" method="POST">
            <input type="hidden" name="action" value="logout">
            <button class="hover:text-red-600">Logout</button>
        </form>
    </div>
</nav>

<div class="h-20"></div>

<!-- PAYMENT BOX -->
<div class="flex justify-center items-center min-h-[70vh] px-4">

    <div class="w-full max-w-lg bg-white shadow-xl rounded-xl p-8">

        <h2 class="text-3xl font-bold text-center text-darion mb-6">
            Commission Payment
        </h2>

        <p class="text-gray-600 text-center mb-4">
            You are about to pay the commission for your sanctioned loan.
        </p>

        <div class="bg-gray-50 p-5 rounded-lg border mb-6">
            <p class="text-gray-700 text-lg">
                <span class="font-semibold">Payment ID:</span> <?= htmlspecialchars($payment_id) ?>
            </p>
            <p class="text-gray-700 text-lg mt-2">
                <span class="font-semibold">Commission Rate:</span> 5%
            </p>
            <p class="text-gray-500 text-sm mt-2">
                (Final amount will be calculated from your sanctioned loan amount.)
            </p>
        </div>

        <!-- Fake Payment Button (Local Testing) -->
        <form action="index.php" method="GET" class="mt-6">
            <input type="hidden" name="page" value="payment_success">
            <input type="hidden" name="payment_id" value="<?= $payment_id ?>">

            <button
                class="w-full bg-gradient-to-r from-darion to-dlight text-white py-3 rounded-lg text-lg font-semibold hover:opacity-90 transition">
                Pay Commission (Test Payment)
            </button>
        </form>

        <p class="text-center text-gray-500 text-sm mt-4">
            *This is a demo payment screen for XAMPP testing.
        </p>
    </div>
</div>

<!-- FOOTER -->
<footer class="text-center py-6 bg-gray-100 text-gray-600 text-sm mt-10">
    © <?= date("Y") ?> Darion Finance — All Rights Reserved.
</footer>

</body>
</html>
