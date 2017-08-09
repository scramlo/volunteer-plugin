<?php include_once('../partials/head.inc'); ?>

<?php
  $database_file = '../database.json';
  $json_data = file_get_contents($database_file);
  $tasks = json_decode($json_data);
  date_default_timezone_set('America/Indiana/Indianapolis');

if ($tasks) {
  //sort by timestamp
  usort($tasks, function($a, $b) {
    return $a - $b;
  });
}
?>

<div id="task-window">
  <h3 id="task-window-title"></h3>
  <p id="task-window-body"></p>
  <form action="../take_volunteer.php" method="POST">
    <label for="volunteerName">Enter your name</label><br>
    <input type="text" name="volunteerName" value=""><br>
    <label for="volunteerContact">Enter contact info (phone number, email, etc) that you want us to use to follow up with this task.</label><br>
    <input type="text" name="volunteerContact" value=""><br>
    <input id="task-window-task-id" type="hidden" name="taskId" value=""><br>
    <div class="align-center">
      <button type="submit" name="submit" id="task-window-take">Take It!</button>
    </div>
  </form>
  <div class="align-center">
    <button type="button" name="close-task" id="task-window-close" onclick="closeTaskWindow()">Close</button>
  </div>
</div>

<main id="main-volunteer-window">

<h1>Volunteer Tasks</h1>

<h2>Open Tasks</h2>
<?php
  echo '<ul class="app-list">';
  for ($i=0; $i < count($tasks); $i++) {
    $task = $tasks[$i];
    $title = $task->title;
    if (strlen($title) > 12) {
      $title = substr($task->title, 0, 14) . '...';
    }
    if ($task->approved === false) {
      if ($task->volunteerName !== "") {$task_type = "pending-task";} else {$task_type = "open-task";}
      echo '<li class="app-list-item '.$task_type.'" data-id="'.$task->id.'" data-title="'.$task->title.'" data-description="'.$task->description.'">';
      echo '<div class="app-list-item-content-wrapper">';
      echo $title . '<br>';
      echo '<small>' . date('D, M d',$task->createdAt) . '</small>';
      echo '</div>';
      if ($task->volunteerName !== "") {
      echo '<div><em class="muted">Pending</em></div>';
      }
      echo '<div class="app-list-item-symbol-wrapper"><span class="app-list-item-symbol">&#12297;</span></div>';
      echo '</li>';
    }
  }
  echo '</ul>';
?>

<h2>Taken Tasks</h2>
<?php
  echo '<ul class="app-list">';
  for ($i=0; $i < count($tasks); $i++) {
    $task = $tasks[$i];
    if ($task->approved === true) {
      echo '<li class="app-list-item open-task" data-id="'.$task->id.'" data-title="'.$task->title.'" data-description="'.$task->description.'">';
      echo '<div class="app-list-item-content-wrapper">';
      echo $task->title . '<br>';
      echo '<small>' . date('D, M d',$task->createdAt) . '</small>';
      echo '</div>';
      echo '<div class="app-list-item-symbol-wrapper"><span class="app-list-item-symbol">&#12297;</span></div>';
      echo '</li>';
    }
  }
  echo '</ul>';
?>

</main>

<?php include_once('../partials/foot.inc'); ?>
