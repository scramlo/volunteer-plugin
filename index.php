<?php include('partials/head.inc'); ?>

<div class="flex-center-column">
  <div id="login-box">
    <div class="login-option" id="login-option-admin">
      Admin
    </div>
    <a href="pages/volunteer.php" class="login-option" id="login-option-volunteer">
      Volunteer
    </a>
  </div>
  <div id="login-password-box" data-open="false">
    <form action="login.php" method="POST">
      <input type="password" name="password" placeholder="Enter Password"><br>
      <button type="submit" name="submit">Log In</button>
    </form>
  </div>
</div>

<?php include('partials/foot.inc'); ?>
