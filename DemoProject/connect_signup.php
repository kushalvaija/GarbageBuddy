<?php
session_start();

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rohith';

// Create connection
$con = new mysqli($host, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get form data
$EMAIL = $_POST['email'];
$PASS_WORD = $_POST['psw'];
$confirm_password = $_POST['psw-repeat'];

if ($PASS_WORD !== $confirm_password) {
    $_SESSION['error'] = "Passwords did not match";
    header("Location: signup.php");
    exit();
}

// Check if email already exists
$check_email = $con->prepare("SELECT email FROM signup WHERE email = ?");
$check_email->bind_param("s", $EMAIL);
$check_email->execute();
$result = $check_email->get_result();

if ($result->num_rows > 0) {
    $_SESSION['error'] = "Email already exists";
    header("Location: signup.php");
    exit();
}

// Store the actual password without hashing
$stmt = $con->prepare("INSERT INTO signup (email, psw) VALUES (?, ?)");
$stmt->bind_param("ss", $EMAIL, $PASS_WORD);

if ($stmt->execute()) {
    // Set session variables
    $_SESSION['user_email'] = $EMAIL;
    $_SESSION['success'] = "Welcome to Garbage Buddy! Your account has been created successfully. Start making a difference in your community!";
    
    // Redirect to home page
    header("Location: home.php");
    exit();
} else {
    $_SESSION['error'] = "Error: " . $stmt->error;
    header("Location: signup.php");
    exit();
}

$stmt->close();
$con->close();
?>
