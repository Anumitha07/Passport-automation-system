<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Passport Applications</title>
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
            padding: 20px;
            background-color: #fff; /* Set container background color */
            border-radius: 8px; /* Add border radius */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #007bff; /* Header background color */
            color: #fff; /* Header text color */
        }
        tr:nth-child(even) {
            background-color: #f2f2f2; /* Alternate row background color */
        }
        .view-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }
        .view-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Passport Applications</h2>
        <table>
            <thead>
                <tr>
                    <th>Applicant Name</th>
                    <th>Date of Birth</th>
                    <th>Address</th>
                    <th>Photo</th>
                    <th>Birth Certificate</th>
                    <th>Aadhar Card</th>
                    <th>Ration Card</th>
                    <th>PAN Card</th>
                    <th>Status</th>
                    <th>Email</th>
                    <th>Email ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                include 'db.php'; // Assuming this file contains the database connection

                // Retrieve passport applications from the database
                $sql = "SELECT * FROM passport_applications";
                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["applicant_name"] . "</td>";
                        echo "<td>" . $row["dob"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["photo"] . "</td>";
                        echo "<td>" . $row["birth_certificate"] . "</td>";
                        echo "<td>" . $row["aadhar_card"] . "</td>";
                        echo "<td>" . $row["ration_card"] . "</td>";
                        echo "<td>" . $row["pan_card"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["email_id"] . "</td>";
                        echo "<td><a href='edit_status.php?id=" . $row["email_id"] . "' class='view-btn'>View</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No passport applications found</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
