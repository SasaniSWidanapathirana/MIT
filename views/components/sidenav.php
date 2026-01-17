<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../../public/css/sidenav.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />

</head>
<body>
    <div class="sidenav">

        <div class="logo">
        <a href="../../index.php">
            <img src="/../../public/images/logo2.png">   
        </a>
        </div>


        <?php
        $currentPage = basename($_SERVER['PHP_SELF']); // gets current file name
        ?>
        <div class="menu">
            <a href='../admin/admin_panel.php' class="<?= $currentPage == 'admin_panel.php' ? 'active' : '' ?>">
                <span class="material-symbols-rounded">event</span>Current Events
            </a>

            <a href='../admin/past_event.php' class="<?= $currentPage == 'past_event.php' ? 'active' : '' ?>">
                <span class="material-symbols-rounded">event_available</span>Past Events
            </a>

            <a href='../admin/members.php' class="<?= $currentPage == 'members.php' ? 'active' : '' ?>">
                <span class="material-symbols-rounded">person</span>Users
            </a>

            <a href="#contact" class="<?= $currentPage == 'contact.php' ? 'active' : '' ?>">
                <span class="material-symbols-rounded">call</span>Contact
            </a>
            <a href="../common/profile.php" class="<?= $currentPage == 'profile.php' ? 'active' : '' ?>">
            <span class="material-symbols-rounded">
            person
            </span>Profile</a>
            
        </div>

        
    </div>
</body>
</html>