<?php


$uname = "Debalina";
$pword = "22054128";  

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['uname'] ?? null;
    $password = $_POST['pword'] ?? null;

    if ($username === $uname && $password === $pword) {
        echo "<!DOCTYPE html>
        <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Welcome</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        text-align: center;
                        background: url('KIIT-University-Campus-KSOM.jpg') no-repeat center center fixed;
                        background-size: cover;
                        color: white;
                        margin: 0;
                        padding: 0;
                    }
                    h1 {
                        font-size: 36px;
                        margin-bottom: 20px;
                        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
                    }
                    .welcome-message {
                        font-size: 28px;
                        font-weight: bold;
                        margin-bottom: 30px;
                        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
                    }
                    .btn-container {
                        margin-top: 20px;
                    }
                    .btn {
                        background-color: #4CAF50;
                        color: white;
                        font-size: 18px;
                        padding: 10px 20px;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        margin: 10px;
                        transition: background-color 0.3s;
                    }
                    .btn:hover {
                        background-color: #388E3C;
                    }
                    .btn-delete {
                        background-color: #f44336;
                    }
                    .btn-delete:hover {
                        background-color: #d32f2f;
                    }
                    .btn-update {
                        background-color: #2196F3;
                    }
                    .btn-update:hover {
                        background-color: #1976D2;
                    }
                </style>
            </head>
            <body>
                <h1>Welcome!</h1>
                <p class='welcome-message'>Hello, " . htmlspecialchars($username) . "!</p>
                <div class='btn-container'>
                    <button class='btn' onclick='window.location.href=\"insert.html\"'>Insert</button>
                    <button class='btn btn-update' onclick='window.location.href=\"update.html\"'>Update</button>
                    <button class='btn btn-delete' onclick='window.location.href=\"delete.html\"'>Delete</button>
                </div>
            </body>
        </html>";
        exit;
    } else {
        // Invalid login
        echo "<!DOCTYPE html>
        <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Login Failed</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        text-align: center;
                        background-color: #f4f4f4;
                    }
                    h1 {
                        color: #f44336;
                        font-size: 36px;
                        margin-top: 20px;
                    }
                    p {
                        font-size: 18px;
                        margin-top: 20px;
                    }
                </style>
            </head>
            <body>
                <h1>Login Failed!</h1>
                <p>Invalid username or password.</p>
                <p><a href='admin.html'>Go Back to Login</a></p>
            </body>
        </html>";
        exit;
    }
} else {
    echo "<!DOCTYPE html>
    <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Access Denied</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    background-color: #f4f4f4;
                }
                h1 {
                    color: #f44336;
                    font-size: 36px;
                    margin-top: 20px;
                }
                p {
                    font-size: 18px;
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <h1>Access Denied!</h1>
            <p>Please submit the form to access this page.</p>
            <p><a href='admin.html'>Go to Login Page</a></p>
        </body>
    </html>";
    exit;
}

?>
