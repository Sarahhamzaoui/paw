<?php
require "config.php"; // import database credentials

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "💚 Connection successful";
} 
catch (PDOException $e) {
    // Log the error (optional)
    file_put_contents("db_errors.log", $e->getMessage() . "\n", FILE_APPEND);

    // Display safe error message
    die("❌ Connection failed");
}
?>
