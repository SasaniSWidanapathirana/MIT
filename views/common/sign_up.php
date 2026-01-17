<?php
session_start();

require_once '../../config/db.php';
require_once '../../models/user.php';

$db = new Database();
$conn = $db->connect();
$userObj = new User($conn);

$error = "";

if (isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $nic = trim($_POST['nic']);
    $role = trim($_POST['role']);
    $password = trim($_POST['password']);

    // Simple validation
    if (empty($name) || empty($email) || empty($nic) || empty($role) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Register user
        $result = $userObj->register($name, $nic, $email, $password, $role);

        if ($result) {
            // Registration successful, log in the user automatically
            $user = $userObj->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] == 1) {
                    header("Location: ../admin/admin_panel.php");
                    exit;
                } elseif ($user['role'] == 2) {
                    header("Location: ../voulnteer/volunteer_panel.php");
                    exit;
                } elseif ($user['role'] == 11) {
                    header("Location: app_pending.php");
                    exit;
                }
                
            } else {
                $error = "Login failed after registration.";
            }
        } else {
            $error = "Registration failed. Email might already exist.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/login.css">
    <title>Sign Up</title>
</head>
<body class="body">

<div class="bg-container">
    <?php include '../components/header.php'; ?>

    <?php if ($error != ""): ?>
        <p class="login_error"><?php echo $error; ?></p>
    <?php endif; ?>

    <h1 class="login_title">Create Your Account</h1>
    <p class="login_subtitle">Fill in your details below to sign up</p>
    <br/>

    <form method="POST" action="" class="login_form">

        <label for="name">Name</label>
        <input type="name" name="name" id="name" placeholder="Enter your Name" required>

        <br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>

        <br>

        <label for="nic">NIC</label>
        <input type="nic" name="nic" id="nic" placeholder="Enter your NIC" required>

        <br>

        <label for="role">Role</label>
        <select name="role" id="role" required>
            <option value="">Select Role</option>
            <option value="11">Admin</option>
            <option value="2">Volunteer</option>
        </select>

        <br>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
        <br/><br/>

        <input type="submit" class="login_button" name="signup" value="Sign Up">
        <a href="login.php" class="login_button" style="text-decoration:none; text-align:center; display:flex; justify-content:center; align-items:center;">
            Sign In
        </a>
        <a href="../../index.php" class="login_button" style="text-decoration:none; text-align:center; display:flex; justify-content:center; align-items:center;">
            Back
        </a>
    </form>

    <br/><br/><br/><br/><br/>

    <div class="footer">
        <?php include '../components/footer.php'; ?>
    </div>

</div>

</body>
</html>