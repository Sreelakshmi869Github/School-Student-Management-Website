<?php
// Database connection parameters
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $studentId = isset($_POST['student_id']) ? $_POST['student_id'] : '';
    $selectedClass = isset($_POST['class']) ? $_POST['class'] : '';
    $fromDate = isset($_POST['from_date']) ? $_POST['from_date'] : '';
    $toDate = isset($_POST['to_date']) ? $_POST['to_date'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    // Fetch student name
    $sqlStudentName = "SELECT `sname` FROM `$selectedClass` WHERE `sid` = '$studentId'";
    $resultStudentName = $conn->query($sqlStudentName);
    $studentName = ($resultStudentName->num_rows > 0) ? $resultStudentName->fetch_assoc()['sname'] : '';

    // Fetch details from attendance_records based on the provided parameters
    $sql = "SELECT * FROM `attendance_records` WHERE `student_id` = '$studentId' AND `class` = '$selectedClass' AND `date` BETWEEN '$fromDate' AND '$toDate' ORDER BY `date` ASC";
    $result = $conn->query($sql);

    // Display details
    echo '<div class="container">';
    echo '<h1>Student Attendance Details</h1>';
    
    // Display form data
    echo '<p><strong>Student ID:</strong> ' . $studentId . '</p>';
    echo '<p><strong>Student Name:</strong> ' . $studentName . '</p>';
    echo '<p><strong>Class:</strong> ' . $selectedClass . '</p>';
    echo '<p><strong>From Date:</strong> ' . $fromDate . '</p>';
    echo '<p><strong>To Date:</strong> ' . $toDate . '</p>';
    echo '<p><strong>Address:</strong> ' . $address . '</p>';

    // Display attendance records
    if ($result->num_rows > 0) {
        echo '<h2>Attendance Records</h2>';
        echo '<table>';
        echo '<tr>';
        echo '<th>Date</th>';
        echo '<th>Status</th>';
        echo '</tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No attendance records found for the given parameters.</p>';
    }

    echo '</div>';
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance System</title>
    <link rel="stylesheet" href="attendancestyle.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        background-image: url('school7.jpg'); /* Add the path to your image file */
            background-size: cover;
            background-repeat: no-repeat;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 50px;
        width: 400px;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    label {
        margin-top: 10px;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input, select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        cursor: pointer;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    .home-link {
        margin-top: 20px;
        text-align: center;
    }
</style>

<body>
    <div class="container">
        <h1>Student Attendance</h1>
        <form action="" method="post">
            <label for="student_id">Student ID:</label>
            <input type="text" id="student_id" name="student_id" required>

            <label for="class">Class:</label>
            <select id="class" name="class" required>
                <option value="1st">1st</option>
                <option value="2nd">2nd</option>
                <option value="3rd">3rd</option>
                <option value="4th">4th</option>
                <option value="5th">5th</option>
                <!-- Add options for 6th to 12th as needed -->
            </select>

            <label for="from_date">From Date:</label>
            <input type="date" id="from_date" name="from_date" required>

            <label for="to_date">To Date:</label>
            <input type="date" id="to_date" name="to_date" required>

            <input type="submit" value="Get Details">
        </form>
    </div>
</body>
</html>
