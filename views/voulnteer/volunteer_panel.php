<?php
session_start();
require_once '../../config/db.php';
require_once '../../models/event.php';

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$userId = $_SESSION['user_id'];


$database = new Database();
$db = $database->connect();

$eventObj = new Event($db);
$events = $eventObj->getAllEventsWithParticipation($userId);

$pendingevents      = $db->query("SELECT COUNT(*) FROM events WHERE date_time > NOW()")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/../public/js/addEvent.js"></script>
    <script src="/../public/js/eventParticipation.js"></script>
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="../../public/css/volunteer.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
    <title>Volunteer Screen</title>
</head>


<body class="admin-body">

    <!-- Side Navigation -->
    <?php include '../components/sidenav2.php'; ?>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Top Bar -->

        <?php
            $pageTitle = "Upcoming Events"; 
            include '../components/topbar.php';?>

            <div class="stats-bar">
<div class="stat-box">
                <h4>Upcoming Events</h4>
               <div class="innerbox" style="background: #dcf3ff;"><div class="iconvalue" ><span class="material-symbols-rounded" style="background: #0078d4;">user_attributes</span>
                <span class="label">
                    count :
                </span>

               <span class="value"><?= $pendingevents; ?></span></div></div> 
            </div></div>

        <!-- Main Content -->
        <main class="content" style="margin: 20px;>

            <div class="event-table-wrapper">
                <table class="event-table">
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date & Time</th>
                        <th>Location</th>
                        <th>Expected Count</th>
                        <th>Actions</th>
                    </tr>

                    <?php while ($row = $events->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <!-- <td><?= htmlspecialchars($row['event_id']); ?></td> -->
                            <td><?= htmlspecialchars($row['title']); ?></td>
                            <td><?= htmlspecialchars($row['description']); ?></td>
                            <td><?= htmlspecialchars($row['date_time']); ?></td>
                            <td><?= htmlspecialchars($row['location']); ?></td>
                            <td><?= htmlspecialchars($row['exp_cnt']); ?></td>
                            <td class="action-cell">
                                <label class="switch">
                                    <input 
                                        type="checkbox"
                                        class="participation-toggle"
                                        data-event-id="<?= $row['event_id']; ?>"
                                        <?= $row['joined'] ? 'checked' : '' ?>
                                    >

                                    <span class="slider"></span>
                                </label>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>

        </main>
    </div>

</body>