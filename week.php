<?php
include 'database.php';

$program_id = '';
$program_data = null;
$error = '';

if (isset($_POST['check_program'])) {
    $program_id = $_POST['program_id'];

    // Check if program ID exists in the database
    $sql = "SELECT * FROM t1 WHERE program_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $program_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $program_data = $result->fetch_assoc();
    } else {
        $error = "Program ID not found!";
        $program_data = null;
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
    <title>Add Weekly Task</title>
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
            background-color: transparent;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(55px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem 3rem;
        }

h2 {
    font-size: 2rem;
    color: #fff;
    text-align: center;
    margin-bottom: 1rem;
}


.inputbox {
            position: relative;
            margin: 30px 0;
            width: 100%; /* Full width for inputbox */
            max-width: 310px; /* Keep max width for design */
            border-bottom: 2px solid #fff;
        }

        .inputbox label {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            color: #fff;
            font-size: 1rem;
            pointer-events: none;
            transition: all 0.5s ease-in-out;
            display: block; /* Make label a block element */
        }

        input:focus ~ label, 
        input:valid ~ label {
            top: -5px;
            font-size: 0.85rem; /* Slightly smaller when focused */
        }

        .inputbox input {
            width: 100%;
            height: 60px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1rem;
            padding: 0 35px 0 5px;
            color: #fff;
        }

        textarea {
            width: 100%;
            height: 70px;
            padding: 10px;
            border: none;
            outline: none;
            color: #fff;
            background: transparent;
            border-bottom: 2px solid rgba(255, 255, 255, 0.5); /* Keep the same styling */
            resize: none; /* Disable resizing */
            margin-top: 10px; /* Add space between label and textarea */
        }
.error {
    color: red;
    margin: 15px 0;
    text-align: center;
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

.register {
    font-size: 0.9rem;
    color: #fff;
    text-align: center;
    margin: 25px 0 10px;
}

.register p a {
    text-decoration: none;
    color: #fff;
    font-weight: 600;
}

.register p a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Weekly Task</h2>

        <form method="post">
            <div class="input-group">
                <label for="program_id">Enter Program ID:</label>
                <input type="text" name="program_id" id="program_id" required value="<?= htmlspecialchars($program_id); ?>">
            </div>
            <button class="submit-btn" type="submit" name="check_program">Check Program</button>
        </form>

        <!-- Error message -->
        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <?php if ($program_data): ?>
            <form method="post" action="submit3.php">
                <input type="hidden" name="program_id" value="<?= htmlspecialchars($program_data['program_id']); ?>">

                <div class="input-group">
                    <label for="weekly_task">Add Weekly Task:</label>
                    <textarea name="weekly_task" required></textarea>
                </div>

                <button class="submit-btn" type="submit">Submit Weekly Task</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
