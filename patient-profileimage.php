<?php 


include("database/db.php");


// Get user_id from session
$user_id = $_SESSION['user_id'];

$profile_image = "assets/img/default_profile_image.jpg";
// Get patient data
$sql = "SELECT profile_image FROM patient WHERE User_ID = $user_id";
$result = $connection->query($sql);
if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  
  // Use profile image if it exists
  if (!empty($row['profile_image'])) {
    // Remove "../" if it exists at the start
    if (strpos($row['profile_image'], '../../') === 0) {
      $profile_image = substr($row['profile_image'], 6);
    } else {
      $profile_image = $row['profile_image'];
      $_SESSION['profile_image']=$profile_image;
    }
  }
}
?>