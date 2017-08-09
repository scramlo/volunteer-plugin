<?php

session_start();

$submitted_pw = $_POST['password'];

if ($submitted_pw === "") {
  $_SESSION['admin'] = true;
  $_SESSION['alert'] = "Successfully logged in.";
  header('Location: http://dev.nerdspecs.com/appvolunteerportal/pages/admin.php');
} else {
  $_SESSION['alert'] = "That password is incorrect.";
  header('Location: http://dev.nerdspecs.com/appvolunteerportal/');
}
