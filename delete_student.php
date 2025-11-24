<?php
require "db_connect.php";

if (!isset($_GET["id"])) {
    die("⚠ Missing student ID!");
}

$id = $_GET["id"];

// Fetch student info
$sql = $conn->prepare("SELECT * FROM students WHERE id=?");
$sql->execute([$id]);
$student = $sql->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("⚠ Student not found!");
}

// If confirmation submitted
if (isset($_POST["confirm"])) {
    $delete = $conn->prepare("DELETE FROM students WHERE id=?");
    $delete->execute([$id]);
    $message = "🗑 Student deleted successfully!";
}
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
    width: 45%;
    margin: 80px auto;
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0px 0px 15px rgba(255, 0, 120, 0.25);
    text-align: center;
}
h2 {
    color: #d63384;
    margin-bottom: 25px;
}
.name {
    font-size: 20px;
    color: #5a0032;
    margin: 10px 0 25px 0;
}
button {
    width: 45%;
    padding: 12px;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
    border: none;
    color: white;
    transition: 0.3s;
    margin: 8px;
}
.delete-btn {
    background: #d63384;
}
.delete-btn:hover {
    background: #b82d6f;
}
.cancel-btn {
    background: #6c757d;
}
.cancel-btn:hover {
    background: #495057;
}
.message {
    font-size: 18px;
    margin-bottom: 15px;
    color: #2b8a3e;
}
</style>
</head>
<body>

<div class="container">
<?php if (isset($message)) { ?>
    <h2 class="message"><?= $message ?></h2>
    <a href="list_students.php">
        <button class="cancel-btn" style="width:80%">⬅ Back to List</button>
    </a>
<?php } else { ?>
    <h2>Delete Student</h2>
    <div class="name">
        Are you sure you want to delete:<br><br>
        <b><?= $student['fullname'] ?></b> (<?= $student['matricule'] ?>)
    </div>

    <form method="POST">
        <button type="submit" name="confirm" class="delete-btn">🗑 Yes, Delete</button>
        <a href="list_students.php"><button type="button" class="cancel-btn">❌ Cancel</button></a>
    </form>
<?php } ?>
</div>

</body>
</html>
