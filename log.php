<?php
session_start(); // Start the session
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mobile_number = $_POST['mobile_number'];
    $email = $_POST['email'];

    // Check if password matches confirm password
    if ($_POST['password'] !== $_POST['confirm_password']) {
        echo "<p>Error: Passwords do not match</p>";
        exit;
    }

    // Fetch the serial number from the database
    $sql_serial = "SELECT serial_number FROM serial_numbers WHERE used = 0 ORDER BY id ASC LIMIT 1";
    $result_serial = $conn->query($sql_serial);

    if ($result_serial->num_rows > 0) {
        $row_serial = $result_serial->fetch_assoc();
        $serial_number = $row_serial['serial_number'];

        // Mark the serial number as used
        $update_serial = "UPDATE serial_numbers SET used = 1 WHERE serial_number = '$serial_number'";
        $conn->query($update_serial);

        // Use the serial number as the application ID
        $application_id = $serial_number;

        // Insert user data into the database
        $sql = "INSERT INTO users (username, password, mobile_number, email, application_id) VALUES ('$username', '$password', '$mobile_number', '$email', '$application_id')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['application_id'] = $application_id; // Store application ID in session
            header("Location: login.php");
            exit; // Redirect and exit to prevent further output
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } else {
        echo "<p>Error: No available serial numbers</p>";
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
        /* Your CSS styles */
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
        
        <?php
        // Display application ID if set in session
        if (isset($_SESSION['application_id'])) {
            echo "<p>Application ID: " . $_SESSION['application_id'] . "</p>";
            // Unset the session variable after displaying
            unset($_SESSION['application_id']);
        }
        ?>
    </div>
</body>
</html>
