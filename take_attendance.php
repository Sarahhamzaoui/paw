<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = date("Y-m-d");
    $file = "attendance_$date.json";

    // Check if attendance already exists
    if (file_exists($file)) {
        die("⚠ Attendance for today has already been taken.");
    }

    $attendance = [];
    foreach ($_POST["status"] as $student_id => $status) {
        $attendance[] = [
            "student_id" => $student_id,
            "status" => $status
        ];
    }

    file_put_contents($file, json_encode($attendance, JSON_PRETTY_PRINT));

    echo "📌 Attendance saved for $date";
    exit; // stop page to avoid reloading form
}

// Load students
$file = "students.json";
if (!file_exists($file)) {
    die("⚠ students.json not found — add students first!");
}
$students = json_decode(file_get_contents($file), true);
$date = date("Y-m-d");
?>
<!DOCTYPE html>
<html>
<body>

<h2>Take Attendance — <?php echo $date; ?></h2>

<form method="POST">
<?php foreach ($students as $s): ?>
    <?php echo $s["name"] . " (" . $s["student_id"] . ")"; ?>
    <input type="radio" name="status[<?php echo $s['student_id']; ?>]" value="present" required> Present
    <input type="radio" name="status[<?php echo $s['student_id']; ?>]" value="absent" required> Absent
    <br><br>
<?php endforeach; ?>
<button type="submit">Save Attendance</button>
</form>

</body>
</html>
