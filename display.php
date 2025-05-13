<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost"; 
$username = "root";  
$password = "Rimi@123"; 
$dbname = "student"; 

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("<p class='error'>Database connection failed: " . $conn->connect_error . "</p>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["roll_number"])) {
    $roll_number = intval($_POST["roll_number"]); 

    $stmt = $conn->prepare("SELECT * FROM student WHERE roll = ?"); 
    $stmt->bind_param("i", $roll_number);
    $stmt->execute();
    $result = $stmt->get_result();

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Details</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                text-align: center;
                padding: 20px;
            }

            h2 {
                color: #333;
                font-size: 28px;
                margin-bottom: 20px;
                text-transform: uppercase;
            }

            .error {
                color: red;
                font-size: 18px;
                font-weight: bold;
                background-color: #ffd2d2;
                padding: 10px;
                border-radius: 5px;
                display: inline-block;
                margin-top: 20px;
            }

            table {
                width: 80%;
                margin: 20px auto;
                border-collapse: collapse;
                background-color: #fff;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                overflow: hidden;
            }

            th, td {
                padding: 12px;
                text-align: center;
                border-bottom: 1px solid #ddd;
            }

            th {
                background-color: #007BFF;
                color: white;
                font-size: 18px;
                text-transform: uppercase;
            }

            tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            tr:hover {
                background-color: #f1f1f1;
                transition: 0.3s;
            }

            .back-button {
                display: inline-block;
                margin-top: 20px;
                padding: 12px 20px;
                font-size: 16px;
                color: white;
                background-color: #28a745;
                border: none;
                border-radius: 5px;
                text-decoration: none;
                cursor: pointer;
                transition: 0.3s;
            }

            .back-button:hover {
                background-color: #218838;
            }
        </style>
    </head>
    <body>
    <h2>Student Details</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Roll Number</th><th>Name</th><th>Section</th><th>Age</th><th>CGPA</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['roll']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['section']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['cgpa']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p class='error'>No student found with Roll Number: $roll_number</p>";
    }
    ?>
    <a href="Student Search.html" class="back-button">Back to Search</a>
    </body>
    </html>
    <?php

    // Close connection
    $stmt->close();
} else {
    echo "<p class='error'>Invalid request. Please enter a valid Roll Number.</p>";
}

$conn->close();
?>
