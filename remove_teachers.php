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

// Admin validation (you may want to implement your own admin validation logic)


// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teacher_id = $_POST["teacher_id"];
    $teacher_name = $_POST["teacher_name"];

    // Use either tid or tname to remove the teacher
    if (!empty($teacher_id)) {
        $sql = "DELETE FROM teacher WHERE tid = $teacher_id";
    } elseif (!empty($teacher_name)) {
        $sql = "DELETE FROM teacher WHERE tname = '$teacher_name'";
    } else {
        echo "Error: Please provide either teacher ID or teacher name for removal.";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Teacher removed successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Teachers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('teacher22.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        form {
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        h2 {
            color: #333;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- HTML form for removing teachers -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h2>Remove Teachers</h2>

    Teacher ID: <input type="number" name="teacher_id"><br>
    OR<br>
    Teacher Name: <input type="text" name="teacher_name"><br>
    <input type="submit" value="Remove Teacher">
</form>

</body>
</html>
