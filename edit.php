<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}


include 'database.php';

if (!isset($_GET['roll'])) {
    header("Location: index.php");
    exit;
}

$roll = $_GET['roll'];
$sql = "SELECT * FROM students WHERE `Roll No` = '$roll'";
$result = $conn->query($sql);
$student = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $rollno = $_POST['roll'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $update = "UPDATE students SET `Name`='$name', `Roll No`='$rollno', `email`='$email', `phone number`='$phone' 
               WHERE `Roll No`='$roll'";

    if ($conn->query($update) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">✏ Edit Student</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?= $student['Name'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Roll No</label>
            <input type="text" name="roll" class="form-control" value="<?= $student['Roll No'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $student['email'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Phone Number</label>
            <input type="text" name="phone" class="form-control" value="<?= $student['phone number'] ?>" required>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Back</a>
    </form>
</div>

</body>
</html>
