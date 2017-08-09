var newTaskWindow = document.getElementById("new-task-window");
var buttonNewTask = document.getElementById("button-new-task");
var tasksOpen = document.getElementsByClassName('open-task');
var tasksPending = document.getElementsByClassName('pending-task');
var taskWindow = document.getElementById('task-window');
var taskWindowTitle = document.getElementById('task-window-title');
var taskWindowBody = document.getElementById('task-window-body');
var taskWindowClose = document.getElementById('task-window-close');
var taskWindowTaskId = document.getElementById('task-window-task-id');
var pendingTaskWindow = document.getElementById('pending-task-window');
var pendingTaskWindowTitle = document.getElementById('pending-task-window-title');
var pendingTaskWindowBody = document.getElementById('pending-task-window-body');
var pendingTaskWindowVolunteer = document.getElementById('pending-task-window-volunteer');
var pendingTaskWindowContact = document.getElementById('pending-task-window-contact');
var pendingTaskWindowClose = document.getElementById('pending-task-window-close');
var pendingTaskWindowTaskId = document.getElementById('pending-task-window-task-id');
var mainAdminWindow = document.getElementById('main-admin-window');

function openNewTaskWindow() {
  newTaskWindow.style.animation = 'slideIn 0.5s forwards';
  buttonNewTask.style.animation = 'slideOut 0.5s forwards';
  mainAdminWindow.style.animation = 'slideOut 0.5s forwards';
}

function closeNewTaskWindow() {
  newTaskWindow.style.animation = 'slideBackOut 0.5s forwards';
  mainAdminWindow.style.animation = 'slideBackIn 0.5s forwards';
  buttonNewTask.style.animation = 'slideBackIn 0.5s forwards';
}

for (var i = 0; i < tasksOpen.length; i++) {
  tasksOpen[i].addEventListener('click', function() {
    taskWindowTitle.innerHTML = this.dataset.title;
    taskWindowBody.innerHTML = this.dataset.description;
    taskWindowTaskId.value = this.dataset.id;
    taskWindow.style.animation = 'slideIn 0.5s forwards';
    mainAdminWindow.style.animation = 'slideOut 0.5s forwards';
    buttonNewTask.style.animation = 'slideOut 0.5s forwards';
  });
}

function closeTaskWindow() {
  taskWindow.style.animation = 'slideBackOut 0.5s forwards';
  mainAdminWindow.style.animation = 'slideBackIn 0.5s forwards';
  buttonNewTask.style.animation = 'slideBackIn 0.5s forwards';
}

for (var i = 0; i < tasksPending.length; i++) {
  tasksPending[i].addEventListener('click', function() {
    pendingTaskWindowTitle.innerHTML = this.dataset.title;
    pendingTaskWindowBody.innerHTML = this.dataset.description;
    pendingTaskWindowVolunteer.innerHTML = this.dataset.volunteer;
    pendingTaskWindowContact.innerHTML = this.dataset.contact;
    pendingTaskWindowTaskId.value = this.dataset.id;
    pendingTaskWindow.style.animation = 'slideIn 0.5s forwards';
    mainAdminWindow.style.animation = 'slideOut 0.5s forwards';
    buttonNewTask.style.animation = 'slideOut 0.5s forwards';
  });
}

function closePendingTaskWindow() {
  pendingTaskWindow.style.animation = 'slideBackOut 0.5s forwards';
  mainAdminWindow.style.animation = 'slideBackIn 0.5s forwards';
  buttonNewTask.style.animation = 'slideBackIn 0.5s forwards';
}
