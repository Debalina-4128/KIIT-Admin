<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect('localhost', 'root', 'Rimi@123', 'student');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error() . " (Error code: " . mysqli_connect_errno() . ")");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['roll'])) {
        die("Error: Missing roll number. Roll number is required.");
    }

    $txtroll = $_POST['roll'];

    if (!is_numeric($txtroll) || $txtroll <= 0) {
        die("Error: Roll number must be a positive integer.");
    }

    $sql = "DELETE FROM student WHERE roll = ?";
    $stmt = mysqli_prepare($con, $sql);

    if (!$stmt) {
        die("Error preparing statement: " . mysqli_error($con));
    }

    mysqli_stmt_bind_param($stmt, "i", $txtroll);

    $result = mysqli_stmt_execute($stmt);

    if ($result && mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<p style='color: green; font-weight: bold;'>Record Deleted Successfully</p>";
    } else {
        echo "<p style='color: red; font-weight: bold;'>Error: Roll number not found or deletion failed.</p>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);

    echo "<br><a href='javascript:history.back()' style='padding: 10px 15px; background: #007BFF; color: white; text-decoration: none; border-radius: 5px;'>Back</a>";
} else {
    echo "<p style='color: red; font-weight: bold;'>Invalid Request Method. Only POST requests are allowed.</p>";
}
?>
