<?php
// Database connection
include 'db.php'; // Assuming this file contains the database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email_id = $_POST['email_id'];
    $status = $_POST['status'];

    // Prepare SQL statement to update status
    $sql = "UPDATE passport_applications SET status = ? WHERE email_id = ?";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ss", $status, $email_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
