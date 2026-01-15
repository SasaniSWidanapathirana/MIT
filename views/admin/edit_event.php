<?php
require_once '../../config/db.php';
require_once '../../models/event.php';

$db = (new Database())->connect();
$eventObj = new Event($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['event_id'];
    $title = $_POST['eventName'];
    $date_time = $_POST['eventDate'] . ' ' . $_POST['eventTime'] . ':00';
    $location = $_POST['location'];
    $count = $_POST['count'];
    $description = $_POST['eventDescription'];

    $eventObj->updateEvent(
        $id,
        $title,
        $description,
        $date_time,
        $location,
        $count
    );

    header("Location: admin_panel.php?updated=1");
    exit;
}
