<?php
class Database {

    private $host = "127.0.0.1";   // FORCE TCP
    private $db_name = "if0_40382914_maintainance";
    private $username = "root";
    private $password = "";

    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            // Force TCP connection via port
            $dsn = "mysql:host={$this->host};port=3307;dbname={$this->db_name};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Connection error: " . $e->getMessage());
        }

        return $this->conn;
    }
}
?>
