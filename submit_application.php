<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $applicant_name = $_POST['applicant_name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    // File upload handling for each document
    $photo = $_FILES['photo']['name'];
    $birth_certificate = $_FILES['birth_certificate']['name'];
    $aadhar_card = $_FILES['aadhar_card']['name'];
    $ration_card = $_FILES['ration_card']['name'];
    $pan_card = $_FILES['pan_card']['name'];

    // Move uploaded files to desired directory
    move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $photo);
    move_uploaded_file($_FILES['birth_certificate']['tmp_name'], 'uploads/' . $birth_certificate);
    move_uploaded_file($_FILES['aadhar_card']['tmp_name'], 'uploads/' . $aadhar_card);
    move_uploaded_file($_FILES['ration_card']['tmp_name'], 'uploads/' . $ration_card);
    move_uploaded_file($_FILES['pan_card']['tmp_name'], 'uploads/' . $pan_card);

    // SQL query to insert data into database
    $sql = "INSERT INTO passport_applications (email_id,applicant_name, dob, address, photo, birth_certificate, aadhar_card, ration_card, pan_card) 
            VALUES ('$email','$applicant_name', '$dob', '$address', '$photo', '$birth_certificate', '$aadhar_card', '$ration_card', '$pan_card')";

    if ($conn->query($sql) === TRUE) {
        // Retrieve the auto-generated ID
        $last_id = $conn->insert_id;
        
        // Prepare the message for SweetAlert including the application ID
        $message = "Passport application submitted successfully. Application ID: " . $last_id;
        
        // Encode the message into JSON and echo it
        echo json_encode(array("message" => $message));
    } else {
        echo json_encode(array("message" => "Error: " . $sql . "<br>" . mysqli_error($conn)));
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passport Application Submission</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .form-container {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .form-container h1 {
            text-align: center;
        }
        .form-container input[type="text"],
        .form-container input[type="date"],
        .form-container input[type="file"] {
            width: calc(100% - 10px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-sizing: border-box;
        }
        .form-container p {
            text-align: center;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h1>Passport Application Submission</h1>
    <form id="applicationForm" action="submit_application.php" method="post" enctype="multipart/form-data">
        Applicant Name: <input type="text" name="applicant_name" required><br>
        Applicant Email Id: <input type="email" name="email" required><br>
        Date of Birth: <input type="date" name="dob" required><br>
        Address: <input type="text" name="address" required><br>
        Photo: <input type="file" name="photo" required><br>
        Birth Certificate: <input type="file" name="birth_certificate" required><br>
        Aadhar Card: <input type="file" name="aadhar_card" required><br>
        Ration Card: <input type="file" name="ration_card" required><br>
        PAN Card: <input type="file" name="pan_card" required><br>
        <input type="submit" value="Submit Application">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.getElementById('applicationForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        // AJAX request to submit form data
        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'submit_application.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Upon successful submission, show SweetAlert
                Swal.fire({
                    title: "Good job!",
                    text: "Passport application submitted successfully",
                    icon: "success"
                }).then(function() {
                    // Redirect to index.php after clicking OK
                 window.location.href = "index.php";
                });
            } else {
                // Show error message if submission fails
                Swal.fire({
                    title: "Error!",
                    text: "Failed to submit application. Please try again later.",
                    icon: "error"
                });
            }
        };
        xhr.send(formData);
    });
</script>

</body>
</html>
