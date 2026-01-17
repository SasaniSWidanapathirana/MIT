<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile - Volunteer Event Management</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Inter',sans-serif;
    background:linear-gradient(to right,#ffffff,);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
}

/* PROFILE CARD */
.profile-card{
    width:100%;
    max-width:550px;      /* increased size */
    background:#FFCC99;
    border-radius:25px;
    padding:50px 35px;    /* increased padding */
    box-shadow:0 25px 50px rgba(0,0,0,0.15);
    transition:0.3s;
}

.profile-card:hover{
    box-shadow:0 30px 60px rgba(0,0,0,0.2);
}

/* TITLE */
.profile-card h2{
    font-size:2rem;
    margin-bottom:30px;
    text-align:center;
    color:#404040;
}

/* PROFILE PHOTO */
.profile-photo{
    text-align:center;
    margin-bottom:30px;
}

.profile-photo img{
    width:150px;           /* bigger photo */
    height:150px;
    border-radius:50%;
    border:6px solid #ff8000;
    object-fit:cover;
    transition:0.3s;
}

.profile-photo img:hover{
    transform:scale(1.05);
}

/* CHANGE PHOTO BUTTON */
.change-photo-btn{
    display:inline-block;
    margin-top:12px;
    padding:10px 22px;
    background:#ff9933;
    color:#fff;
    border-radius:30px;
    cursor:pointer;
    font-weight:600;
    font-size:14px;
    transition:0.3s;
}

.change-photo-btn:hover{
    background:#ff8000;
}

.change-photo-btn input{
    display:none;
}

/* PROFILE FIELDS */
.profile-field{
    display:flex;
    align-items:center;
    gap:12px;
    background:#f9f9f9;
    border-radius:15px;
    padding:15px 18px;
    margin-top:15px;
}

.field-label{
    font-weight:600;
    width:90px;
    font-size:15px;
    color:#202020;
}

.field-value{
    flex:1;
    font-size:15px;
    color:#505050;
    word-break:break-word;
}

/* EDIT ICON */
.field-actions i{
    color:#ff8000;
    cursor:pointer;
    font-size:16px;
    transition:0.3s;
}

.field-actions i:hover{
    transform:scale(1.2);
}

/* BACK BUTTON */
.back-btn{
    display:block;
    margin:35px auto 0;
    padding:12px 28px;
    background:#ff9933;
    color:#fff;
    border-radius:30px;
    text-decoration:none;
    font-weight:600;
    font-size:15px;
    width:max-content;
    transition:0.3s;
}

.back-btn:hover{
    background:#ff8000;
}

/* RESPONSIVE */
@media(max-width:600px){
    .profile-card{
        padding:35px 25px;
    }
    .profile-photo img{
        width:120px;
        height:120px;
    }
    .field-label{
        width:75px;
        font-size:14px;
    }
    .field-value{
        font-size:14px;
    }
    .change-photo-btn, .back-btn{
        padding:8px 18px;
        font-size:13px;
    }
}
</style>
</head>

<body>

<div class="profile-card">
    <h2>My Profile</h2>

    <!-- PROFILE PHOTO -->
    <div class="profile-photo">
        <img id="profileImg" src="../../public/images/images.png" alt="Profile Photo">
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