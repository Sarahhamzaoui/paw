<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Attendance System Login</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #ffd7ec, #ffeef8);
    margin: 0;
    padding: 0;
}

#logo {
    width: 130px;
    display: block;
    margin: 40px auto 10px;
}

.title {
    text-align: center;
    font-size: 22px;
    color: #b30059;
    margin-bottom: 10px;
    font-weight: 600;
}

.container {
    width: 42%;
    margin: 20px auto;
    background: white;
    padding: 40px 35px;
    border-radius: 18px;
    box-shadow: 0px 8px 20px rgba(255, 0, 150, 0.20);
}

h2 {
    text-align: center;
    color: #d63384;
    font-size: 30px;
    margin-bottom: 22px;
    font-weight: 600;
}

input[type=email],
input[type=password] {
    width: 100%;
    padding: 14px;
    margin-bottom: 20px;
    border-radius: 10px;
    border: 2px solid #ffc5e1;
    font-size: 16px;
}

input:focus {
    outline: none;
    border-color: #ff4da6;
    box-shadow: 0px 0px 8px rgba(255,0,120,0.35);
}

button {
    width: 100%;
    background: #ff2d8b;
    border: none;
    padding: 14px;
    border-radius: 12px;
    font-size: 18px;
    color: white;
    cursor: pointer;
    transition: 0.25s;
    margin-top: 8px;
}

button:hover {
    background: #c80062;
    transform: translateY(-2px);
}

/* Error message */
.error {
    background: #ffe0eb;
    color: #b3003d;
    padding: 12px;
    border-radius: 10px;
    text-align: center;
    margin-bottom: 20px;
    font-weight: 500;
    font-size: 16px;
    border: 1px solid #ffb3d4;
}
</style>
</head>
<body>

<img id="logo" src="R.png" alt="University of Algiers Logo">
<div class="title">University of Algiers — Attendance System</div>

<div class="container">
<h2>Login Portal</h2>

<?php 
if (isset($_GET["error"])) {
    echo "<div class='error'>❌ Incorrect email or password</div>";
}
?>

<form action="auth.php" method="POST">
    <input type="email" name="email" placeholder="Enter your email" required>
    <input type="password" name="password" placeholder="Enter your password" required>
    <button type="submit">Login 🔐</button>
</form>
</div>

</body>
</html>
