<?php
include 'database.php'; 
$sql = "SELECT * FROM t2"; // Only fetching program ID and monthly tasks
$result = mysqli_query($con, $sql); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Monthly Tasks</title>
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
            background-image: url("img8.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        .container {
            position: relative;
            max-width: 900px;
            background-color: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(55px);
            padding: 2rem 3rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-size: 2rem;
            color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1rem;
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #fff;
        }

        table, th, td {
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: rgba(0, 123, 255, 0.8); /* Semi-transparent blue for header */
            color: white;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        a:hover {
            color: #9f01ea; /* Matching hover effect */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Monthly Tasks</h2>

        <table>
            <thead>
                <tr>
                    <th>Program ID</th>
                    <th>Monthly Task</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['program_id']); ?></td>
                            <td><?= htmlspecialchars($row['monthly_task']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" style="text-align: center;">No monthly tasks found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div>
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
