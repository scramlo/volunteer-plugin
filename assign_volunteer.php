<?php
$database_file = 'database.json';
$json_data = file_get_contents($database_file);
$tasks = json_decode($json_data);
session_start();

if (isset($_POST['volunteerName'])) {
  $_SESSION['alert'] = $_POST['volunteerName'] . ' Assigned.';
  for ($i=0; $i < count($tasks); $i++) {
    if ($i == $_POST['taskId']) {
      $tasks[$i]->volunteerName = $_POST['volunteerName'];
      $tasks[$i]->volunteerContact = $_POST['volunteerContact'];
      $tasks[$i]->approved = true;
    }
  }

  $open_database = fopen($database_file, 'w') or die("Error opening database file");
  fwrite($open_database, json_encode($tasks,JSON_PRETTY_PRINT));
  fclose($open_database);

  header('location: http://dev.nerdspecs.com/appvolunteerportal/pages/admin.php');

}
