<?php
require "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = trim($_POST["course_id"]);
    $group_id = trim($_POST["group_id"]);
    $professor_id = trim($_POST["professor_id"]);
    $date = date("Y-m-d");

    if ($course_id == "" || $group_id == "" || $professor_id == "") {
        $message = "⚠ All fields are required!";
    } else {
        $sql = $conn->prepare("INSERT INTO attendance_sessions(course_id, group_id, date, opened_by, status)
                               VALUES (?, ?, ?, ?, 'open')");
        $sql->execute([$course_id, $group_id, $date, $professor_id]);
        $session_id = $conn->lastInsertId();
        $message = "📌 Session created successfully!<br>🆔 Session ID = <b>$session_id</b>";
    }
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
    margin: 60px auto;
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0px 0px 15px rgba(255, 0, 120, 0.25);
}
h2 {
    text-align: center;
    color: #d63384;
    margin-bottom: 25px;
}
input[type=text] {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 2px solid #ffb3d9;
    margin-bottom: 18px;
}
button {
    width: 100%;
    background: #d63384;
    border: none;
    padding: 13px;
    border-radius: 10px;
    font-size: 17px;
    color: white;
    cursor: pointer;
    transition: 0.3s;
}
button:hover {
    background: #b82d6f;
}
.message {
    text-align: center;
    font-size: 17px;
    margin-bottom: 18px;
}
.success {
    color: #2b8a3e;
}
.error {
    color: #c1121f;
}
.back-btn {
    display: block;
    width: 220px;
    margin: 20px auto;
    background: #6c757d;
    border-radius: 8px;
    padding: 12px;
    color: white;
    text-align: center;
    font-size: 16px;
    text-decoration: none;
    transition: 0.3s;
}
.back-btn:hover {
    background: #495057;
}
</style>
</head>
<body>

<div class="container">
<h2>Create Attendance Session</h2>

<?php if (isset($message)) { ?>
    <div class="message <?= strpos($message, '⚠') !== false ? 'error' : 'success' ?>">
        <?= $message ?>
    </div>
<?php } ?>

<form method="POST">
    <input type="text" name="course_id" placeholder="Course ID (e.g., AWP)">
    <input type="text" name="group_id" placeholder="Group (e.g., G1)">
    <input type="text" name="professor_id" placeholder="Professor ID">
    <button type="submit">🚀 Create Session</button>
</form>

<a href="list_students.php" class="back-btn">⬅ Back to Students</a>
</div>

</body>
</html>
