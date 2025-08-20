<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}


include 'database.php';

if (isset($_GET['roll'])) {
    $roll = $_GET['roll'];
    $sql = "DELETE FROM students WHERE `Roll No` = '$roll'";
    $conn->query($sql);
}

header("Location: index.php");
exit;
?>
