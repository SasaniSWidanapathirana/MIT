<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/../../public/css/topbar.css">

</head>
<body>
<?php
// Set a default title if $pageTitle is not provided
if (!isset($pageTitle)) {
    $pageTitle = "Add the page title here";
}
?>

<div class="topbar">
    <div class="topbar-left">
        <h2 class="page-title"><?php echo htmlspecialchars($pageTitle); ?></h2>
    </div>

    <div class="topbar-right">
        <div class="profile-dropdown">
            <button class="profile-btn">
                <img src="/../../public/images/user.svg" alt="Profile">
                <span class="material-symbols-rounded">
                    stat_minus_1
                </span>
            </button>

            <div class="dropdown-menu">
                <a href="../common/profile.php">My Profile</a>
                <div class="divider"></div>
                <a href="../../index.php" class="logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="/../../public/js/topbar.js"></script>
</body>
</html>