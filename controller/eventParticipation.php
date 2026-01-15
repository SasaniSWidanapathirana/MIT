<?php
require_once '../../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

$eventId = $data['event_id'];
$status  = $data['status'];
$userId  = $_SESSION['user_id']; // logged-in user

$db = (new Database())->connect();

$sql = "INSERT INTO event_user (event_id, user_id, participation_status)
        VALUES (:event_id, :user_id, :status)
        ON DUPLICATE KEY UPDATE participation_status = :status";

$stmt = $db->prepare($sql);
$success = $stmt->execute([
    ':event_id' => $eventId,
    ':user_id'  => $userId,
    ':status'   => $status
]);

echo json_encode(['success' => $success]);
