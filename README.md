PHP Job App on Google Cloud Platform(GCP)
----------------------------------------
This project demonstrates the deployment of a PHP web application on GCP Platform.

Features:
* Allow users to register with professional details.
* View updated details
* MySql database: storing registered data
  
Requirements:
- Account on GCP(VM instance)
- Web server(ex-Apache2...)
- PHP 8.4 package/modules
- MySql database server access
- NoMachine remote desktop s/w access
- Host system access(laptop/computer)

## Deployement Process : Getting started
-----------------------------------------
### Prerequisites:
- A system(laptop/computer)
- Account on GCP(Google cloud Platform)
- Knowledge on GCP

Step-1: Creation of GCP Account
----------------------------------------
- Creating account on GCP(iitj.ac.in)
- Creating new project on GCP account with organisation(IITJ)
  
Step-2: Creation and Configuration of VM instance
--------------------------------------------------
- Creation of 3vms named as vm-g23ai2082-1, vm-g23ai2082-2, vm-g23ai2082-3 on top of VM instance of GCP

Step-3: Installation on Virtual machine instances
--------------------------------------------------
### VM1:
- Installation of web server(ex- Apache2 on VM1)
```bash
	- sudo apt update
	- sudo apt install apache2 -y
	- sudo systemctl start apache2
	- sudo systemctl enable apache2
```
- Installation of necessary PHP modules
```bash
	- sudo apt install php libapache2-mod-php php-mysql -y
```
- Restart apache to load PHP modules
```bash
	- sudo systemctl restart apache2
```
- Develop PHP application on VM1
```bash
	- sudo nano /var/www/html/newproject.php
```

VM2:
------------------------------------------------
- Installation of MySQL database on VM2
```bash
	- sudo apt update
	- sudo apt install mysql-server -y
	- sudo systemctl start mysql
	- sudo systemctl enable mysql
```
- secure Installation
```bash
	- sudo mysql_secure_installation
```
- Create database user with password
```bash
	- sudo mysql -u root -p
```
- Create Database and table
```bash
CREATE DATABASE my_db;
CREATE USER 'arpita'@'%' IDENTIFIED BY 'arpita1205';
GRANT ALL PRIVILEGES ON my_db.* TO 'arpita'@'%';
FLUSH PRIVILEGES;
EXIT;
```
```bash
CREATE TABLE job_applied(
    id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    job_role VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    city VARCHAR(255) NOT NULL,
    pincode INT NOT NULL,
    date DATE NOT NULL,
    cv_file BLOB NOT NULL,
    PRIMARY KEY(id)
);
```
VM3:
---------------------------------------------
- Installation of web server and NoMachine remote desktop s/w on VM3
```bash
	- sudo apt update
	- sudo apt install apache2 -y
	- sudo systemctl start apache2
	- sudo systemctl enable apache2
```
```bash
	- wget https://download.nomachine.com/download/8.13/Linux/nomachine_8.13.1_1_amd64.deb

	- sudo apt install ./nomachine_8.13.1_1_amd64.deb
```
switch to root user and set user for administrative privileges
```bash
	- sudo -s
	- passwd
	- adduser arpita
	- usermod -a -G sudo sdm arpita
```
Step-4: VPC Setup : Firewall rules Setup
-----------------------------------------
Allow-mysql Firewall rule Creation:

	- Create a firewall rules to enable access for mysql server and web server on virtual machines and providing proxy system for internal HTTP load-balancing.
	- This firewall enables the tcp:3306 port which enables the python web server to connect to mysql server.

Step-5: Accessing PHP Application on host machine
----------------------------------------------------
- Accessibility of the webserver on local machine (host machine) and the ability to dynamically query the database entity as well add any new records to the selected tables using external IP of VM1.

Step-6: Accessing web application on VM3 with nomachine s/w
-------------------------------------------------------------
- In order to get GUI and browser access in vm3 instance we are installing Ubuntu desktop on top of vm-g23ai2082-3 (vm3).
- Install the Ubuntu desktop on VM3
- Reboot VM3
```bash
	- sudo apt-get install ubuntu-desktop
	- sudo reboot
```
- Download nomachine app on host system to access VM3 
- We are using noMachine remote desktop software in order to run our vm-g23ai2082-3 ubuntu desktop features on local machine with GUI support and NoMachine allows us to access and control the vm3 remotely over a network.

job_app.php
--------------------
```bash
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
```
--------------------------------------------------

- Author: Arpita Kundu(g23ai2082)IITJ
