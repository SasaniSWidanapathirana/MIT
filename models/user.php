<?php
class User {

    private $conn;
    private $table = "user";

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
    public function insertUser($nic,$name, $email, $password, $role, $status) {
        $query = "INSERT INTO " . $this->table . " 
                  (name, nic, email, password, role, status)
                  VALUES (:name, :nic, :email, :password, :role, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':nic', $nic);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
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
public function updateUser( $id, $nic,$email, $name) {

    $query = "UPDATE " . $this->table . "
              SET nic = :nic,
                  name = :name,
                  email = :email
              WHERE user_id = :id";
              
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':nic', $nic);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    return $stmt->execute();
}
}
?>

