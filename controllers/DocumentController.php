<?php
// /controllers/DocumentController.php

require_once __DIR__ . "/../config/auth.php";
require_once __DIR__ . "/../models/Document.php";
require_once __DIR__ . "/../models/Loan.php";

class DocumentController {

    public function upload()
    {
        require_login();

        $loan_id = $_POST["loan_id"] ?? null;

        if (!$loan_id) {
            $_SESSION["error"] = "Loan application not found.";
            header("Location: index.php?page=dashboard");
            exit;
        }

        $allowed = ["image/jpeg", "image/png", "application/pdf"];

        $docModel = new Document();

        // Create folder for loan
        $folder = __DIR__ . "/../uploads/$loan_id/";
        $folder_url = "uploads/$loan_id/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        // Loop through uploaded files
        foreach ($_FILES as $field => $file) {

            if ($file["error"] !== UPLOAD_ERR_OK) {
                continue;
            }

            // Validate MIME type
            $mime = mime_content_type($file["tmp_name"]);
            if (!in_array($mime, $allowed)) {
                $_SESSION["error"] = "Invalid file type for $field";
                continue;
            }

            // Unique file name
            $filename = $field . "_" . time() . "." . pathinfo($file["name"], PATHINFO_EXTENSION);

            $filepath = $folder . $filename;
            $filepath_url = $folder_url . $filename;

            // Move uploaded file
            move_uploaded_file($file["tmp_name"], $filepath);

            // Save document record
            $docModel->addDocument([
                "loan_id"  => $loan_id,
                "doc_type" => $field,
                "file_path" => $filepath_url
            ]);
        }

        $_SESSION["success"] = "Documents uploaded successfully!";
        header("Location: index.php?page=view_app&app_id=" . $loan_id);
        exit;
    }
}
?>
