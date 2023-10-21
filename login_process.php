<?php
session_start();
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
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM interns_account WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            // Password is correct, set session variables
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $username;
            header("Location: dashboard.php"); 
        } else {
            echo '<script>alert("Incorrect password!"); window.location.href = "internslogin.php";</script>';
        }
    } else {
        echo '<script>alert("Username not found!"); window.location.href = "internslogin.php";</script>';
    }

    $stmt->close();
}

$conn->close();
?>
