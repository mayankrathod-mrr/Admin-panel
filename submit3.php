<?php
include 'database.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $program_id = $_POST['program_id'];
    $weekly_task = $_POST['weekly_task'];

    $sql = "INSERT INTO t3 (program_id, weekly_task) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $program_id, $weekly_task);

    if ($stmt->execute()) {
        $success = "Weekly task added successfully!";
    } else {
        $error = "Failed to add weekly task: " . $con->error;
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
    <title>Submission Result</title>
    <style>
       @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

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
            max-width: 400px;
            width: 100%;
            background-color: transparent;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(55px);
            padding: 2rem 3rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 2rem;
            color: #fff;
            text-align: center;
            margin-bottom: 1rem;
        }

        .message {
            font-size: 1.2rem;
            color: #fff;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        a {
            display: block;
            margin: 10px 0;
            font-size: 1rem;
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            text-align: center;
        }

        a:hover {
            text-decoration: underline;
        }

        button {
            width: 100%;
            height: 45px;
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

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($success): ?>
            <div class="message"><?= htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="message" style="color: red;"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <a href="week.php">Submit Another Weekly Task</a>
        <a href="submit.php">To check all data, click here</a>
    </div>
</body>
</html>
