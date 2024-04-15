
<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $applicant_name = $_POST['applicant_name'];

    $sql = "INSERT INTO appointments (date, time, applicant_name) VALUES ('$date', '$time', '$applicant_name')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Appointment scheduled successfully"));
    } else {
        echo json_encode(array("message" => "Error: " . $sql . "<br>" . $conn->error));
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Scheduling</title>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; font-family: Arial, sans-serif;">
    <div style="width: 300px; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
        <h1 style="text-align: center;">Appointment Scheduling</h1>
        <form action="schedule_appointment.php" method="post">
            Date: <input type="date" name="date" required style="width: calc(100% - 10px); padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;"><br>
            Time: <input type="time" name="time" required style="width: calc(100% - 10px); padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;"><br>
            Applicant Name: <input type="text" name="applicant_name" required style="width: calc(100% - 10px); padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;"><br>
            <input type="submit" value="Schedule Appointment" style="width: 100%; padding: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; box-sizing: border-box;">
        </form>

    
    </div>
</body>
</html>
