<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-image: url('school3.jpeg'); /* Add the path to your image file */
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
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

        input[type="text"],
        input[type="password"] {
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Add more styles as needed */
    </style>
</head>
<body>

<h2>Teacher Login</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
</form>

</body>
</html>

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

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQL query to check if the provided credentials are valid
    $sql = "SELECT * FROM teacher WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful, redirect to the teacher's dashboard or another page
        header("Location: teacher_dashboard.php");
        exit;
    } else {
        // Login failed
        echo "Invalid username or password!";
    }
}

// Close the database connection
$conn->close();
?>
