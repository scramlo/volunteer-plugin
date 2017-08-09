var tasksOpen = document.getElementsByClassName('open-task');
var taskWindow = document.getElementById('task-window');
var taskWindowTitle = document.getElementById('task-window-title');
var taskWindowBody = document.getElementById('task-window-body');
var taskWindowClose = document.getElementById('task-window-close');
var taskWindowTaskId = document.getElementById('task-window-task-id');
var mainVolunteerWindow = document.getElementById('main-volunteer-window');

for (var i = 0; i < tasksOpen.length; i++) {
  tasksOpen[i].addEventListener('click', function() {
    taskWindowTitle.innerHTML = this.dataset.title;
    taskWindowBody.innerHTML = this.dataset.description;
    taskWindowTaskId.value = this.dataset.id;
    taskWindow.style.animation = 'slideIn 0.5s forwards';
    mainVolunteerWindow.style.animation = 'slideOut 0.5s forwards';
  });
}

function closeTaskWindow() {
  taskWindow.style.animation = 'slideBackOut 0.5s forwards';
  mainVolunteerWindow.style.animation = 'slideBackIn 0.5s forwards';
}
