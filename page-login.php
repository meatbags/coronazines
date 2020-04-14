<?php include('part-header.php'); ?>

<div class='page'>
  <div class='login'>
    <div class='login__pane'>
      <div class='title'>LOG IN</div>
      <br />
      <form action='inc/action-login.php' data-msg='Logging in' method='POST'>
        <div class='row'><label>Username</label><input type='text' name='name'></div>
        <div class='row'><label>Password</label><input type='password' name='password'></div>
        <input type='submit' value='LOG IN'>
        <div class='row'><a href='page-register.php'>Register</a></div>
      </form>
    </div>
  </div>
</div>

<?php include('part-footer.php'); ?>
