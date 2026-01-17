<?php
session_start();
require_once '../../config/db.php';
require_once '../../models/user.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/auth/login.php");
    exit;
}

$db = (new Database())->connect();
$userObj = new User($db);

// Get current user data
$user = $userObj->getUserById($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile - Volunteer Event Management</title>

<!-- Google Font -->
<link rel="stylesheet" href="../../public/css/admin.css">
<link rel="stylesheet" href="../../public/css/volunteer.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="../../public/css/profile.css">
</head>

<body class="admin-body">   
    <!-- Side Navigation -->
    <?php include '../components/sidenav2.php'; ?>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Top Bar -->
        <?php
            $pageTitle = "My Profile"; 
            include '../components/topbar.php';
        ?>

        <!-- Main Content -->
        <main class="content">
            <div class="profile-card">
                <h2>My Profile</h2>

                <?php if (isset($_GET['success'])): ?>
                    <div style="background: #4CAF50; color: white; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center;">
                        Profile updated successfully!
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['error'])): ?>
                    <div style="background: #f44336; color: white; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center;">
                        <?php 
                            $errorMsg = "An error occurred. Please try again.";
                            if ($_GET['error'] == 'missing_fields') {
                                $errorMsg = "Please fill in all required fields.";
                            } elseif ($_GET['error'] == 'invalid_email') {
                                $errorMsg = "Please enter a valid email address.";
                            } elseif ($_GET['error'] == 'update_failed') {
                                $errorMsg = "Failed to update profile. Please try again.";
                            } elseif ($_GET['error'] == 'email_exists') {
                                $errorMsg = "This email is already in use by another account.";
                            } elseif ($_GET['error'] == 'weak_password') {
                                $errorMsg = "Password must be at least 6 characters long.";
                            }
                            echo $errorMsg;
                        ?>
                    </div>
                <?php endif; ?>

                <!-- PROFILE PHOTO -->
                <div class="profile-photo">
                    <img id="profileImg" src="<?php echo !empty($user['profile_photo']) ? $user['profile_photo'] : '../../public/images/profile.jpeg'; ?>" alt="Profile Photo">
                    <br>
                    <label class="change-photo-btn">
                        Change Photo
                        <input type="file" accept="image/*" onchange="changePhoto(event)">
                    </label>
                </div>

                <!-- PROFILE FORM -->
                <form id="profileForm" method="POST" action="../../controller/update_profile.php">
                    <!-- NAME FIELD -->
                    <div class="profile-field">
                        <div class="field-label">Name</div>
                        <div class="field-value" id="nameField"><?php echo htmlspecialchars($user['name']); ?></div>
                        <input type="text" name="name" id="nameInput" value="<?php echo htmlspecialchars($user['name']); ?>" style="display:none; flex:1; padding:6px; border:1px solid #ddd; border-radius:6px; font-size:14px;">
                        <div class="field-actions">
                            <i class="fa-solid fa-pen" onclick="editField('name')"></i>
                        </div>
                    </div>

                    <!-- NIC FIELD -->
                    <div class="profile-field">
                        <div class="field-label">NIC</div>
                        <div class="field-value" id="nicField"><?php echo htmlspecialchars($user['nic']); ?></div>
                        <input type="text" name="nic" id="nicInput" value="<?php echo htmlspecialchars($user['nic']); ?>" style="display:none; flex:1; padding:6px; border:1px solid #ddd; border-radius:6px; font-size:14px;">
                        <div class="field-actions">
                            <i class="fa-solid fa-pen" onclick="editField('nic')"></i>
                        </div>
                    </div>

                    <!-- EMAIL FIELD -->
                    <div class="profile-field">
                        <div class="field-label">Email</div>
                        <div class="field-value" id="emailField"><?php echo htmlspecialchars($user['email']); ?></div>
                        <input type="email" name="email" id="emailInput" value="<?php echo htmlspecialchars($user['email']); ?>" style="display:none; flex:1; padding:6px; border:1px solid #ddd; border-radius:6px; font-size:14px;">
                        <div class="field-actions">
                            <i class="fa-solid fa-pen" onclick="editField('email')"></i>
                        </div>
                    </div>

                    <!-- PASSWORD FIELD -->
                    <div class="profile-field">
                        <div class="field-label">Password</div>
                        <div class="field-value" id="passwordField">********</div>
                        <input type="password" name="password" id="passwordInput" placeholder="Enter new password (leave blank to keep current)" style="display:none; flex:1; padding:6px; border:1px solid #ddd; border-radius:6px; font-size:14px;">
                        <div class="field-actions">
                            <i class="fa-solid fa-pen" onclick="editField('password')"></i>
                        </div>
                    </div>

                    <button type="submit" class="back-btn" style="border:none; cursor:pointer;">Save Changes</button>
                </form>

                <a href="dashboard.php" class="back-btn" style="margin-top:10px; background:#666;">Back to Dashboard</a>
            </div>
        </main>
    </div>

<script>
let isEditing = false;

function changePhoto(event){
    document.getElementById('profileImg').src = URL.createObjectURL(event.target.files[0]);
}

function editField(fieldName){
    const field = document.getElementById(fieldName + 'Field');
    const input = document.getElementById(fieldName + 'Input');
    
    if (!isEditing) {
        // Switch to edit mode
        field.style.display = 'none';
        input.style.display = 'block';
        input.focus();
        isEditing = true;
    }
}

// Allow clicking outside to save changes
document.addEventListener('click', function(e) {
    const inputs = ['nameInput', 'nicInput', 'emailInput', 'passwordInput'];
    
    inputs.forEach(inputId => {
        const input = document.getElementById(inputId);
        const fieldName = inputId.replace('Input', '');
        const field = document.getElementById(fieldName + 'Field');
        
        if (input.style.display === 'block' && !input.contains(e.target) && !e.target.classList.contains('fa-pen')) {
            if (fieldName !== 'password' && input.value.trim() !== '') {
                field.textContent = input.value;
            }
            field.style.display = 'block';
            input.style.display = 'none';
            isEditing = false;
        }
    });
});
</script>

</body>
</html>