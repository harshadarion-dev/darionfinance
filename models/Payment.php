<?php
// /models/Payment.php

require_once __DIR__ . "/../config/db.php";

class Payment
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    // Create commission payment record
    public function create(int $app_id, int $user_id, float $sanctioned_amount): int
    {
        $commission = round($sanctioned_amount * 0.05, 2);

        $query = $this->db->prepare("
            INSERT INTO commission_payments (application_id, user_id, sanctioned_amount, commission_amount)
            VALUES (:app, :user, :amount, :commission)
        ");

        $query->execute([
            ":app" => $app_id,
            ":user" => $user_id,
            ":amount" => $sanctioned_amount,
            ":commission" => $commission
        ]);

        return (int)$this->db->lastInsertId();
    }

    // Update payment status after gateway callback
    public function markPaid(int $payment_id, string $ref): bool
    {
        $query = $this->db->prepare("
            UPDATE commission_payments
            SET paid = 1,
                payment_reference = :ref,
                paid_at = NOW()
            WHERE id = :id
        ");

        return $query->execute([
            ":ref" => $ref,
            ":id" => $payment_id
        ]);
    }
}
