<?php include('header.php'); ?>

<div class='wrapper'>
  <div class='wrapper__inner'>
    <div class='login-page'>
      <form action='inc/action-login.php' method='POST'>
        <div class='row'>
          <label>Username</label>
          <input type='text' name='username'/>
        </div>
        <div class='row'>
          <label>Password</label>
          <input type='password' name='password'/>
        </div>
        <div class='row'>
          <input type='submit' value='Submit'/>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>
