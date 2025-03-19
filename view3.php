<?php
include 'database.php'; 
$sql = "SELECT * FROM t3"; 
$result = mysqli_query($con, $sql); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Weekly Tasks</title>
    <style>
        

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
            background-color: transparent;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(55px);
            padding: 2rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 2rem;
            color: #fff;
            text-align: center;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 10px;
            color: #fff;
            text-align: left;
        }

        th {
            background-color: rgba(0, 123, 255, 0.7); /* Blue for the header */
            font-weight: bold;
        }

        td {
            background-color: rgba(255, 255, 255, 0.1); /* Slight transparency for table rows */
        }

        tr:nth-child(even) td {
            background-color: rgba(255, 255, 255, 0.05); /* Alternate row color */
        }

        tr:hover td {
            background-color: rgba(255, 255, 255, 0.15); /* Highlighted row on hover */
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            transition: color 0.3s;
        }

        a:hover {
            color: #ffcccb; /* Lighter color on hover */
        }

        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
            }
        }
    </style>
    </style>
</head>
<body>
    <div class="container">
        <h2>Weekly Tasks</h2>

        <table>
            <thead>
                <tr>
                    <th>Program ID</th>
                    <th>Weekly Task</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['program_id']); ?></td>
                            <td><?= htmlspecialchars($row['weekly_task']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" style="text-align: center;">No weekly tasks found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div style="text-align: center;">
            <a href="week.php">Go Back to Submit Weekly Task</a>
            <br>
            <a href="view.php">Click to view all data</a>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($con); 
?>
