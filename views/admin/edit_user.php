<?php
require_once '../../config/db.php';
require_once '../../models/user.php';

$db = (new Database())->connect();
$userObj = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['user_id'];
    $name = $_POST['userName'];
    $nic = $_POST['userNIC'];
    $email = $_POST['userEmail'];

    // Correct order
    $userObj->updateUser($id, $nic,$email, $name);

    header("Location: members.php?updated=1");
    exit;
}
header("Location: members.php?error=1");
exit;           
?>

