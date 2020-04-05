<?php include('part-header.php'); ?>

<div class='wrapper'>
  <div class='wrapper__inner'>
    <div class='login-page'>
      <div class='login-page__pane'>
        <div class='title'>LOG IN</div>
        <br />
        <form action='inc/action-login.php' data-msg='Logging in' method='POST'>
          <div class='row'><label>Username</label><input type='text' name='name'></div>
          <div class='row'><label>Password</label><input type='password' name='password'></div>
          <input type='submit' value='LOG IN'>
        </form>
      </div>
      <div class='login-page__pane'>
        <div class='title'>REGISTER</div>
        <br />
        <form action='inc/action-register.php' data-msg='Request submitted' method='POST'>
          <div class='row'><label>Username</label><input type='text' name='name'></div>
          <div class='row'><label>Password</label><input type='password' name='password'></div>
          <div class='row'><label>Confirm</label><input type='password' name='confirm'></div>
          <input type='submit' value='REGISTER'>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('part-footer.php'); ?>
