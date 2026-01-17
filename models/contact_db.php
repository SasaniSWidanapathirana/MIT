<?php
class ContactDB {

    private $conn;
    private $table = "contact_messages";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllContact() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}