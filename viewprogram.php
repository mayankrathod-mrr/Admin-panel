<?php
include 'database.php';

// Get the program ID from the query string
$program_id = $_GET['id'] ?? null;

if (!$program_id) {
    echo "No program ID provided.";
    exit;
}

// Fetch program details from the t1 table
$sql = "SELECT * FROM t1 WHERE program_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $program_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $program = $result->fetch_assoc();
} else {
    echo "Program not found.";
    exit;
}

// Fetch monthly tasks related to the program from the t2 table
$sql = "SELECT * FROM t2 WHERE program_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $program_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch weekly tasks related to the program from the t3 table
$sql = "SELECT * FROM t3 WHERE program_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $program_id);
$stmt->execute();
$result_weekly = $stmt->get_result();

$stmt->close();
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Program</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-image: url("https://i.ibb.co/1QmmGCc/p6.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            padding: 20px;
            color: #000; /* Set text color to black */
        }

        h2 {
            color: #000; /* Black color for headings */
            margin: 20px 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.1); /* Light transparent background for the table */
            border-radius: 10px; /* Rounded corners */
            overflow: hidden; /* To keep the rounded corners intact */
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid rgba(255, 255, 255, 0.2); /* Light transparent border */
            color: #000; /* Set table text color to black */
        }

        th {
            background-color: rgba(255, 255, 255, 0.3); /* Light semi-transparent background for headers */
            color: #000; /* Black text for header visibility */
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.05); /* Slightly darker for even rows */
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.2); /* Hover effect for rows */
        }

        ul {
            list-style-type: square;
            margin: 20px 0;
            color: #000; /* Set list text color to black */
        }

        a {
            text-decoration: none;
            padding: 10px 15px;
            background-color: transparent; /* Transparent background for link */
            color: #000; /* Black color for visibility */
            border: 2px solid #000; /* Black border for visibility */
            border-radius: 5px;
            margin-right: 10px;
            transition: background-color 0.3s, color 0.3s; /* Smooth transition */
        }

        a:hover {
            background-color: rgba(255, 255, 255, 0.3); /* Light hover effect */
            color: #2980b9; /* Change color on hover */
        }
    </style>
</head>
<body>

<?php if (isset($program)): ?>
    <h2>Program Details</h2>
    <table>
        <tr><th>Program ID</th><td><?php echo $program['program_id']; ?></td></tr>
        <tr><th>Program Title</th><td><?php echo $program['program_title']; ?></td></tr>
        <tr><th>Program Detail</th><td><?php echo $program['program_detail']; ?></td></tr>
        <tr><th>Length</th><td><?php echo $program['length']; ?></td></tr>
        <tr><th>Components</th><td><?php echo $program['components']; ?></td></tr>
        <tr><th>Collaboration Details</th><td><?php echo $program['collab_details']; ?></td></tr>
    </table>

    <!-- Monthly Tasks -->
    <h2>Monthly Tasks</h2>
    <?php if ($result->num_rows > 0): ?>
        <ul>
        <?php while ($task = $result->fetch_assoc()): ?>
            <li><?php echo $task['monthly_task']; ?></li>
        <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No monthly tasks added.</p>
    <?php endif; ?>

    <!-- Weekly Tasks -->
    <h2>Weekly Tasks</h2>
    <?php if ($result_weekly->num_rows > 0): ?>
        <ul>
        <?php while ($task = $result_weekly->fetch_assoc()): ?>
            <li><?php echo $task['weekly_task']; ?></li>
        <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No weekly tasks added.</p>
    <?php endif; ?>
<?php endif; ?>

<a href="view.php">Back to Program List</a>

</body>
</html>
