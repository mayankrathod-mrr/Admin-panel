

<?php
// Ensure these values are set correctly according to your database configuration
$host = 'localhost';     // Database host
$username = 'root';      // Database username
$password = '';          // Database password
$dbname = 'admin_panel'; // Your database name

// Create connection
$con = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
