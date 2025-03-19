<?php
include 'database.php'; 

if (isset($_GET['id'])) {
    $program_id = $_GET['id'];

    $sql = "SELECT * FROM t1 WHERE program_id='$program_id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for Program ID: $program_id";
        exit();
    }
} else {
    echo "No Program ID provided!";
    exit();
}

if (isset($_POST['update'])) {
    $title = $_POST['ptitle'];
    $detail = $_POST['pdetail'];
    $length = $_POST['plength'];
    $components = $_POST['pcomp'];
    $collab = $_POST['pcolab'];

    $update_sql = "UPDATE t1 SET program_title='$title', program_detail='$detail', length='$length', components='$components', collab_details='$collab' WHERE program_id='$program_id'";

    if ($con->query($update_sql) === TRUE) {
        echo "Program details updated successfully!";
        header("Location: view.php"); 
    } else {
        echo "Error updating record: " . $con->error;
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program</title>
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
            padding: 0 20px; /* Optional: Add some padding to the sides */
        }

        .container {
            width: 100%; /* Full width */
            padding: 3rem; /* Increased padding for more vertical space */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .text {
            font-size: 2rem;
            color: #fff; /* White color for better visibility */
            text-align: center;
            margin-bottom: 20px;
        }

        .form-row {
            width: 100%; /* Full width for each form row */
            margin: 15px 0;
            display: flex; /* Use flexbox for the layout */
            flex-wrap: wrap; /* Allow wrapping of input fields */
        }

        .input-data {
            position: relative;
            margin: 20px 0;
            width: 100%; /* Full width for the input fields */
        }

        .input-data input,
        .input-data textarea {
            width: 100%;
            height: 50px; /* Adjusted height for input fields */
            background: transparent; /* Clear background for input fields */
            border: none;
            outline: none;
            font-size: 1rem;
            color: #fff; /* White color for better visibility */
            padding: 0 5px;
            border-bottom: 2px solid #fff; /* White border for visibility */
        }

        .input-data textarea {
            height: 40px; /* Reduced height for textarea */
            margin-bottom: 5px; /* Reduced margin for space */
        }

        .input-data label {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            color: #fff; /* White color for better visibility */
            font-size: 1rem;
            pointer-events: none;
            transition: all 0.5s ease-in-out;
        }

        input:focus ~ label,
        input:valid ~ label,
        textarea:focus ~ label,
        textarea:valid ~ label {
            top: -5px;
            font-size: 0.9rem;
        }

        .submit-btn {
            margin-top: 10px; /* Slightly reduced margin */
            width: 100%; /* Full width for submit button */
        }

        .submit-btn input {
            width: 100%;
            height: 40px;
            border-radius: 40px;
            background-color: transparent; /* Transparent background for button */
            border: 2px solid #fff; /* White border for visibility */
            outline: none;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.4s ease;
            color: #fff; /* White color for better visibility */
        }

        .submit-btn input:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Light hover effect for visibility */
        }

        .register {
            font-size: 0.9rem;
            color: #fff; /* White color for better visibility */
            text-align: center;
            margin: 25px 0 10px;
        }

        .register p a {
            text-decoration: none;
            color: #fff; /* White color for better visibility */
            font-weight: 600;
        }

        .register p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text">Edit Program</div>
        <form action="" method="POST">
            <div class="form-row">
                <div class="input-data">
                    <input type="text" name="ptitle" value="<?php echo $row['program_title']; ?>" required>
                    <label for="">Program Title</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <input type="text" name="pdetail" value="<?php echo $row['program_detail']; ?>" required>
                    <label for="">Program Detail</label>
                </div>
                <div class="input-data">
                    <input type="text" name="plength" value="<?php echo $row['length']; ?>" required>
                    <label for="">Length</label>
                </div>
                <div class="input-data">
                    <input type="text" name="pcomp" value="<?php echo $row['components']; ?>" required>
                    <label for="">Components</label>
                </div>
            </div>
            <div class="form-row">
                <div class="input-data">
                    <textarea name="pcolab" rows="3" required><?php echo $row['collab_details']; ?></textarea>
                    <label for="">Collaboration Details</label>
                </div>
            </div>
            <div class="form-row submit-btn">
                <input type="submit" value="Update Program" name="update">
            </div>
        </form>
    </div>
</body>
</html>
