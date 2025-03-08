<?php
$servername = "localhost"; // Change to your database host
$username = "root"; // Change to your MySQL username
$password = "bc3#02El"; // Change to your MySQL password
$dbname = "course_registration"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$student_id = $_POST['student_id'];
$email = $_POST['email'];
$enrollment_status = $_POST['enrollment_status'];
$courses = implode(", ", $_POST['courses']); // Convert array to string

// Prepare SQL statement
$sql = "INSERT INTO registrations (first_name, last_name, student_id, email, enrollment_status, selected_courses) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $first_name, $last_name, $student_id, $email, $enrollment_status, $courses);

if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
