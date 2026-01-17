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

$pendingevents      = $db->query("SELECT COUNT(*) FROM events WHERE date_time > NOW()")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/public/js/addEvent.js"></script>
    <script src="/public/js/editEvent.js"></script>
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
            $pageTitle = "Current Events"; // or "Member" etc.
            include '../components/topbar.php';?>

            <div class="stats-bar">
<div class="stat-box">
                <h4>Pending Events</h4>
               <div class="innerbox" style="background: #dcf3ff;"><div class="iconvalue" ><span class="material-symbols-rounded" style="background: #0078d4;">user_attributes</span>
                <span class="label">
                    count :
                </span>

               <span class="value"><?= $pendingevents; ?></span></div></div> 
            </div></div>

        <!-- Main Content -->
        <main class="content" style="margin: 20px;">

            <div class="div">
                <div class="div create-event-bar">
                <button id="openPanelBtn" class="create-btn">
                    <span class="material-symbols-rounded">add_2</span>
                    Create Event
                </button>
                </div>

                <div id="sidePanel" class="side-panel">
                    <button id="closePanelBtn" class="close-btn">
                        <span class="material-symbols-rounded">close</span>
                    </button>

                    <h3 class="createFormTitle">
                        <span class="material-symbols-rounded">add_2</span>
                        Create Event
                    </h3>

                    <form id="form-container" method="POST" action="add_event.php">
                        <label>Name</label>
                        <input type="text" name="eventName" required>

                        <label>Date</label>
                        <input type="date" name="eventDate" required>

                        <label>Time</label>
                        <input type="time" name="eventTime" required>

                        <label>Location</label>
                        <input type="text" name="location" required>

                        <label>Participant Count</label>
                        <input type="number" name="count" min="1" required>

                        <label>Description</label>
                        <textarea name="eventDescription"></textarea>

                        <button type="submit">Create</button>
                    </form>
                </div>

                <!-- EDIT EVENT SLIDER -->
                <div id="editSidePanel" class="side-panel">
                    <button id="closeEditPanelBtn" class="close-btn">
                        <span class="material-symbols-rounded">close</span>
                    </button>

                    <h3 class="createFormTitle">
                        <span class="material-symbols-rounded">edit</span>
                        Edit Event
                    </h3>

                    <form id="form-container" method="POST" action="edit_event.php">
                        <input type="hidden" name="event_id" id="edit_event_id">

                        <label>Name</label>
                        <input type="text" name="eventName" id="edit_eventName" required>

                        <label>Date</label>
                        <input type="date" name="eventDate" id="edit_eventDate" required>

                        <label>Time</label>
                        <input type="time" name="eventTime" id="edit_eventTime" required>

                        <label>Location</label>
                        <input type="text" name="location" id="edit_location" required>

                        <label>Participant Count</label>
                        <input type="number" name="count" id="edit_count" min="1" required>

                        <label>Description</label>
                        <textarea name="eventDescription" id="edit_eventDescription"></textarea>

                        <button type="submit">Update</button>
                    </form>
                </div>

            </div>

            <div class="event-table-wrapper">
                <table class="event-table">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date & Time</th>
                        <th>Location</th>
                        <th>Expected Count</th>
                        <th>Actions</th>
                    </tr>

                    <?php while ($row = $events->fetch(PDO::FETCH_ASSOC)) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['title']); ?></td>
                            <td><?= htmlspecialchars($row['description']); ?></td>
                            <td><?= htmlspecialchars($row['date_time']); ?></td>
                            <td><?= htmlspecialchars($row['location']); ?></td>
                            <td><?= htmlspecialchars($row['exp_cnt']); ?></td>
                            <td class="action-cell">
                               
                                <a class="action-btn edit"
                                href="#"
                                data-id="<?= $row['event_id']; ?>"
                                data-title="<?= htmlspecialchars($row['title']); ?>"
                                data-description="<?= htmlspecialchars($row['description']); ?>"
                                data-datetime="<?= $row['date_time']; ?>"
                                data-location="<?= htmlspecialchars($row['location']); ?>"
                                data-count="<?= $row['exp_cnt']; ?>">
                                <span class="material-symbols-rounded">edit</span>
                                </a>

                                <a class="action-btn delete" href="delete_event.php?id=<?= urlencode($row['event_id']); ?>" 
                                onclick="return confirm('Are you sure you want to delete this event?')" 
                                title="Delete">
                                    <span class="material-symbols-rounded">delete</span>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>

        </main>
    </div>

</body>