<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Interns Management</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Interns Profile</h1>
    <?php
    session_start(); 

    if (isset($_SESSION['username'])) {
      $loggedUsername = $_SESSION['username'];

      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "interns_management";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Retrieve the profile_id associated with the logged-in user from the interns_account table
      $profileQuery = "SELECT profile_id FROM interns_account WHERE username = ?";
      $stmt = $conn->prepare($profileQuery);
      $stmt->bind_param("s", $loggedUsername);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result) {
        $profileRow = $result->fetch_assoc();

        if ($profileRow) {
          $profileId = $profileRow['profile_id'];

          $profileQuery = "SELECT * FROM interns_profile WHERE id = ?";
          $stmt = $conn->prepare($profileQuery);
          $stmt->bind_param("i", $profileId);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<h5 class="mb-3">Name: ' . $row["name"] . '</h5>';
            echo '<p>Gender: ' . $row["gender"] . '</p>';
            echo '<p>Age: ' . $row["age"] . '</p>';
            echo '<p>Birthday: ' . $row["birthday"] . '</p>';
            echo '<p>Contact number: ' . $row["contact_number"] . '</p>';
            echo '<p>School: ' . $row["school"] . '</p>';
            echo '<p>Course: ' . $row["course"] . '</p>';
            echo '<p>Department: ' . $row["department"] . '</p>';
            echo '<p>Hours required: ' . $row["hours_required"] . '</p>';
            echo '<p>Emergency contact: ' . $row["emergency_contact"] . '</p>';
        }
      }
    }
}
    ?>
    <div class="profile-pic-wrapper">
    <div class="pic-holder">
      <img id="profilePic" class="pic" src="https://th.bing.com/th/id/R.8e2c571ff125b3531705198a15d3103c?rik=gzhbzBpXBa%2bxMA&riu=http%3a%2f%2fpluspng.com%2fimg-png%2fuser-png-icon-big-image-png-2240.png&ehk=VeWsrun%2fvDy5QDv2Z6Xm8XnIMXyeaz2fhR3AgxlvxAc%3d&risl=&pid=ImgRaw&r=0">
      <Input class="uploadProfileInput" type="file" name="profile_pic" id="newProfilePhoto" accept="image/*" style="opacity: 0;" />
      <label for="newProfilePhoto" class="upload-file-block" >
        <div class="text-center">
          <div class="mb-2">
            <i class="fa fa-camera fa-2x"></i>
          </div>
          <div class="text-uppercase">
            Update <br /> Profile Photo
          </div>
        </div>
      </label>
    </div>
    </hr>
  </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax```"></script>
  <script src = "script.js"></script>
  </html>
