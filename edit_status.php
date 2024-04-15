<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9; /* Set background color */
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff; /* Set container background color */
            padding: 20px;
            border-radius: 8px; /* Add border radius */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow */
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        select, input[type="submit"] {
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>update status</h2>
        <?php
        // Database connection
        include 'db.php'; // Assuming this file contains the database connection

        // Check if email ID is provided in the URL parameters
        if(isset($_GET['id'])) {
            // Retrieve email ID from URL parameters
            $email_id = $_GET['id'];

            // Retrieve user information from the database
            $sql = "SELECT * FROM passport_applications WHERE email_id = '$email_id'";
            $result = $conn->query($sql);

            if($result->num_rows > 0) {
                // Fetch user data
                $row = $result->fetch_assoc();
                $name = $row['applicant_name'];
                $dob = $row['dob'];
                $address = $row['address'];
                $photo = $row['photo'];
                $birth_certificate = $row['birth_certificate'];
                $aadhar_card = $row['aadhar_card'];
                $ration_card = $row['ration_card'];
                $pan_card = $row['pan_card'];
                $status = $row['status'];

                // Display user information in a form
                echo '<form action="update_status.php" method="post">';
                echo '<div class="form-group">';
                echo '<label for="name">Applicant Name:</label>';
                echo '<input type="text" id="name" name="name" value="' . $name . '" readonly>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="dob">Date of Birth:</label>';
                echo '<input type="text" id="dob" name="dob" value="' . $dob . '" readonly>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label for="address">Address:</label>';
                echo '<input type="text" id="address" name="address" value="' . $address . '" readonly>';
                echo '</div>';
                // Add other fields as needed
                echo '<div class="form-group">';
                echo '<label for="status">Status:</label>';
                echo '<select id="status" name="status">';
                echo '<option value="regional administrator"' . ($status == "regional administrator" ? ' selected' : '') . '>regional administrator</option>';
                echo '<option value="police"' . ($status == "police'" ? ' selected' : '') . '>police</option>';
                echo '<option value="passport admin"' . ($status == "passport admin" ? ' selected' : '') . '>passport admin</option>';
                echo '</select>';
                echo '</div>';
                echo '<input type="hidden" name="email_id" value="' . $email_id . '">';
                echo '<input type="submit" value="Update Status">';
                echo '</form>';
            } else {
                echo '<p>User not found.</p>';
            }
        } else {
            echo '<p>Email ID not provided.</p>';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
