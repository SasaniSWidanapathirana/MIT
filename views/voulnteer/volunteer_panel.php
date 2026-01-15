<?php 
// Load DB + Model
require_once '../../config/db.php';
require_once '../../models/event.php';

// DB Connection
$database = new Database();
$db = $database->connect();

// Load events
$eventObj = new Event($db);
$events = $eventObj->getAllEvents();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/../public/js/addEvent.js"></script>
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
    <title>Volunteer Screen</title>
</head>

<!-- <body class="body">
    <div>
        <a href="../../index.php">
            <img src="/public/images/logo.jpg" alt="logo image">    
        </a>    
        <button onclick="location.href='../../index.php'">Log out</button>
    </div>
    <h1 class = "h1_center">Volunteer Page</h1>
    <h2 class = "h2_center">view events here</h2>
    <button onclick="location.href='view_atten.php'">view my atten</button>
</body>

</html> -->
<body class="admin-body">

    <!-- Side Navigation -->
    <?php include '../components/sidenav2.php'; ?>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Top Bar -->

        <?php
            $pageTitle = "Current Events"; // or "Member" etc.
            include '../components/topbar.php';?>

        <!-- Main Content -->
        <main class="content">

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
                                <!-- <a class="action-btn edit" href="edit_event.php?id=<?= urlencode($row['event_id']); ?>" title="Edit">
                                    <span class="material-symbols-rounded">edit</span>
                                </a>
                                <a class="action-btn delete" href="delete_event.php?id=<?= urlencode($row['event_id']); ?>" title="Delete" onclick="return confirm('Delete this event?');">
                                    <span class="material-symbols-rounded">delete</span>
                                </a> -->
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>

        </main>
    </div>

</body>
