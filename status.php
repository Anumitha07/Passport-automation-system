<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9; /* Set background color */
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
            background-color: #fff; /* Set container background color */
            border-radius: 8px; /* Add border radius for a card-like appearance */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
        }
        .breadcrumb {
            background-color: #007bff;
            padding: 10px 0;
            margin-bottom: 20px;
            border-top-left-radius: 8px; /* Adjust border radius for top corners */
            border-top-right-radius: 8px;
        }
        .breadcrumb a {
            text-decoration: none;
            color: #fff; /* Change breadcrumb link color to white */
            font-weight: bold; /* Make breadcrumb links bold */
        }
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        h2 {
            margin-top: 0;
            color: #007bff; /* Set heading color */
        }
        .status-info {
            margin-bottom: 20px;
            color: #333; /* Set text color */
        }
        .error {
            color: red;
        }
        .logout-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="breadcrumb">
            <a href="check.php">Check Status</a> &gt; Status Page
        </div>
        <?php
        // Check if email is provided in the URL parameters
        if(isset($_GET['email'])) {
            // Retrieve email from URL parameters
            $email = $_GET['email'];

            // Perform database connection
            include 'db.php'; // Assuming this file contains the database connection
            
            // Prepare SQL query to retrieve reg_id and status based on email
            $sql = "SELECT status FROM passport_applications WHERE email_id = '$email'";
            
            // Execute the query
            $result = $conn->query($sql);
            
            if($result->num_rows > 0) {
                // Fetch reg_id and status from the result
                $row = $result->fetch_assoc();
                $status = $row['status'];

                // Display status information
                echo '<h2>Status Page</h2>';
                echo '<div class="status-info">';
                echo "<p>Email: $email</p>"; // Display email with full name
               // Display reg_id with full name
                echo "<p>Current Position: $status</p>"; // Display current position
                echo '</div>';
                // Additional status information can be displayed here based on your requirements
            } else {
                // If no user found with the provided email, display an error message
                echo '<h2 class="error">Error</h2>';
                echo '<div class="status-info">';
                echo "User with email $email not found.";
                echo '</div>';
            }

            // Close the database connection
            $conn->close();
        } else {
            // If email is not provided in the URL parameters, redirect back to check.php
            header("Location: check.php");
            exit();
        }
        ?>
        <form action="index.php" method="post">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>
