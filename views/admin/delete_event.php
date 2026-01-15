<?php
require_once '../../config/db.php';
require_once '../../models/event.php';

$db = (new Database())->connect();
$eventObj = new Event($db);

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if ($eventObj->deleteEvent($id)) {
        header("Location: admin_panel.php?deleted=1");
        exit;
    }
}

header("Location: admin_panel.php?error=1");
exit;
