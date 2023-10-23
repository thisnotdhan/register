<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS interns_management";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating database: " . $conn->error . "<br>";
}
$conn->close();

// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, "interns_management");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the interns_profile table
$sql = "CREATE TABLE IF NOT EXISTS interns_profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    age INT,
    birthday DATE,
    contact_number VARCHAR(20) NOT NULL,
    school VARCHAR(255) NOT NULL,
    course VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    hours_required INT,
    emergency_contact VARCHAR(20) NOT NULL
)";

if ($conn->query($sql) !== TRUE) {
    echo "Error creating table: " . $conn->error;
}

// Create the interns_account table with a foreign key reference
$sql = "CREATE TABLE IF NOT EXISTS interns_account (
    id INT AUTO_INCREMENT PRIMARY KEY,
    profile_id INT NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY (profile_id) REFERENCES interns_profile(id)
)";

if ($conn->query($sql) !== TRUE) {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="container p-3">
        <div class="card d-flex flex-column justify-content-between flex-wrap gap-1 shadow" style="padding: 3rem 2rem; padding-left:3rem;">
            <div class="card-header">
                <h2>Registration</h2>
            </div>
            <div class="card-body d-flex">
                <form id="registration-form" action="register_process.php" method="post">
                    <!-- Page 1: Personal Information -->

                    <div class="form-page" id="page-1">
                        <div class="form-group d-flex flex-row justify-content-between gap-5">
                            <span class="d-flex flex-column" style="width:49%;">
                                <label for="name">First Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </span>

                            <span class="d-flex flex-column" style="width:50%;">
                                <label for="name">Last Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </span>
                        </div>
                        <div class="form-group d-flex flex-row gap-5">
                            <span class="d-flex flex-column" style="width:50%;">
                                <label for="age">Age</label>
                                <input type="number" id="age" name="age" class="form-control" required>
                            </span>
                            <span class="d-flex flex-column" style="width:50%;">
                                <label for="birthday">Birthday</label>
                                <input type="date" id="birthday" name="birthday" class="form-control" required>
                            </span>

                        </div>
                        <div class="form-group d-flex flex-column">
                            <label for="contact-number">Contact Number</label>
                            <input type="tel" id="contact-number" name="contact-number" class="form-control" required>
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label for="school">School</label>
                            <input type="text" id="school" name="school" class="form-control" required>
                        </div>
                        <div class="form-group d-flex flex-column">
                            <label for="course">Course</label>
                            <input type="text" id="course" name="course" class="form-control" required>
                        </div>
                        <span>
                            <div class="form-group">
                                <label for="gender">Sex</label>
                                <div class="form-check d-flex flex-row gap-5">
                                    <span>
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Male
                                        </label>
                                    </span>
                                    <span>
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Female
                                        </label></span>
                                </div>
                        </span>
                        <div class="d-flex justify-content-end mt-5">
                            <button type="button" class="btn btn-primary next-page" data-next="page-2">Next</button>
                        </div>

                    </div>


                    <!-- Page 2: Additional Information -->
                    <div class="form-page" id="page-2" style="display: none;">
                        <div class="form-group">
                            <label for="department">Designated Department</label>
                            <input type="text" id="department" name="department" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="hours-required">Hours Required</label>
                            <input type="number" id="hours-required" name="hours-required" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="emergency-contact">Emergency Contact</label>
                            <input type="tel" id="emergency-contact" name="emergency-contact" class="form-control" required>
                        </div>
                        <button type="button" class="btn btn-secondary prev-page" data-prev="page-1">Previous</button>
                        <button type="button" class="btn btn-primary next-page" data-next="page-3">Next</button>
                    </div>

                    <!-- Page 3: Username and Password -->
                    <div class="form-page" id="page-3" style="display: none;">
                        <div class="form-group">
                            <label for="id_name">Username</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" id="confirm-password" name="confirm-password" class="form-control" required>
                        </div>
                        <button type="button" class="btn btn-secondary prev-page" data-prev="page-2">Previous</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>
                <span>
                    <div class="d-flex flex-row">
                        <img class="img-fluid" src="https://th.bing.com/th/id/OIP.j_Q3KTsWwEgFiJeHVlz6NgHaJ4?pid=ImgDet&rs=1">
                    </div>
                </span>

            </div>
        </div>
    </div>
    <script src="register.js"></script>
</body>

</html>