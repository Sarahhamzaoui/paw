<?php
require "db_connect.php";

if (!isset($_GET["id"])) {
    die("⚠ Missing student ID!");
}

$id = $_GET["id"];

// Get student data
$sql = $conn->prepare("SELECT * FROM students WHERE id=?");
$sql->execute([$id]);
$student = $sql->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("⚠ Student not found!");
}

// Update student
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST["fullname"]);
    $matricule = trim($_POST["matricule"]);
    $group_id = trim($_POST["group_id"]);

    if ($fullname == "" || $matricule == "" || $group_id == "") {
        $message = "⚠ All fields are required!";
    } else {
        $update = $conn->prepare("UPDATE students SET fullname=?, matricule=?, group_id=? WHERE id=?");
        $update->execute([$fullname, $matricule, $group_id, $id]);
        $message = "✔ Student updated successfully!";
        // Refresh student data
        $sql->execute([$id]);
        $student = $sql->fetch(PDO::FETCH_ASSOC);
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
    margin-bottom: 12px;
}
.success {
    color: #2b8a3e;
}
.error {
    color: #c1121f;
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
<h2>✏ Edit Student</h2>

<?php if (isset($message)) { ?>
    <div class="message <?= strpos($message, '⚠') !== false ? 'error' : 'success' ?>">
        <?= $message ?>
    </div>
<?php } ?>

<form method="POST">
    <input type="text" name="fullname" value="<?= $student['fullname'] ?>" placeholder="Full Name">
    <input type="text" name="matricule" value="<?= $student['matricule'] ?>" placeholder="Matricule">
    <input type="text" name="group_id" value="<?= $student['group_id'] ?>" placeholder="Group">
    <button type="submit">💾 Save Changes</button>
</form>

<a href="list_students.php" class="back-btn">⬅ Back to List</a>
</div>

</body>
</html>
