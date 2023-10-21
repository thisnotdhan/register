<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interns_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $birthday = $_POST["birthday"];
    $contact_number = $_POST["contact-number"];
    $school = $_POST["school"];
    $course = $_POST["course"];
    $department = $_POST["department"];
    $hours_required = $_POST["hours-required"];
    $emergency_contact = $_POST["emergency-contact"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];
    
    if ($password !== $confirmPassword) {
        echo '<script>alert("Passwords do not match!");</script>';
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }
    
    // Prepare and bind SQL statement for profile insertion
    $stmt_profile = $conn->prepare("INSERT INTO interns_profile (name, gender, age, birthday, contact_number, school, course, department, hours_required, emergency_contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_profile->bind_param("ssisssssis", $name, $gender, $age, $birthday, $contact_number, $school, $course, $department, $hours_required, $emergency_contact);
    
    $success_profile = $stmt_profile->execute(); // Execute profile insertion
    
    $profile_id = $conn->insert_id; // Get the inserted profile's ID
    
    $stmt_profile->close(); // Close the profile statement
    
    // Prepare and bind SQL statement for account insertion
    $stmt_account = $conn->prepare("INSERT INTO interns_account (profile_id, username, password) VALUES (?, ?, ?)");
    $stmt_account->bind_param("iss", $profile_id, $username, $hashedPassword);
    
    $success_account = $stmt_account->execute(); // Execute account insertion
    
    $stmt_account->close(); // Close the account statement
    
    // Check if both insertions were successful
    if ($success_profile && $success_account) {
        // Display success alert message and redirect to internslogin.php
        echo '<script>alert("Registration successful!"); window.location.href = "internslogin.php";</script>';
    } else {
        echo '<script>alert("Error: ' . $stmt_account->error . '");</script>';
    }
}

$conn->close();
?>
