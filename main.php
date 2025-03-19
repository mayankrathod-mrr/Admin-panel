<?php
session_start();
require 'database.php'; // Include the database connection file

// Initialize search variable
$search_query = "";
if (isset($_GET['search'])) {
    // Get the search term from the input
    $search_query = $_GET['search'];
}

// Modify SQL query to search for internships based on the search term
$query = "SELECT * FROM internship_programs"; // Ensure the table name matches your database
if ($search_query != "") {
    // Use the LIKE operator to search in title, length, components, and collaboration details
    $query .= " WHERE title LIKE '%$search_query%' OR length LIKE '%$search_query%' OR components LIKE '%$search_query%' OR collaboration_details LIKE '%$search_query%'";
}

$result = $con->query($query);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Program list query
$sql = "SELECT * FROM t1";
$program_result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship </title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        
        * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
        /* General Background */
        body {
            background-image: url("img6.jpg");
           
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background-size: cover;
        }

    
        .container {
            max-width: 800px; /* Limiting the container width for better centering */
            margin: 0 auto;
            backdrop-filter: blur(55px);
        }

        
    
        .job-listing {
            max-width: 800px; /* Limiting the container width for better centering */
            margin: 0 auto;
            backdrop-filter: blur(55px);
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        /* Header Styling */
        header {
            background-color: #343a40;
            color: white;
            padding: 1rem;
        }

        header h1 {
            margin: 0;
        }

        header .btn-success, header .btn-outline-primary {
            border-radius: 25px;
        }

        header .btn-outline-primary {
            color: #ffffff;
            border-color: #ffffff;
        }

        header .btn-outline-primary:hover {
            background-color: #ffffff;
            color: #343a40;
        }

        /* Search Bar */
        .container form input[type="search"] {
            border-radius: 10px;
        }

        .container form button {
            color: black;
            border-radius: 25px;
        }

        .mb-4 {
            align-items: center;
            color: black;
            display: flex;
            justify-content: center;
            margin: 20px auto;
        }
        .mb-4 .btn-outline-primary{
            color:black;
        }

        /* Job Listing Card */
        .job-listing {
            
            backdrop-filter: blur(55px);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .job-listing:hover {
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
        }

        .job-listing div {
            flex: left;
            margin-right: 20px; /* Add space between text and buttons */
        }

        /* Job Listing Text Styling */
        .job-listing h2 {
            color: #343a40;
            font-weight: 500;
            margin-top: 0;
        }

        .job-listing p {
            color: #2b2d42;
            margin-bottom: 0.5rem;
        }

        .job-listing p strong {
            color: #343a40;
        }

        /* Button Styling in Listings */
        .job-listing .btn-primary, .job-listing .btn-danger {
            border-radius: 50px;
            padding: 0.375rem 0.75rem;
            backdrop-filter: blur(55px);
        }

    </style>
</head>
<body>

    <!-- Header with Add Internship button -->
    <header>
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3">Internship</h1>
            <div>
                <a href="regform.php" class="btn btn-success">Add Internship</a>
                <a href="profile.php" class="btn btn-outline-primary">Profile</a>
            </div>
        </div>
    </header>

    <!-- Search bar -->
    <div class="container mb-4">
        <form class="d-flex" method="GET" action="">
            <input class="form-control me-2" type="search" name="search" placeholder="Search internships..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </div>

    <div class="mb-4">
        <div>
            
            <a class="btn btn-outline-primary"  href="view.php">View all entries</a>
            <a class="btn btn-outline-primary"href="view2.php">Click to view all entries including monthly task</a>
            <a class="btn btn-outline-primary" href="view3.php">Click to view all entries including weekly task</a>
        </div>

   
    </div>

    <!-- Program Listings -->
    <div class="container1">
        <div class="job-listings">
            <?php
            if ($program_result->num_rows > 0) {
                // Output program data of each row
                while($row = $program_result->fetch_assoc()) {
                    echo '
                    <div class="job-listing">
                        <div>
                            <h2 class="h5">' . htmlspecialchars($row["program_title"]) . '</h2>
                            <p><strong>Length:</strong> ' . htmlspecialchars($row["length"]) . '</p>
                            <p><strong>Components:</strong> ' . htmlspecialchars($row["components"]) . '</p>
                            <p><strong>Collaboration:</strong> ' . htmlspecialchars($row["collab_details"]) . '</p>
                        </div>
                        <div>
                            <a href="program_details.php?id=' . $row["program_id"] . '" class="btn btn-primary">Details</a>
                        </div>
                    </div>';
                }
            } else {
                echo "<p></p>";
            }
            ?>
        </div>
    </div>

   

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$con->close();
?>
