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
                    <option value="volunteer">Volunteer</option>
                    <option value="admin">Admin</option>
                </select>

                <label for="name">Name</label>
                <input type="text" id="name" name="userName" required>

                <!-- <label>Field Count</label>
                <input type="number" name="field" id="field" min="0" required>  -->
                
                <label for="nic">NIC</label>
                <input type="text" id="nic" name="userNIC" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="userEmail" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="userPassword" required>

                <label for="userRStatus">Status</label>
                <select id="userStatus" name="userStatus" required>
                    <option value="available">Available</option>
                    <option value="not_available">Not Available</option>
                    <option value="temporary_unavailable">Temporary Unavailable</option>
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
                        <input type="hidden" name="user_id" id="edit_user_id">

                        <label for="userRole">Role</label>
                            <select id="userRole" name="userRole" required>
                                <option value="volunteer">Volunteer</option>
                                <option value="admin">Admin</option>
                            </select>

                        <label>Name</label>
                        <input type="text" name="userName" id="edit_userName" required>
                        
                        <label>NIC</label>
                        <input type="text" name="userNIC" id="edit_userNIC" required>
                        <label>Email</label>
                        <input type="email" name="userEmail" id="edit_userEmail" required>
                        
                        <label>Field Count</label>
                        <input type="number" name="field" id="edit_field" min="0" required> 
                        <button type="submit">Update</button>
                    </form>
                </div>
            </div>

            <div class="event-table-wrapper">
                <table class="event-table"> 
                    <tr>
                      <!--  <th>User_id</th> -->
                        <th>NIC</th>
                        <th>Email</th>
                       <!-- <th>Password</th> -->   
                        <th>Role</th>
                        <th>Field Count</th>
                      <!--  <th>Status</th> --> 
                        <th>Actions</th>

                    </tr>

        <?php 
        // Correct PDO fetch method
        while ($row = $users->fetch(PDO::FETCH_ASSOC)) : 
        ?>
            <tr>
              <!--  <td><?= htmlspecialchars($row['user_id']); ?></td> -->
                <td><?= htmlspecialchars($row['nic']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
              <!--   <td><?= htmlspecialchars($row['password']); ?></td> -->
                <td><?= htmlspecialchars($row['role']); ?></td>
                <td><?= htmlspecialchars($row['field']); ?></td>
              <!--  <td><?= htmlspecialchars($row['status']); ?></td> -->

                  <td class="action-cell">

                                <a class="action-btn edit"
                                href="#"
                                data-id="<?= htmlspecialchars($row['user_id']); ?>"
                                data-nic="<?= htmlspecialchars($row['nic']); ?>"
                                data-email="<?= htmlspecialchars($row['email']); ?>"
                                data-field="<?= htmlspecialchars($row['field']); ?>">
                                    <span class="material-symbols-rounded">edit</span>
                                </a>
                                <a class="action-btn delete" href="delete_user.php?id=<?= urlencode($row['user_id']); ?>"
                                title="Delete" onclick="return confirm('Are you sure you want to delete this user?');">
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