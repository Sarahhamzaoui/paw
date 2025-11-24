<?php
require "db_connect.php";

if (!isset($_GET["id"])) {
    die("⚠ Missing session ID!");
}

$session_id = $_GET["id"];

$sql = $conn->prepare("UPDATE attendance_sessions SET status='closed' WHERE id=?");
$sql->execute([$session_id]);

$message = "🔒 Session closed successfully!";
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
    padding: 35px;
    box-shadow: 0px 0px 15px rgba(255, 0, 120, 0.25);
    text-align: center;
}
h2 {
    color: #d63384;
    margin-bottom: 20px;
}
.success {
    font-size: 20px;
    color: #2b8a3e;
    margin-bottom: 30px;
}
button {
    width: 60%;
    padding: 12px;
    border-radius: 10px;
    font-size: 17px;
    cursor: pointer;
    border: none;
    color: white;
    transition: 0.3s;
    margin: 8px;
}
.home-btn {
    background: #d63384;
}
.home-btn:hover {
    background: #b82d6f;
}
.list-btn {
    background: #6c757d;
}
.list-btn:hover {
    background: #495057;
}
</style>
</head>
<body>

<div class="container">
    <h2>Session Closed</h2>
    <div class="success"><?= $message ?></div>

    <a href="create_session.php"><button class="home-btn">➕ Create Another Session</button></a>
    <a href="list_students.php"><button class="list-btn">📋 View Students</button></a>
</div>

</body>
</html>
