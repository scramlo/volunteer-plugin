<?php
$database_file = 'database.json';
$json_data = file_get_contents($database_file);
$tasks = json_decode($json_data);
session_start();

if (isset($_POST['volunteerName'])) {
  $_SESSION['alert'] = 'Thanks! We will connect with you soon!';

  for ($i=0; $i < count($tasks); $i++) {
    if ($i == $_POST['taskId']) {
      $tasks[$i]->volunteerName = $_POST['volunteerName'];
      $tasks[$i]->volunteerContact = $_POST['volunteerContact'];
      $tasks[$i]->approved = false;
    }
  }

  $open_database = fopen($database_file, 'w') or die("Error opening database file");
  fwrite($open_database, json_encode($tasks,JSON_PRETTY_PRINT));
  fclose($open_database);

  header('location: http://dev.nerdspecs.com/appvolunteerportal/pages/volunteer.php');

}
