<?php
session_start();
require 'database.php'; // Database connection

// CSRF Token generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Redirect if not logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.html');
    exit();
}

// Fetch user details
$email = $_SESSION['email'];
$stmt = $con->prepare("SELECT full_name, email, phone, gender, company, dob FROM admin_profiles WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($fullName, $email, $phone, $gender, $company, $dob);
$stmt->fetch();
$stmt->close();

$updateMessage = '';

// Update profile if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token");
    }

    $fullName = $_POST['full_name'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $company = $_POST['company'];
    $dob = $_POST['dob'];

    $stmt = $conn->prepare("UPDATE admin_profiles SET full_name=?, phone=?, gender=?, company=?, dob=? WHERE email=?");
    $stmt->bind_param("ssssss", $fullName, $phone, $gender, $company, $dob, $email);

    if ($stmt->execute()) {
        $updateMessage = "Profile updated successfully!";
    } else {
        $updateMessage = "Error updating profile: " . $stmt->error;
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
    <title>Profile Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
  background-image: url("wallpaper 4.jpg");
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}
        .container {
            max-width: 500px;
            margin-top: 50px;
            background: rgba(255, 255, 255, 0.1);
  border: 2px solid rgba(255, 255, 255, 0.5);
  backdrop-filter: blur(55px);
  padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .message {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }
       
    </style>
</head>
<body class="bg-light">

<div class="container">
    <h2 class="text-center mb-4">Profile Page</h2>

    <?php if ($updateMessage): ?>
        <p class="message"><?php echo $updateMessage; ?></p>
    <?php endif; ?>
    
    <form action="profile.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" class="form-control" name="full_name" value="<?php echo htmlspecialchars($fullName); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" class="form-control" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if ($gender == 'Other') echo 'selected'; ?>>Other</option>
                <option value="Prefer not to say" <?php if ($gender == 'Prefer not to say') echo 'selected'; ?>>Prefer not to say</option>
            </select>
        </div>

        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" class="form-control" name="company" value="<?php echo htmlspecialchars($company); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
    </form>
    <div class="text-center mt-3">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
