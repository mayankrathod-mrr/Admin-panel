<?php
session_start();  // Start the session

// Destroy all sessions
session_destroy();

// Redirect to the signup page
header("Location: index.php");
exit();
?>
