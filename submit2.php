<?php
include 'database.php';

$success = '';
$error = '';

if (isset($_POST['add_monthly_task'])) {
    $program_id = $_POST['program_id'];
    $monthly_task = $_POST['monthly_task'];

    // Insert into the t2 (Monthly Task Table)
    $sql = "INSERT INTO t2 (program_id, monthly_task) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $program_id, $monthly_task);

    if ($stmt->execute()) {
        $success = "Monthly task added successfully!";
    } else {
        $error = "Failed to add monthly task: " . $con->error;
    }
    $stmt->close();
}
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        * {
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
    background-image: url("https://i.ibb.co/1QmmGCc/p6.jpg");
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}

.container {
    position: relative;
    max-width: 400px;
    background-color: rgba(255, 255, 255, 0.1);
    border: 2px solid rgba(255, 255, 255, 0.5);
    border-radius: 20px;
    backdrop-filter: blur(55px);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2rem 3rem;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

p {
    font-size: 1.2rem;
    color: #fff;
    text-align: center;
    margin: 20px 0;
}

a {
    text-decoration: none;
    color: #3498db;
    font-size: 1rem;
}

a:hover {
    color: #9f01ea;
}

button {
    width: 100%;
    height: 40px;
    border-radius: 40px;
    background-color: rgba(255, 255, 255, 1);
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.4s ease;
}

button:hover {
    background-color: rgba(255, 255, 255, 0.5);
}

    </style>
</head>
<body>
    <div class="container">
        <?php if ($success): ?>
            <p class="success"><?= htmlspecialchars($success); ?></p>
        <?php endif; ?>

        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <a href="month.php">Submit Another Task</a><br>
         <a href="submit.php">To check all data Click here</a>
    </div>
</body>
</html>
