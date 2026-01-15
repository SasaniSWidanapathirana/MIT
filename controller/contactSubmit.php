<?php
require_once '../config/db.php';  // Update path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // DB connection
    $db = (new Database())->connect();

    // Insert message
    $sql = "INSERT INTO contact_messages (name, email, subject, message, created_at)
            VALUES (:name, :email, :subject, :message, NOW())";

    $stmt = $db->prepare($sql);

    $success = $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':subject' => $subject,
        ':message' => $message
    ]);

    if ($success) {
        header("Location: ../views/common/contact.php?success=1");
        exit;
    } else {
        header("Location: ../views/common/contact.php?error=1");
        exit;
    }
}
