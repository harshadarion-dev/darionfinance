<?php
// /models/Document.php

require_once __DIR__ . "/../config/db.php";

class Document
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    // ======================================================
    // SAVE NEW DOCUMENT
    // ======================================================
    public function addDocument(array $data): int
    {
        $sql = "
            INSERT INTO loan_documents (loan_id, doc_type, file_path)
            VALUES (:loan_id, :doc_type, :file_path)
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ":loan_id"  => $data["loan_id"],
            ":doc_type" => $data["doc_type"],
            ":file_path" => $data["file_path"]
        ]);

        return (int)$this->db->lastInsertId();
    }

    // ======================================================
    // GET DOCUMENTS FOR A LOAN
    // ======================================================
    public function getDocs(int $loan_id): array
    {
        $sql = "
            SELECT * FROM loan_documents
            WHERE loan_id = :loan_id
            ORDER BY id ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([":loan_id" => $loan_id]);

        return $stmt->fetchAll();
    }
}
?>
