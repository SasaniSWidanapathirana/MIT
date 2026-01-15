<?php
require_once '../../config/db.php';
require_once '../../models/user.php';

$db = (new Database())->connect();
$userObj = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['user_id'];
    $nic = $_POST['userNIC'];
    $email = $_POST['userEmail'];
    $role = $_POST['userRole'];
    $field = $_POST['field'];

    $userObj->updateUser(
        $id,
        $nic,
        $email,
        $role,
        $field
    );
// Redirect back to members page after update
    header("Location: members.php?updated=1");
    exit;
}
?>