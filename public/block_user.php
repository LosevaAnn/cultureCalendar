<?php
require_once ('db.php');
$email = $_GET['email'];
$sql = "UPDATE users SET access = 1 WHERE email='$email'";

if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header('Location: users.php');
    exit;
} else {
    echo "Error deleting record";
}