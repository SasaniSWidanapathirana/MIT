<?php
class User {

    private $conn;
    private $table = "users";

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

    // Insert new user (signup)
    public function register($name, $nic, $email, $password, $role = 2, $field = 1, $status = 1) {
        $query = "INSERT INTO " . $this->table . " 
                  (name, nic, email, password, role, field, status)
                  VALUES (:name, :nic, :email, :password, :role, :field, :status)";

        $stmt = $this->conn->prepare($query);

        // Hash the password before saving
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':nic', $nic);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':field', $field);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    // Delete user
    public function deleteUser($id) {
        $query = "DELETE FROM " . $this->table . " WHERE user_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Update user
    public function updateUser($id, $nic, $email, $field) {
        $query = "UPDATE " . $this->table . "
                  SET nic = :nic,
                      email = :email,
                      field = :field
                  WHERE user_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nic', $nic);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':field', $field);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Login user (verify email + password)
    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

}
?>
