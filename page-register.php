<?php include('part-header.php'); ?>

<div class='page'>
  <div class='login'>
    <div class='login__pane'>
      <div class='title'>REGISTER</div>
      <br />
      <form action='inc/action-register.php' data-msg='Request submitted' method='POST'>
        <div class='row'><label>Username</label><input type='text' name='name' pattern='^[A-Za-z0-9_@]{6,32}$' title='Six characters minimum (letters, numbers, underscore, @)'></div>
        <div class='row'><label>Password</label><input type='password' name='password' pattern='.{8,}' title='Eight characters minimum'></div>
        <div class='row'><label>Confirm</label><input type='password' name='confirm'></div>
        <input type='submit' value='REGISTER'>
      </form>
    </div>
  </div>
</div>

<?php include('part-footer.php'); ?>
