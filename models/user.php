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
                  (name, nic, email, password, role, status)
                  VALUES (:name, :nic, :email, :password, :role, :status)";

        $stmt = $this->conn->prepare($query);

        // Hash the password before saving
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':nic', $nic);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':status', $status);

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

    // Insert user
    public function insertUser($name, $nic, $email, $password, $role, $status) {
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

    // Delete user
    public function deleteUser($id) {
        $query = "DELETE FROM " . $this->table . " WHERE user_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Update user
    public function updateUser($id, $nic, $email, $name) {
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

    // Get user by ID
    public function getUserById($id) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM users WHERE user_id = :id"
        );
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update profile (with optional password change)
    public function updateProfile($id, $name, $nic, $email, $password = null) {
        try {
            // If password is provided and not empty, update it too
            if (!empty($password)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $query = "UPDATE " . $this->table . " 
                        SET name = :name, nic = :nic, email = :email, password = :password
                        WHERE user_id = :id";
                
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':nic', $nic);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hash);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            } else {
                // Update without changing password
                $query = "UPDATE " . $this->table . " 
                        SET name = :name, nic = :nic, email = :email
                        WHERE user_id = :id";
                
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':nic', $nic);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Profile update error: " . $e->getMessage());
            return false;
        }
    }

    // Update profile photo
    public function updateProfilePhoto($id, $photoPath) {
        try {
            $query = "UPDATE " . $this->table . " 
                    SET profile_photo = :photo
                    WHERE user_id = :id";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':photo', $photoPath);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Profile photo update error: " . $e->getMessage());
            return false;
        }
    }

    // Check if email already exists (for validation during profile update)
    public function emailExists($email, $excludeUserId = null) {
        if ($excludeUserId) {
            $query = "SELECT user_id FROM " . $this->table . " 
                     WHERE email = :email AND user_id != :user_id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':user_id', $excludeUserId, PDO::PARAM_INT);
        } else {
            $query = "SELECT user_id FROM " . $this->table . " 
                     WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
        }
        
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

     // Toggle approval status: 1 <-> 11
    public function toggleApproval($userId, $role)
    {
        // Only allow 1 or 11
        if (!in_array($role, [1, 11])) {
            return false;
        }

        $query = "UPDATE " . $this->table . " SET role = :role WHERE user_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
?>