<?php
// Start session if using logged-in info later
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Volunteer Management System</title>
    <link rel="stylesheet" href="../../public/css/sidenav.css">
    <link rel="stylesheet" href="../../public/css/contact.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
</head>
<body>
    <div class="bg-container" >
        <?php include '../components/header.php'; ?>

    

        <main class="content">
            <div class="contact-wrapper">
                <h2>Contact Us</h2>
                <p>If you have any questions or want to volunteer, please fill out the form below.</p>

                <?php
                if (isset($_GET['success'])) {
                    echo '<div class="success">Message sent successfully!</div>';
                } elseif (isset($_GET['error'])) {
                    echo '<div class="error">Something went wrong. Try again.</div>';
                }
                ?>

                <form action="../../controller/contactSubmit.php" method="POST" class="contact-form">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" required placeholder="Your Name">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required placeholder="Your Email">

                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="subject" required placeholder="Subject">

                    <label for="message">Message</label>
                    <textarea name="message" id="message" rows="6" required placeholder="Write your message here..."></textarea>

                    <button type="submit">Send Message</button>
                </form>
            </div>
        </main>
    </div>
<div class="footer">
        <?php include '../components/footer.php'; ?>
    </div>
</body>
</html>
