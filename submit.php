<?php
// Include database connection
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $id = mysqli_real_escape_string($con, $_POST['pid']);
    $title = mysqli_real_escape_string($con, $_POST['ptitle']);
    $detail = mysqli_real_escape_string($con, $_POST['pdetail']);
    $length = mysqli_real_escape_string($con, $_POST['plength']);
    $component = mysqli_real_escape_string($con, $_POST['pcomp']);
    $collaboration = mysqli_real_escape_string($con, $_POST['pcolab']);

    // Check if the Program ID exists
    $check_sql = "SELECT * FROM t1 WHERE program_id = '$id'";
    $check_result = mysqli_query($con, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>
                alert('Program ID already exists. Please choose a different one.');
                window.location.href = 'regform.php';
              </script>";
    } else {
        // Insert data
        $sql = "INSERT INTO t1 (program_id, program_title, program_detail, length, components, collab_details)
                VALUES ('$id', '$title', '$detail', '$length', '$component', '$collaboration')";

        if (mysqli_query($con, $sql)) {
           
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }

    mysqli_close($con);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
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
            background-image: url("img8.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .container {
            max-width: 600px;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(55px);
            padding: 40px;
            text-align: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            font-size: 2.5rem; /* Increased font size for visibility */
            font-weight: 600;
            color: #fff; /* Changed to white for better visibility */
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5); /* Added shadow for contrast */
            margin-bottom: 20px;
        }

        .container a {
            display: block;
            margin: 10px 0;
            font-size: 18px;
            text-decoration: none;
            color: #56d8e4; /* Light blue for better contrast */
            transition: 0.3s;
        }

        .container a:hover {
            color: #9f01ea; /* Change hover color for better visibility */
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5); /* Added shadow for contrast */
        }

        .submit-btn {
            text-align: center;
            margin-top: 20px;
        }

        .submit-btn input {
            background: -webkit-linear-gradient(right, #56d8e4, #9f01ea);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.4s;
        }

        .submit-btn input:hover {
            background-position: right;
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
        <h2>Thank you for your submission!</h2>
        <a href="regform.php">Submit another program</a>
        <a href="view.php">View all entries</a>
        <a href="view2.php">Click to view all entries including monthly task</a>
        <a href="view3.php">Click to view all entries including weekly task</a>
    </div>
</body>
</html>