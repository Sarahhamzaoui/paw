<?php
require "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST["fullname"]);
    $matricule = trim($_POST["matricule"]);
    $group_id = trim($_POST["group_id"]);

    if ($fullname == "" || $matricule == "" || $group_id == "") {
        $message = "⚠ All fields are required!";
    } else {
        $sql = $conn->prepare("INSERT INTO students(fullname, matricule, group_id) VALUES (?, ?, ?)");
        $sql->execute([$fullname, $matricule, $group_id]);
        $message = "🎉 Student added successfully!";
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
    width: 40%;
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
</style>
</head>
<body>

<div class="container">
<h2>Add New Student</h2>

<?php if (isset($message)) { ?>
    <div class="message <?= strpos($message, '⚠') !== false ? 'error' : 'success' ?>">
        <?= $message ?>
    </div>
<?php } ?>

<form method="POST">
    <input type="text" name="fullname" placeholder="Full Name">
    <input type="text" name="matricule" placeholder="Matricule">
    <input type="text" name="group_id" placeholder="Group">
    <button type="submit">➕ Add Student</button>
</form>
</div>

</body>
</html>
