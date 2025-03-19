<?php
require 'database.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['full_name'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $company = $_POST['company'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Check if email already exists
    $checkEmail = "SELECT * FROM admin_profiles WHERE email = ?";
    $stmt = $con->prepare($checkEmail);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "This email is already registered. Please use a different email.";
    } else {
        // Insert data into the admin_profiles table
        $sql = "INSERT INTO admin_profiles (full_name, dob, phone, gender, email, password, company) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssssss", $fullName, $dob, $phone, $gender, $email, $password, $company);

        if ($stmt->execute()) {
            header("Location:main.php"); // Redirect to login page
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
}

$con->close();
?>
