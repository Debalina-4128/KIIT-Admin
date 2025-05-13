<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = mysqli_connect('localhost', 'root', 'Rimi@123', 'student');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error() . " (Error code: " . mysqli_connect_errno() . ")");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['roll'], $_POST['name'], $_POST['section'], $_POST['age'], $_POST['cgpa'])) {
        die("Error: Missing form data. All fields are required.");
    }

    $txtroll = $_POST['roll'];
    $txtname = $_POST['name'];
    $txtsection = $_POST['section'];
    $txtage = $_POST['age'];
    $txtcgpa = $_POST['cgpa'];

    if (!is_numeric($txtroll) || $txtroll <= 0) {
        die("Error: Roll must be a positive integer.");
    }
    if (!is_string($txtname) || empty(trim($txtname))) {
        die("Error: Name must be a non-empty string.");
    }
    if (!is_string($txtsection) || empty(trim($txtsection))) {
        die("Error: Section must be a non-empty string.");
    }
    if (!is_numeric($txtage) || $txtage <= 0) {
        die("Error: Age must be a positive integer.");
    }
    if (!is_numeric($txtcgpa) || $txtcgpa < 0 || $txtcgpa > 10.0) {
        die("Error: CGPA must be a number between 0 and 10.0.");
    }

    $sql = "INSERT INTO student (roll, name, section, age, cgpa) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);

    if (!$stmt) {
        die("Error preparing statement: " . mysqli_error($con));
    }

    mysqli_stmt_bind_param($stmt, "issid", $txtroll, $txtname, $txtsection, $txtage, $txtcgpa);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<p style='color: green; font-weight: bold;'>Contact Records Inserted Successfully</p>";
        echo "<br><a href='javascript:history.back()' style='padding: 10px 15px; background: #007BFF; color: white; text-decoration: none; border-radius: 5px;'>Back</a>";
    } else {
        echo "<p style='color: red; font-weight: bold;'>Error inserting record: " . mysqli_error($con) . "</p>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    echo "<p style='color: red; font-weight: bold;'>Invalid Request Method. Only POST requests are allowed.</p>";
}
?>
