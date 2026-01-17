<?php 
    // Load DB + Model
    require_once '../../config/db.php';
    require_once '../../models/user.php';

    // DB Connection
    $database = new Database();
    $db = $database->connect();

    // Load users
    $userObj = new User($db);
    $users = $userObj->getAllUsers();
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

            <!-- Top Bar -->

            <?php
            
                $pageTitle = "Users"; // or "Member" etc.
                include '../components/topbar.php';?>


        <div class="stats-bar">
            <div class="stat-box">
                <h4>All Users</h4>
               <div class="innerbox" style="background: #dcf3ff;"><div class="iconvalue" ><span class="material-symbols-rounded" style="background: #0078d4;">user_attributes</span>
                <span class="label">
                    count :
                </span>

               <span class="value"><?= $totalUsers; ?></span></div></div> 
            </div>

            <div class="stat-box">
                <h4>Admins</h4>
                               <div class="innerbox" style="background: #fffaea;"><div class="iconvalue"><span class="material-symbols-rounded" style="background: #ffa500;">manage_accounts</span>
                <span class="label">
                    count :
                </span>

               <span class="value"><?= $totalAdmins; ?></span></div></div>
                
            </div>

            <div class="stat-box">
                <h4>Volunteers</h4>
                <div class="innerbox" style="background: #eaffed;"><div class="iconvalue"><span class="material-symbols-rounded" style="background: #15ae89;">person_raised_hand</span>
                <span class="label">
                    count :
                </span>

               <span class="value"><?= $totalVolunteers; ?></span></div></div>
            </div>

            <div class="stat-box">
                <h4>Pending Admins</h4>
                <div class="innerbox" style="background: #ffe4dc;"><div class="iconvalue"><span class="material-symbols-rounded" style="background: #ff5174;">person_alert</span>
                <span class="label">
                    count :
                </span>

               <span class="value"><?= $pendingAdmins; ?></span></div></div>
            </div>

            
        </div>

            <!-- Main Content -->
        <main class="content">

                <div class="div">
                    <div class="div create-event-bar">
                    <button id="openPanelBtn" class="create-btn">
                        <span class="material-symbols-rounded">add_2</span>
                        Create User
                    </button>
                    </div>

                    <div id="sidePanel" class="side-panel">
                        <button id="closePanelBtn" class="close-btn">
                            <span class="material-symbols-rounded">close</span>
                        </button>

                        <h3 class="createFormTitle">
                            <span class="material-symbols-rounded">add_2</span>
                            Create User
                        </h3>

                <form id="form-container" method="POST" action="add_user.php">

                    <label for="userRole">Role</label>
                    <select id="userRole" name="userRole" required>
                        <option value="2">Volunteer</option>
                        <option value="1">Admin</option>
                    </select>


                    <label for="name">Name</label>
                    <input type="text" id="name" name="userName" required>
                    
                    <label for="nic">NIC</label>
                    <input type="text" id="nic" name="userNIC" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="userEmail" required>
                    
                    <label for="password">Password</label>
                    <input type="password" id="password" name="userPassword" required>

                    <label for="userStatus">Status</label>
                    <select id="userStatus" name="userStatus" required>
                        <option value="0">Available</option>
                        <option value="1">Not Available</option>
                        <option value="2">Temporary Unavailable</option>
                    </select>

                    <button type="submit">Create</button>

                </form>
            </div> 
    
                <!--Edit Form -->
                    <div id="editSidePanel" class="side-panel">
                        <button id="closeEditPanelBtn" class="close-btn">
                            <span class="material-symbols-rounded">close</span>
                        </button>

                        <h3 class="createFormTitle">
                            <span class="material-symbols-rounded">edit</span>
                            Edit User
                        </h3>

                        <form id="form-container" method="POST" action="edit_user.php">
                            <input type="hidden" name="user_id" id="edit_userID">

                        <label>Role</label>
                            <input type="text" id="edit_userRole" name="edit_userRole" readonly>


                            <label>Name</label>
                            <input type="text" name="userName" id="edit_userName" required>
                            
                            <label>NIC</label>
                            <input type="text" name="userNIC" id="edit_userNIC" required>
                            <label>Email</label>
                            <input type="email" name="userEmail" id="edit_userEmail" required>
                            
                    
                            <button type="submit">Update</button>
                        </form>
                    </div>
                </div>

                <div class="event-table-wrapper">
                    <table class="event-table"> 
                        <tr>
                            <th>Name</th>
                        
                            <th>NIC</th>
                            <th>Email</th>
                        
                            <th>Role</th>
                        <th>Status</th>
                            <th>Actions</th>

                        </tr>

                            <?php 
                                $roleNames = [
                                    1 => 'Admin',
                                    2 => 'Volunteer',
                                    11 => 'Admin (Pending)',
                                    ];

                                $statusNames = [
                                    0 => 'Available',
                                    1 => 'Not Available',
                                    2 => 'Temporary Unavailable'
                                ];
                    ?>

                <?php while ($row = $users->fetch(PDO::FETCH_ASSOC)) : 
        
        $roleName = $roleNames[$row['role']] ?? 'Unknown';
        $statusName = $statusNames[$row['status']] ?? 'Unknown';
    ?>
    <tr>
        <td><?= htmlspecialchars($row['name']); ?></td>
        <td><?= htmlspecialchars($row['nic']); ?></td>
        <td><?= htmlspecialchars($row['email']); ?></td>
        <td><?= $roleName; ?></td>
        <td><?= $statusName; ?></td>
        <td class="action-cell">

        <a href="#" class="action-btn edit"
    data-id="<?= $row['user_id']; ?>"
    data-name="<?= htmlspecialchars($row['name']); ?>"
    data-nic="<?= htmlspecialchars($row['nic']); ?>"
    data-email="<?= htmlspecialchars($row['email']); ?>"
    data-role="<?= $roleNames[$row['role']]; ?>"
    data-status="<?= $row['status']; ?>">
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
    </body>
    </html>