<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
include 'database.php';

$sql = "SELECT `Name`, `Roll No`, `email`, `phone number` FROM students";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Student Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>📚 Student Records</h1>
        <div>
            <a href="add.php" class="btn btn-success">➕ Add Student</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <?php if ($result && $result->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>Name</th>
                    <th>Roll No</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['Name']) ?></td>
                        <td><?= htmlspecialchars($row['Roll No']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['phone number']) ?></td>
                        <td>
                            <a href="edit.php?roll=<?= urlencode($row['Roll No']) ?>" class="btn btn-warning btn-sm">✏ Edit</a>
                            <a href="delete.php?roll=<?= urlencode($row['Roll No']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this student?')">🗑 Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center text-muted">❌ No student records found.</p>
    <?php endif; ?>
</div>
</body>
</html>
