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
    <?php include '../components/sidenav.php'; ?>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Top Bar -->
        <?php
            $pageTitle = "My Profile"; 
            include '../components/topbar.php';?>

        <!-- Main Content -->
        <main class="content">
<div class="profile-card">
    <h2>My Profile</h2>

    <!-- PROFILE PHOTO -->
    <div class="profile-photo">
        <img id="profileImg" src="../../public/images/profile.jpeg" alt="Profile Photo">
        <br>
        <label class="change-photo-btn">
            Change Photo
            <input type="file" accept="image/*" onchange="changePhoto(event)">
        </label>
    </div>

    <!-- PROFILE FIELDS -->
    <div class="profile-field">
        <div class="field-label">Name</div>
        <div class="field-value" id="nameField">John Doe</div>
        <div class="field-actions">
            <i class="fa-solid fa-pen" onclick="editField('nameField')"></i>
        </div>
    </div>

    <div class="profile-field">
        <div class="field-label">NIC</div>
        <div class="field-value" id="nicField">123456789V</div>
        <div class="field-actions">
            <i class="fa-solid fa-pen" onclick="editField('nicField')"></i>
        </div>
    </div>

    <div class="profile-field">
        <div class="field-label">Email</div>
        <div class="field-value" id="emailField">johndoe@example.com</div>
        <div class="field-actions">
            <i class="fa-solid fa-pen" onclick="editField('emailField')"></i>
        </div>
    </div>

    <div class="profile-field">
        <div class="field-label">Password</div>
        <div class="field-value" id="passwordField">********</div>
        <div class="field-actions">
            <i class="fa-solid fa-pen" onclick="editField('passwordField')"></i>
        </div>
    </div>

    <a href="#" class="back-btn">Back to Dashboard</a>
</div>

<script>
function changePhoto(event){
    document.getElementById('profileImg').src =
        URL.createObjectURL(event.target.files[0]);
}

function editField(id){
    const field = document.getElementById(id);
    const value = prompt("Edit value", field.textContent);
    if(value && value.trim() !== ""){
        field.textContent = value;
    }
}
</script>

</body>
</html>