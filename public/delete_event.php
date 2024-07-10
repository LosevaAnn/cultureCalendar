<?php
require_once ('db.php');
ob_start();
$id_event=$_GET['id_event'];
//$id_event = $_GET['id_event'];
$sql = "DELETE FROM events WHERE id_event='$id_event'";
mysqli_query($conn, $sql);

$sql1= "DELETE FROM `events-category` WHERE id_event='$id_event'";
mysqli_query($conn, $sql1);

$sql2= "DELETE FROM `events-place` WHERE id_event='$id_event'";
$result2 = mysqli_query($conn,$sql2);
mysqli_query($conn, $sql2);

$sql3= "DELETE FROM `events-date` WHERE id_event='$id_event'";
mysqli_query($conn, $sql3);
header("location: admin.php");

