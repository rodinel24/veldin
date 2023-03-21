<?php 
session_start();
require_once 'db_connection.php';

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 // Check if the form has been submitted
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the user's current password from the database
  $stmt = $pdo->prepare('SELECT password FROM users WHERE id = :id');
  $stmt->execute(['id' => $_SESSION['id']]);
  $user = $stmt->fetch();

  // Verify the user's current password
  if (password_verify($_POST['current_password'], $user['password'])) {
   // Generate a random OTP code
   $otp_code = rand(100000, 999999);

   // Store the OTP code in the database along with the user's ID and a timestamp
   $stmt = $pdo->prepare('INSERT INTO otp_codes (user_id, otp_code, created_at) VALUES (:user_id, :otp_code, NOW())');
   $stmt->execute(['user_id' => $_SESSION['id'], 'otp_code' => $otp_code]);

   // Send the OTP code to the user's email address
   $to = $_SESSION['email'];
   $subject = 'OTP verification code';
   $message = 'Your OTP code is: ' . $otp_code;
   $headers = 'From: your_email@example.com' . "\r\n" .
              'Reply-To: your_email@example.com' . "\r\n" .
              'X-Mailer: PHP/' . phpversion();

   if (mail($to, $subject, $message, $headers)) {
     // Redirect the user to the OTP verification page
     header("Location: verify_otp.php");
     exit();
   } else {
     // Display an error message if the email failed to send
     $error = 'Failed to send OTP code. Please try again.';
   }

  } else {
   // Display an error message if the user's current password is incorrect
   $error = 'Incorrect password';
  }
 }
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <h1>Change Password</h1>
     <?php if (isset($error)) { echo '<p>' . $error . '</p>'; } ?>
     <form method="post">
      <label for="current_password">Current Password:</label>
      <input type="password" id="current_password" name="current_password" required>
      <br>
      <button type="submit">Get OTP Code</button>
     </form>
     <a href="profile.php">Cancel</a>
</body>
</html>
