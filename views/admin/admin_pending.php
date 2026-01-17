<?php 
// Load DB + Model
require_once '../../config/db.php';
require_once '../../models/user.php';

// DB Connection
$database = new Database();
$db = $database->connect();

// Load ONLY Admin & Pending Admin users
$users = $db->query("SELECT * FROM users WHERE role IN (1, 11)");

// User counts
$totalUsers         = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
$totalAdmins        = $db->query("SELECT COUNT(*) FROM users WHERE role = 1")->fetchColumn();
$totalVolunteers    = $db->query("SELECT COUNT(*) FROM users WHERE role = 2")->fetchColumn();
$pendingAdmins      = $db->query("SELECT COUNT(*) FROM users WHERE role = 11")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
    <script src="/../public/js/addUser.js"></script>
    <script src="/../public/js/editUser.js"></script>
    <title>Admin Screen</title>
</head>

<body class="admin-body">

<!-- Side Navigation -->
<?php include '../components/sidenav.php'; ?>

<!-- Main Wrapper -->
<div class="main-wrapper">

<?php
$pageTitle = "Users";
include '../components/topbar.php';
?>

<!-- Stats -->
<div class="stats-bar">
    <div class="stat-box">
        <h4>Pending Admins</h4>
        <div class="innerbox" style="background:#ffe4dc;">
            <div class="iconvalue">
                <span class="material-symbols-rounded" style="background:#ff5174;">person_alert</span>
                <span class="label" style="font-size:24px; color:#1E3E62;">count :</span>
                <span class="value" style="font-size:32px;"><?= $pendingAdmins; ?></span>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<main class="content" style="margin:20px;">

<div class="create-event-bar">
    <button id="openPanelBtn" class="create-btn">
        <span class="material-symbols-rounded">add_2</span>
        Create User
    </button>
</div>

<!-- Create User Panel -->
<div id="sidePanel" class="side-panel">
    <button id="closePanelBtn" class="close-btn">
        <span class="material-symbols-rounded">close</span>
    </button>

    <h3 class="createFormTitle">
        <span class="material-symbols-rounded">add_2</span>
        Create User
    </h3>

    <form id="form-container" method="POST" action="add_user.php">
        <label>Role</label>
        <select name="userRole" required>
            <option value="2">Volunteer</option>
            <option value="1">Admin</option>
        </select>

        <label>Name</label>
        <input type="text" name="userName" required>

        <label>NIC</label>
        <input type="text" name="userNIC" required>

        <label>Email</label>
        <input type="email" name="userEmail" required>

        <label>Password</label>
        <input type="password" name="userPassword" required>

        <label>Status</label>
        <select name="userStatus" required>
            <option value="0">Available</option>
            <option value="1">Not Available</option>
            <option value="2">Temporary Unavailable</option>
        </select>

        <button type="submit">Create</button>
    </form>
</div>

<!-- Users Table -->
<div class="event-table-wrapper">
<table class="event-table">
<tr>
    <th>Name</th>
    <th>NIC</th>
    <th>Email</th>
    <th>Approval</th>
    <th>Actions</th>
</tr>

<?php
$roleNames = [
    1  => 'Admin',
    11 => 'Admin (Pending)'
];

while ($row = $users->fetch(PDO::FETCH_ASSOC)) :
?>
<tr>
    <td><?= htmlspecialchars($row['name']); ?></td>
    <td><?= htmlspecialchars($row['nic']); ?></td>
    <td><?= htmlspecialchars($row['email']); ?></td>
    <td style="text-align:center;">
    <label class="switch">
    <input type="checkbox"
           class="approval-toggle"
           data-user-id="<?= $row['user_id']; ?>"
           <?= ($row['role'] == 1) ? 'checked' : ''; ?>>
    <span class="slider"></span>
</label>
</td>


    <td class="action-cell">
        <a href="#" class="action-btn edit"
           data-id="<?= $row['user_id']; ?>"
           data-name="<?= htmlspecialchars($row['name']); ?>"
           data-nic="<?= htmlspecialchars($row['nic']); ?>"
           data-email="<?= htmlspecialchars($row['email']); ?>"
           data-role="<?= $roleNames[$row['role']]; ?>">
            <span class="material-symbols-rounded">edit</span>
        </a>

        <a href="delete_user.php?id=<?= urlencode($row['user_id']); ?>"
           class="action-btn delete"
           onclick="return confirm('Are you sure you want to delete this user?');">
            <span class="material-symbols-rounded">delete</span>
        </a>
    </td>
</tr>
<?php endwhile; ?>

</table>
</div>

</main>
</div>
<script>
document.querySelectorAll('.approval-toggle').forEach(toggle => {
    toggle.addEventListener('change', function () {

        const userId = this.dataset.userId;
        const newRole = this.checked ? 1 : 11;

        fetch('update_approval_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `user_id=${userId}&role=${newRole}`
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                // refresh the page after successful update
                location.reload();
            } else {
                alert('Failed to update status');
                this.checked = !this.checked; // revert toggle
            }
        })
        .catch(() => {
            alert('Server error');
            this.checked = !this.checked;
        });
    });
});

</script>

</body>
</html>