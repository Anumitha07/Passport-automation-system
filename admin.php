<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .dashboard-links {
            text-align: center;
            margin-bottom: 30px;
        }
        .dashboard-links a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .dashboard-links a:hover {
            background-color: #0056b3;
        }
        .content {
            margin-top: 20px;
        }
        .card {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .card h2 {
            margin-top: 0;
        }
        .card p {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="dashboard-links">
                <a href="view_profile.php">Check Application Status</a>
        </div>
        <div class="content">
            <div id="user-registration" class="card">
                <h2>User Registration</h2>
                <p>Add new users to the system.</p>
            </div>
            <div id="application-submission" class="card">
                <h2>Passport Application Submission</h2>
                <p>Accept passport applications from applicants.</p>
            </div>
            
           
        </div>
    </div>
</body>
</html>
