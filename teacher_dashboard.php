<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-image: url('teacher11.jpg'); /* Add the path to your image file */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .home-link {
            color: #fff;
            font-size: 18px;
            text-decoration: none;
        }

        .panel {
            background-color: rgba(255, 255, 255, 0.8); /* Adjust the background color and opacity */
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 20px;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .class-box {
            width: 120px;
            height: 80px;
            margin: 5px;
            padding: 30px;
            background-color: #000000;
            color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .class-box:hover {
            background-color: green; /* Change this to your desired hover color */
            color: #ffffff;
        }
    </style>
</head>
<body>

<div class="header">
    <div>
        Attendance System
    </div>
    <div>
        <a href="website.php" class="home-link">Home</a>
    </div>
</div>

<div class="panel">
    <?php
    // Display 12 class boxes
    for ($i = 1; $i <= 12; $i++) {
        echo '<div class="class-box" onclick="redirectToClass(' . $i . ')">';
        echo 'Class ' . $i;
        echo '</div>';
    }
    ?>
</div>

<script>
    function redirectToClass(classNumber) {
        // Redirect to attendance.php with the class number as a parameter
        window.location.href = 'attendance.php?class=' + classNumber;
    }
</script>

</body>
</html>
