<?php
session_start();
require_once __DIR__ . '/../config/db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$eventId = isset($data['event_id']) ? (int)$data['event_id'] : 0;
$action  = $data['action'] ?? '';
$userId  = (int)$_SESSION['user_id'];

if ($eventId <= 0 || !in_array($action, ['join', 'leave'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$db = (new Database())->connect();

try {
    if ($action === 'join') {
        $stmt = $db->prepare( "INSERT INTO event_users (event_id, user_id) VALUES (:event_id, :user_id)");
        $stmt->execute([':event_id' => $eventId, ':user_id' => $userId]);
    } else {
        $stmt = $db->prepare("DELETE FROM event_users WHERE event_id = :event_id AND user_id = :user_id");
        $stmt->execute([':event_id' => $eventId, ':user_id' => $userId]);
    }

    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
