<?php
require_once __DIR__ . "/../config/auth.php";
require_once __DIR__ . "/../models/Loan.php";
require_once __DIR__ . "/../models/Document.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../config/mailer.php";

class LoanController
{
    private $loanModel;
    private $docModel;
    private $userModel;

    public function __construct()
    {
        $this->loanModel = new Loan();
        $this->docModel  = new Document();
        $this->userModel = new User();
    }

    // ============================================================
    // APPLY LOAN
    // ============================================================
    public function apply()
    {
        require_login();

        // -------------------------------
        // Basic validations
        // -------------------------------
        if (empty($_POST["loan_type"]) || empty($_POST["amount"])) {
            $_SESSION["error"] = "Please complete all required fields.";
            header("Location: index.php?page=apply");
            exit;
        }

        $user_id = current_user_id();

        // ---------------------------------------------------------
        // Build Data Array for Loan.php::createLoan()
        // ---------------------------------------------------------
        $data = [
            "user_id" => $user_id,
            "loan_type" => $_POST["loan_type"],
            "requested_amount" => $_POST["amount"],
            "tenure" => $_POST["tenure"],

            // Personal Info
            "full_name" => $_POST["full_name"],
            "user_email" => $_POST["email"],
            "phone" => $_POST["phone"],
            "dob" => $_POST["dob"],

            // Employment
            "employment_type" => $_POST["employment_type"],
            "monthly_income" => $_POST["monthly_income"],
            "company_name" => $_POST["company_name"] ?? null,

            // Personal Loan
            "purpose" => $_POST["purpose"] ?? null,
            "salary_account" => $_POST["salary_account"] ?? null,

            // Business Loan
            "business_name" => $_POST["business_name"] ?? null,
            "udyam_number" => $_POST["udyam_number"] ?? null,
            "gst_number" => $_POST["gst_number"] ?? null,
            "business_age" => $_POST["business_age"] ?? null,

            // Education Loan
            "institute_name" => $_POST["institute_name"] ?? null,
            "course_name" => $_POST["course_name"] ?? null,
            "course_duration" => $_POST["course_duration"] ?? null,
            "student_id" => $_POST["student_id"] ?? null,

            // Two Wheeler Loan
            "vehicle_brand" => $_POST["vehicle_brand"] ?? null,
            "vehicle_model" => $_POST["vehicle_model"] ?? null,
            "vehicle_number" => $_POST["vehicle_number"] ?? null,
            "vehicle_type" => $_POST["vehicle_type"] ?? null,

            // Re-Loan
            "previous_loan_number" => $_POST["previous_loan_number"] ?? null,
            "previous_lender" => $_POST["previous_lender"] ?? null,
            "previous_loan_amount" => $_POST["previous_loan_amount"] ?? null,
            "repayment_history" => $_POST["repayment_history"] ?? null,

            // Loan Against Property
            "property_type" => $_POST["property_type"] ?? null,
            "property_address" => $_POST["property_address"] ?? null,
            "property_value" => $_POST["property_value"] ?? null,
            "property_ownership" => $_POST["property_ownership"] ?? null,
        ];

        // ---------------------------------------------------------
        // 1️⃣ CREATE LOAN RECORD
        // ---------------------------------------------------------
        $loan_id = $this->loanModel->createLoan($data);

        // ---------------------------------------------------------
        // 2️⃣ UPLOAD DOCUMENTS (ALL FILES)
        // ---------------------------------------------------------
        foreach ($_FILES as $field => $fileInfo) {
            if ($fileInfo["error"] === UPLOAD_ERR_OK) {
                $this->uploadDocument($loan_id, $field);
            }
        }

        // ---------------------------------------------------------
        // 3️⃣ SEND EMAIL CONFIRMATION
        // ---------------------------------------------------------
        $email = $data["user_email"];

        $mailer = new Mailer();
        $mailer->sendMail(
            $email,
            "Your Loan Application Has Been Submitted",
            "
            <h2>Loan Application Submitted</h2>
            <p>Dear " . htmlspecialchars($data["full_name"]) . ",</p>
            <p>Your loan application has been submitted successfully.</p>
            <p>Our team will verify your documents shortly.</p>
            <br>
            <strong>Darion Finance Team</strong>
            "
        );

        // ---------------------------------------------------------
        // 4️⃣ REDIRECT
        // ---------------------------------------------------------
        $_SESSION["success"] = "Your loan application has been submitted!";
        header("Location: index.php?page=status&app_id=" . $loan_id);
        exit;
    }

    // ============================================================
    // DOCUMENT UPLOAD
    // ============================================================
    private function uploadDocument($loan_id, $field)
    {
        $allowed = ["image/jpeg", "image/png", "application/pdf"];

        $mime = mime_content_type($_FILES[$field]["tmp_name"]);
        if (!in_array($mime, $allowed)) {
            return;
        }

        $folder = __DIR__ . "/../uploads/$loan_id/";
        $url_folder = "uploads/$loan_id/";

        if (!is_dir($folder)) mkdir($folder, 0777, true);

        $filename = $field . "_" . time() . "_" . basename($_FILES[$field]["name"]);
        $filepath = $folder . $filename;

        move_uploaded_file($_FILES[$field]["tmp_name"], $filepath);

        $this->docModel->addDocument([
            "loan_id" => $loan_id,
            "doc_type" => $field,
            "file_path" => $url_folder . $filename
        ]);
    }

    // ============================================================
    // GET USER APPLICATIONS
    // ============================================================
    public function userApplications()
    {
        require_login();
        return $this->loanModel->getByUser(current_user_id());
    }
}
?>
