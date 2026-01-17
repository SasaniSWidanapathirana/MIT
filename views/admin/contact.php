<?php 
// Load DB + Model
require_once '../../config/db.php';
require_once '../../models/event.php';

// DB Connection
$database = new Database();
$db = $database->connect();

// Load events
$past_eventObj = new Event($db);
$past_events = $past_eventObj->getPastEvents();

$pendingevents      = $db->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style.css">
    <title>Admin Screen</title> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/../public/js/addEvent.js"></script>
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
    <title>Admin Panel</title>
</head>

<body class="admin-body">
        <!-- Side Navigation -->
    <?php include '../components/sidenav.php'; ?>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Top Bar -->
        <?php
            $pageTitle = "Past Events"; // or "Member" etc.
            include '../components/topbar.php';?>

<div class="stats-bar">
<div class="stat-box">
                <h4>Contact Count</h4>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>message</th>
                        <th>created at</th>

                    </tr>

                    <?php while ($row = $past_events->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <!-- <td><?= htmlspecialchars($row['id']); ?></td> -->
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['subject']); ?></td>
                            <td><?= htmlspecialchars($row['message']); ?></td>
                            <td><?= htmlspecialchars($row['created_at']); ?></td>
                            
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>

        </main>
    </div>

</body>