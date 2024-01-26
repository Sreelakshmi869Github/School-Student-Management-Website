php
<?php
// Establish connection with your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve student ID from the form
$student_id = $_POST['student_id'];

// Insert attendance into the database
$sql = "INSERT INTO attendance (student_id, attendance_date) VALUES ('$student_id', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "Attendance submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>