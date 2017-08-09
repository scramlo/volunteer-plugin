<?php
session_start();

$script_name = basename($_SERVER['SCRIPT_NAME'], '.php');

if ($script_name === 'index') {
  $title = 'Volunteer Tasks';
} elseif ($script_name === 'admin') {
  $title = 'Volunteer Admin';
} elseif ($script_name === 'volunteer') {
  $title = 'Pick a task!';
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title ?></title>
    <?php if (basename($_SERVER['SCRIPT_NAME']) === 'index.php'): ?>
      <link rel="stylesheet" href="css/global.css">
      <link rel="stylesheet" href="css/index.css">
    <?php else: ?>
      <link rel="stylesheet" href="../css/global.css">
      <link rel="stylesheet" href="../css/<?= basename($_SERVER['SCRIPT_NAME'], '.php') ?>.css" charset="utf-8"></script>
    <?php endif; ?>
  </head>
  <body>
  <?php
    if (isset($_SESSION['alert'])) {
      echo '<div id="alert-wrap">';
        echo '<div id="alert-body">' . $_SESSION['alert'] . '</div>';
        echo '<div id="alert-exit" onclick="removeAlert()">X</div>';
      echo '</div>';
      session_unset();
    }
  ?>
