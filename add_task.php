<?php
$database_file = 'database.json';
$json_data = file_get_contents($database_file);
$tasks = json_decode($json_data, true);
session_start();

if (isset($_POST['createdBy'])) {
  $_SESSION['alert'] = $_POST['title'] . ' successfully created.';

  $createdBy = $_POST['createdBy'];
  $timestamp = time();
  $description = $_POST['description'];
  $title = $_POST['title'];
  $id = count($tasks);

  //create new task array
  $newTask = [
    'id' => $id,
    'title' => $title,
    'description' => $description,
    'createdBy' => $createdBy,
    'createdAt' => $timestamp,
    'volunteerName' => '',
    'volunteerContact' => '',
    'approved' => false
  ];

  //add this array to the $tasks associatve array
  array_push($tasks, $newTask);

  $open_database = fopen($database_file, 'w') or die("Error opening database file");
  fwrite($open_database, json_encode($tasks,JSON_PRETTY_PRINT));
  fclose($open_database);

  header('location: http://dev.nerdspecs.com/appvolunteerportal/pages/admin.php');
}
