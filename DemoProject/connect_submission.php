<?php
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

// Create submissions table if it doesn't exist
$createTable = "CREATE TABLE IF NOT EXISTS submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_email VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    location VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    description TEXT NOT NULL,
    photo_path VARCHAR(255) NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_email) REFERENCES signup(email)
)";

if (!$con->query($createTable)) {
    die("Error creating table: " . $con->error);
}

// Function to save submission
function saveSubmission($con, $user_email, $name, $phone, $location, $date, $time, $description, $photo_path) {
    $stmt = $con->prepare("INSERT INTO submissions (user_email, name, phone, location, date, time, description, photo_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $user_email, $name, $phone, $location, $date, $time, $description, $photo_path);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Function to get user submissions
function getUserSubmissions($con, $user_email) {
    $stmt = $con->prepare("SELECT * FROM submissions WHERE user_email = ? ORDER BY submission_date DESC");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $submissions = [];
    while ($row = $result->fetch_assoc()) {
        $submissions[] = $row;
    }
    
    return $submissions;
}
?> 