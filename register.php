<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mobile_number = $_POST['mobile_number'];
    $email = $_POST['email'];

    // Check if password matches confirm password
    if ($_POST['password'] !== $_POST['confirm_password']) {
        echo json_encode(array("message" => "Error: Passwords do not match"));
        exit;
    }

    $sql = "INSERT INTO users (username, password, mobile_number, email) VALUES ('$username', '$password', '$mobile_number', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "User registered successfully"));
        header("Location: login.php");
    } else {
        echo json_encode(array("message" => "Error: " . $sql . "<br>" . $conn->error));
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .registration-form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .registration-form h1 {
            text-align: center;
            color: #333;
            font-family: Arial, sans-serif;
            margin-bottom: 20px;
        }
        .registration-form label {
            font-weight: bold;
        }
        .registration-form input[type="text"],
        .registration-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .registration-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="registration-form">
        <h1>User Registration</h1>
        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required><br>
            <label for="mobile_number">Mobile Number:</label>
            <input type="text" name="mobile_number" id="mobile_number" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>
            <div style="margin-bottom: 10px;"></div>
            <input type="submit" value="Register">
        </form>

       
    </div>
</body>
</html>