<?php 
session_start();
include "db_conn.php";


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

  // Check if the user has submitted the form to change their password
  if(isset($_POST['new_password'])) {
    // Get the new password from the form
    $new_password = $_POST['new_password'];
    // Update the password in the user table in the database
    $user_id = $_SESSION['id'];
    $query = "UPDATE user SET password = '$new_password' WHERE id = $user_id";
    mysqli_query($db_conn, $query);
    // Show a success message to the user
    echo "<p>Password changed successfully!</p>";
  }
}
 ?>