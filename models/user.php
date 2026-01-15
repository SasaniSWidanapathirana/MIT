<?php
class User {

    private $conn;
    private $table = "app_users";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all users
    public function getAllUsers() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Insert user
    public function insertUser($nic, $email, $password, $role, $field, $status) {
        $query = "INSERT INTO " . $this->table . " 
                  (nic, email, password, role, field, status)
                  VALUES (:nic, :email, :password, :role, :field, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nic', $nic);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':field', $field);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }
    //delete user
public function deleteUser($id) {
        $query = "DELETE FROM " . $this->table . " WHERE user_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();


        }
// update user
    public function updateUser($id, $nic, $email, $role, $field) {
        $query = "UPDATE " . $this->table . "
                  SET nic = :nic,
                      email = :email,
                      field = :field
                  WHERE user_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nic', $nic);
        $stmt->bindParam(':email', $email);
       // $stmt->bindParam(':role', $role);
        $stmt->bindParam(':field', $field);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>

