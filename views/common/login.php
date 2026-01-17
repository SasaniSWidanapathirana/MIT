<?php
session_start();

require_once '../../config/db.php';
require_once '../../models/user.php';

$db = new Database();
$conn = $db->connect();
$userObj = new User($conn);

$error = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $userObj->getAllUsers();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $found = false;

    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            $found = true;

            if ($user['status'] == 0) {
                $error = "Your account is inactive. Contact admin.";
            } else {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 1) {
                   header("Location: ../admin/admin_panel.php");
                }  elseif ($user['role'] == 2) {
                    header("Location: ../voulnteer/volunteer_panel.php");
                }
                exit;
            }
            break;
        }
    }

    if (!$found) {
        $error = "Invalid email or password.";
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
    <title>Login Page</title>
</head>
<body class="body">

<div class="bg-container">
    <?php include '../components/header.php'; ?>

    <?php if ($error != ""): ?>
        <p class="login_error"><?php echo $error; ?></p>
    <?php endif; ?>

    <h1 class="login_title">Welcome Back</h1>
    <p class="login_subtitle">
        Please log in to access the maintenance management system.
    </p>
<br/><br/><br/>
        <form method="POST" action="" class="login_form">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>

        <br>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
<br/><br/>
        <input class="login_button" type="submit" name="login" value="Login">
    </form>
        <button class="login_button" onclick="location.href='sign_up.php'">
        sign up
    </button>
    <button class="login_button" onclick="location.href='../../index.php'">
        Back
    </button><br/><br/><br/><br/><br/>

    <div class="footer">
        <?php include '../components/footer.php'; ?>
    </div>

</div>

</body>
</html>