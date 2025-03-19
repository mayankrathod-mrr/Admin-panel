<?php
require 'database.php'; // Ensure this includes the $conn variable for the database connection

// Get job ID from URL
$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch job details based on the job_id
$sql = "SELECT * FROM t1 WHERE program_id = $job_id"; // Adjust the table name and column names based on your database
$result = $con->query($sql);
$job = $result->fetch_assoc();
$con->close();

if (!$job) {
    die("Job not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details - <?= htmlspecialchars($job['program_title']) ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>       * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
        body {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background-image: url("wallpaper 4.jpg");
   background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}
.container  {
            background-color: blur(55px);
            backdrop-filter: blur(55px);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <button id="exitButton" class="btn btn-secondary mb-3">Exit to Home</button>
    
    <script>
        document.getElementById("exitButton").onclick = function() {
            window.location.href = "admin_dashboard.php"; // Adjust according to your homepage
        };
    </script>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title"><?= htmlspecialchars($job['program_title']) ?></h1>
            <div class="company-info">
                <a href="#" class="text-primary"><?= htmlspecialchars($job['company'] ?? 'N/A') ?></a>
            </div>
            <div class="location text-muted"><?= htmlspecialchars($job['location'] ?? 'N/A') ?></div>
            
            <!-- Edit and Delete Buttons with Corrected Variable -->
            <a href="edit.php?id=<?= htmlspecialchars($job['program_id']) ?>" class="btn btn-sm btn-warning">Edit</a>
            <a href="delete.php?id=<?= htmlspecialchars($job['program_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this internship?')">Delete</a>
            <a href="yourfile.pdf" download class="download-link">Download PDF</a>
            <div class="job-details-section mt-4">
                <h2 class="h5">Job details</h2>
                <p>Length: <?= htmlspecialchars($job['length']) ?> weeks</p>
                <p>Job type: Internship</p>
            </div>

            <div class="benefits mt-4">
                <h3 class="h6">Collaboration Details</h3>
                <p><?= htmlspecialchars($job['collab_details']) ?></p>
            </div>

            <div class="description mt-4">
                <h3 class="h6">Internship Description</h3>
                <p><?= htmlspecialchars($job['components']) ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
