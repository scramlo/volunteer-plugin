var loginOptionAdmin = document.getElementById('login-option-admin');
var loginOptionVolunteer = document.getElementById('login-option-volunteer');
var loginPasswordBox = document.getElementById('login-password-box');

loginOptionAdmin.addEventListener('click', function() {
  if (loginPasswordBox.dataset.open === "false") {
    loginPasswordBox.style.display = "block";
    loginPasswordBox.dataset.open = "true";
  } else if (loginPasswordBox.dataset.open === "true") {
    loginPasswordBox.style.display = "none";
    loginPasswordBox.dataset.open = "false";
  }
});
