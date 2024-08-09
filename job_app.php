<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Application Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            flex-wrap: wrap;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 45%;
            margin: 10px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
	    margin-bottom: 5px;
        }
	input[type="text"], input[type="email"], input[type="number"], input[type="date"], textarea, input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .form-group {
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
	}
	th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
	<div class="container">
        <h2>Job Application Form</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" placeholder="Enter First Name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="job_role">Job Role:</label>
                <input type="text" id="job_role" name="job_role" placeholder="Enter your role" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" placeholder="Enter Full Address" required></textarea>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" placeholder="Enter City" required>
            </div>
            <div class="form-group">
                <label for="pincode">Pincode:</label>
                <input type="number" id="pincode" name="pincode" placeholder="Enter Pincode" required>
            </div>
	    <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" value="2024-07-26" required>
            </div>
            <div class="form-group">
                <label for="cv">Upload Your CV:</label>
                <input type="file" id="cv" name="cv" required>
            </div>
            <input type="submit" value="Apply Now">
        </form>
    </div>
    <div class="container">
        <h2>Job Applications</h2>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Job Role</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Pincode</th>
                </tr>
            </thead>
	    <tbody>
                <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                $servername = "10.128.0.5";
                $username = "arpita";
                $password = "arpita1205";
                $dbname = "my_db";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $first_name = $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $email = $_POST['email'];
                    $job_role = $_POST['job_role'];
                    $address = $_POST['address'];
                    $city = $_POST['city'];
                    $pincode = $_POST['pincode'];
                    $date = $_POST['date'];

                    $cv_file_name = rand(1000, 10000) . "-" . basename($_FILES["cv"]["name"]);
                    $target_dir = "uploads/"; 
                    $target_file = $target_dir . $cv_file_name;

                    if (move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file)) {
			$sql = "INSERT INTO job_applied (first_name, last_name, email, job_role, address, city, pincode, date, cv) VALUES ('$first_name', '$las>
                        if ($conn->query($sql) === TRUE) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
		$sql = "SELECT first_name, last_name, email, job_role, address, city, pincode FROM job_applied";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["first_name"] . "</td>";
                        echo "<td>" . $row["last_name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["job_role"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "<td>" . $row["city"] . "</td>";
                        echo "<td>" . $row["pincode"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>