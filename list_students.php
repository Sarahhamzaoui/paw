<?php
require "db_connect.php";

$students = $conn->query("SELECT * FROM students")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {
    font-family: Arial, sans-serif;
    background: #ffe6f2;
    margin: 0;
    padding: 0;
}
.container {
    width: 80%;
    margin: 50px auto;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0px 0px 15px rgba(255, 0, 120, 0.25);
}
h2 {
    text-align: center;
    color: #d63384;
    margin-bottom: 25px;
}
table {
    width: 100%;
    border-collapse: collapse;
}
th {
    background: #ffb3d9;
    color: #5a0032;
    padding: 12px;
    font-size: 16px;
}
td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ffd6e8;
}
tr:hover {
    background: #ffe6f7;
    transition: 0.3s;
}
.action-btn {
    padding: 8px 14px;
    border-radius: 8px;
    color: white;
    text-decoration: none;
    font-size: 14px;
}
.edit {
    background: #1e90ff;
}
.edit:hover {
    background: #0067c0;
}
.delete {
    background: #d63384;
}
delete:hover {
    background: #b82d6f;
}
.back-btn {
    display: block;
    width: 200px;
    margin: 20px auto;
    background: #d63384;
    border-radius: 8px;
    padding: 12px;
    color: white;
    text-align: center;
    font-size: 16px;
    text-decoration: none;
    transition: 0.3s;
}
.back-btn:hover {
    background: #b82d6f;
}
</style>
</head>
<body>

<div class="container">
<h2>📋 List of Students</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Matricule</th>
        <th>Group</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($students as $s): ?>
    <tr>
        <td><?= $s["id"] ?></td>
        <td><?= $s["fullname"] ?></td>
        <td><?= $s["matricule"] ?></td>
        <td><?= $s["group_id"] ?></td>
        <td>
            <a class="action-btn edit" href="update_student.php?id=<?= $s['id'] ?>">✏ Edit</a>
            <a class="action-btn delete" href="delete_student.php?id=<?= $s['id'] ?>" onclick="return confirm('Delete this student?')">🗑 Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<a href="add_student.php" class="back-btn">➕ Add New Student</a>
</div>

</body>
</html>
