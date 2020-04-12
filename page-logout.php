<?php include('part-header.php'); ?>
<?php
include_once('inc/module-session.php');
$session = new Session();
$session->logOut(); ?>

<div class='wrapper'>
  <div class='wrapper__inner'>
    <div class='page'>
      You are logged out.
    </div>
  </div>
</div>

<?php include('part-footer.php'); ?>
