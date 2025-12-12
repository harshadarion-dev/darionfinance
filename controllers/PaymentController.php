<?php
// /controllers/PaymentController.php

require_once __DIR__ . "/../config/auth.php";
require_once __DIR__ . "/../models/Payment.php";
require_once __DIR__ . "/../models/Loan.php";

class PaymentController
{
    // START PAYMENT (fake for XAMPP testing)
    public function start()
    {
        require_login();

        $user_id = $_SESSION["user_id"];
        $app_id = $_POST["app_id"] ?? 0;

        if (!$app_id) {
            $_SESSION["error"] = "Invalid application.";
            header("Location: index.php?page=status");
            exit;
        }

        // Get sanctioned amount
        $loan = new Loan();
        $app = $loan->getById($app_id);

        if (!$app || $app["status"] !== "sanctioned") {
            $_SESSION["error"] = "Loan not sanctioned yet.";
            header("Location: index.php?page=status");
            exit;
        }

        $payment = new Payment();
        $payment_id = $payment->create($app_id, $user_id, $app["sanctioned_amount"]);

        // Redirect to manual payment page
        header("Location: index.php?page=commission_pay&payment_id=$payment_id");
    }

    // MANUAL PAYMENT SUCCESS (for local XAMPP testing)
    public function success()
    {
        require_login();

        $payment_id = $_GET["payment_id"] ?? 0;
        if (!$payment_id) { echo "Invalid payment."; exit; }

        $payment = new Payment();
        $payment->markPaid($payment_id, "TEST-PAID-" . time());

        include "views/user/payment_success.php";
    }
}
