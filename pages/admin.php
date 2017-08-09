<?php include_once('../partials/head.inc'); ?>
<?php session_start(); ?>
<?php if ($_SESSION['admin'] = true): ?>

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
  <h2>Assign Volunteer</h2>
  <h3 id="task-window-title"></h3>
  <p id="task-window-body"></p>
  <form action="../assign_volunteer.php" method="POST">
    <label for="volunteerName">Enter a volunteer's name</label><br>
    <input type="text" name="volunteerName" value=""><br>
    <label for="volunteerContact">Enter contact info for this person (email, phone number, etc).</label><br>
    <input type="text" name="volunteerContact" value=""><br>
    <input id="task-window-task-id" type="hidden" name="taskId" value=""><br>
    <div class="align-center">
      <button type="submit" name="submit" id="task-window-take">Assign</button>
    </div>
  </form>
  <div class="align-center">
    <button type="button" name="close-task" id="task-window-close" onclick="closeTaskWindow()">Close</button>
  </div>
</div>

<div id="pending-task-window">
  <h2>Approve Volunteer</h2>
  <h3 id="pending-task-window-title"></h3>
  <p id="pending-task-window-body"></p>
  <hr>
  <div id="pending-volunteer-wrapper">
    <h3 class="align-center" id="pending-task-window-volunteer"></h3>
    <p class="align-center" id="pending-task-window-contact"></p>
  </div>
  <form action="../approve_volunteer.php" method="POST">
    <input id="pending-task-window-task-id" type="hidden" name="taskId" value=""><br>
    <div class="align-center">
      <button type="submit" name="approve" id="pending-task-window-approve">Approve</button>
    </div>
    <div class="align-center">
      <button type="submit" name="deny" id="pending-task-window-deny">Deny</button>
    </div>
  </form>
  <div class="align-center">
    <button type="button" name="close-task" id="pending-task-window-close" onclick="closePendingTaskWindow()">Close</button>
  </div>
</div>

<div id="new-task-window">
  <h2 id="new-task-window-title">Create New Task</h2>
  <p id="new-task-window-body">You may create a new task here by adding a title, description, and your name.</p>
  <form id="new-task-form" action="../add_task.php" method="POST">
    <label for="title">Enter the title</label><br>
    <input type="text" name="title" value=""><br>
    <label for="description">Description of task</label><br>
    <textarea name="description" form="new-task-form"></textarea><br>
    <label for="createdBy">Created by</label><br>
    <input type="text" name="createdBy" value=""><br>
    <div class="align-center">
      <button type="submit" name="submit" id="new-task-window-take">Create Task</button>
    </div>
  </form>
  <div class="align-center">
    <button type="button" name="close-new-task" id="new-task-window-close" onclick="closeNewTaskWindow()">Close</button>
  </div>
</div>

<main id="main-admin-window">
  <h1>Admin</h1>

  <h2>Pending Tasks</h2>
  <?php
    echo '<ul class="app-list">';
    for ($i=0; $i < count($tasks); $i++) {
      $task = $tasks[$i];
      $title = $task->title;
      if (strlen($title) > 12) {
        $title = substr($task->title, 0, 17) . '...';
      }
      if ($task->approved === false && $task->volunteerName !== "") {
        $task_type = "pending-task";
        $status="Pending";
        echo '<li class="app-list-item '.$task_type.'" data-contact="'.$task->volunteerContact.'" data-volunteer="'.$task->volunteerName.'" data-id="'.$task->id.'" data-title="'.$task->title.'" data-description="'.$task->description.'">';
        echo '<div class="app-list-item-content-wrapper">';
        echo $title . '<br>';
        echo '<small>' . date('D, M d',$task->createdAt) . '</small>';
        echo '</div>';
        echo '<div><em class="muted">'.$status.'</em></div>';
        echo '<div class="app-list-item-symbol-wrapper"><span class="app-list-item-symbol">&#12297;</span></div>';
        echo '</li>';
      }
    }
    echo '</ul>';
  ?>

  <h2>Open Tasks</h2>
  <?php
    echo '<ul class="app-list">';
    for ($i=0; $i < count($tasks); $i++) {
      $task = $tasks[$i];
      $title = $task->title;
      if (strlen($title) > 12) {
        $title = substr($task->title, 0, 17) . '...';
      }
      if ($task->approved === false && $task->volunteerName === "") {
        $task_type = "open-task";
        $status="Open";
        echo '<li class="app-list-item '.$task_type.'" data-contact="'.$task->volunteerContact.'" data-volunteer="'.$task->volunteerName.'" data-id="'.$task->id.'" data-title="'.$task->title.'" data-description="'.$task->description.'">';
        echo '<div class="app-list-item-content-wrapper">';
        echo $title . '<br>';
        echo '<small>' . date('D, M d',$task->createdAt) . '</small>';
        echo '</div>';
        echo '<div><em class="muted">'.$status.'</em></div>';
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
    $title = $task->title;
    if (strlen($title) > 12) {
      $title = substr($task->title, 0, 17) . '...';
    }
    if ($task->approved === true) {
      echo '<li class="app-list-item task-taken" data-contact="'.$task->volunteerContact.'" data-volunteer="'.$task->volunteerName.'" data-id="'.$task->id.'" data-title="'.$task->title.'" data-description="'.$task->description.'">';
      echo '<div class="app-list-item-content-wrapper">';
      echo $title . '<br>';
      echo '<small>' . date('D, M d',$task->createdAt) . '</small>';
      echo '</div>';
      echo '<div class="app-list-item-symbol-wrapper"><span class="app-list-item-symbol">&#12297;</span></div>';
      echo '</li>';
    }
  }
  echo '</ul>';
  ?>
</main>

<button id="button-new-task" onclick="openNewTaskWindow()" type="button" name="newTask">+</button>

<?php else: ?>
  <p>Unauthorized</p>
<?php endif; ?>

<?php include_once('../partials/foot.inc'); ?>
