<?php
require_once '../../config/db.php';
require_once '../../models/event.php';

$database = new Database();
$db = $database->connect();

$eventObj = new Event($db);

// Form POST handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['eventName'];
    $date = $_POST['eventDate'];
    $time = $_POST['eventTime'];
    $location = $_POST['location'];
    $count = $_POST['count'];
    $description = $_POST['eventDescription'];

    // Combine date + time
    $date_time = $date . ' ' . $time . ':00';

    // Insert
    if ($eventObj->insertEvent($title, $description, $date_time, $location, $count)) {
        // Redirect back to admin panel
        header("Location: admin_panel.php?success=1");
        exit;
    } else {
        header("Location: admin_panel.php?error=1");
        exit;
    }
}
?>
