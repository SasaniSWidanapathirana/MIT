<?php
require_once '../../config/db.php';
require_once '../../models/user.php';

$db = (new Database())->connect();
$userObj = new User($db);
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if ($userObj->deleteUser($id)) {
        header("Location: members.php?deleted=1");
        exit;
    }
}
header("Location: members.php?error=1");
exit;
?>