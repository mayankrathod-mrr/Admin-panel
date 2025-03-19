<?php 
include 'database.php'; // Ensure this is included

// Check if $con is initialized (connection is successful)
if ($con === null || !$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM t1";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "
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
            background-image: url(img8.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }

        section {
            position: relative;
            background-color: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(55px);
            padding: 2rem;
            width: 100%;
            max-width: 1200px;
        }

        h1 {
            font-size: 2rem;
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        th, td {
            padding: 10px;
            text-align: left;
            color: #fff;
        }

        th {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        tr:hover {
            background-color: rgba(0, 0, 0, 0.2);
        }

        a {
            color: #ff6f61;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        a:hover {
            color: #e65c50;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 20px;
        }

        .action-buttons a {
            padding: 10px 15px;
            background-color: #ff6f61;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        .action-buttons a:hover {
            background-color: #e65c50;
        }

        .action-buttons .delete,
        .action-buttons .edit,
        .action-buttons .view {
            color: white;
            font-weight: bold;
        }

        .action-buttons .delete:hover,
        .action-buttons .edit:hover,
        .action-buttons .view:hover {
            color: #e65c50;
        }
    </style>
    ";

    echo "<section>
        <h1>Program List</h1>
        <table>
            <tr>
                <th>Program ID</th>
                <th>Program Title</th>
                <th>Program Detail</th>
                <th>Length</th>
                <th>Components</th>
                <th>Collab Details</th>
                <th>Actions</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['program_id']}</td>
            <td>{$row['program_title']}</td>
            <td>{$row['program_detail']}</td>
            <td>{$row['length']}</td>
            <td>{$row['components']}</td>
            <td>{$row['collab_details']}</td>
            <td>
                <a class='delete' href='delete.php?id={$row['program_id']}' onclick='return confirm(\"Are you sure you want to delete this program?\");'>Delete Program</a>
                | <a class='edit' href='edit.php?id={$row['program_id']}'>Edit Program</a>
                | <a class='view' href='viewprogram.php?id={$row['program_id']}'>View Program</a>
            </td>
        </tr>";
    }

    echo "</table>";

    echo "
    <div class='action-buttons'>
        <a href='month.php'>Add Monthly Task</a>
        <a href='week.php'>Add Weekly Task</a>
    </div>
    </section>";
} else {
    echo "<section>
        <h1>No Results Found</h1>
        <p style='color: #fff;'>There are currently no programs available.</p>
    </section>";
}

// Close the connection safely
if (isset($con)) {
    $con->close();
}
?>
