<?php
// /models/Loan.php

require_once __DIR__ . "/../config/db.php";

class Loan
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    // ===============================================================
    // CREATE LOAN APPLICATION (Supports full dynamic form)
    // ===============================================================
    public function createLoan(array $data): int
    {
        $sql = "
            INSERT INTO loan_applications (
                user_id, loan_type, requested_amount, tenure,

                -- Personal Details
                full_name, user_email, phone, dob,

                -- Employment Details
                employment_type, monthly_income, company_name,

                -- Personal Loan
                purpose, salary_account,

                -- Business Loan
                business_name, udyam_number, gst_number, business_age,

                -- Education Loan
                institute_name, course_name, course_duration, student_id,

                -- Two Wheeler Loan
                vehicle_brand, vehicle_model, vehicle_number, vehicle_type,

                -- Re-Loan
                previous_loan_number, previous_lender, previous_loan_amount, repayment_history,

                -- Loan Against Property
                property_type, property_address, property_value, property_ownership,

                status, created_at
            )
            VALUES (
                :user_id, :loan_type, :requested_amount, :tenure,

                :full_name, :user_email, :phone, :dob,

                :employment_type, :monthly_income, :company_name,

                :purpose, :salary_account,

                :business_name, :udyam_number, :gst_number, :business_age,

                :institute_name, :course_name, :course_duration, :student_id,

                :vehicle_brand, :vehicle_model, :vehicle_number, :vehicle_type,

                :previous_loan_number, :previous_lender, :previous_loan_amount, :repayment_history,

                :property_type, :property_address, :property_value, :property_ownership,

                'submitted', NOW()
            )
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);

        return (int)$this->db->lastInsertId();
    }

    // ===============================================================
    // GET LOANS BY USER
    // ===============================================================
    public function getByUser(int $user_id): array
    {
        $sql = "
            SELECT * FROM loan_applications
            WHERE user_id = :user_id
            ORDER BY created_at DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([":user_id" => $user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================================================
    // GET LOAN APPLICATION BY ID
    // ===============================================================
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM loan_applications WHERE id = :id LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([":id" => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    // ===============================================================
    // UPDATE STATUS
    // ===============================================================
    public function updateStatus(int $app_id, string $status): bool
    {
        $sql = "
            UPDATE loan_applications
            SET status = :status, updated_at = NOW()
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":status" => $status,
            ":id" => $app_id
        ]);
    }

    // ===============================================================
    // MARK LOAN AS SANCTIONED
    // ===============================================================
    public function markSanctioned(int $app_id, float $amount): bool
    {
        $sql = "
            UPDATE loan_applications
            SET 
                status = 'sanctioned',
                sanctioned_amount = :amount,
                updated_at = NOW()
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ":amount" => $amount,
            ":id" => $app_id
        ]);
    }
}
?>
