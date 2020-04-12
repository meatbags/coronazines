<?php include('part-header.php'); ?>

<?php
include_once('inc/module-zine-handler.php');
$ref = $_GET['z'] ?? NULL;
$zine = $ref !== NULL ? ZineHandler::getZine($ref) : NULL;
?>

<div class='wrapper'>
  <div class='wrapper__inner'>
    <div id='zine-target' class='viewer'></div>
  </div>
</div>

<?php if ($zine['zine_protected'] === 1): ?>
  <div id='zine-password' class='active'>
    <form action='inc/action-get-zine.php' data-msg='Waiting' method='POST'>
      <div class='title'>PASSWORD REQUIRED</div>
      <div class='row'><label>Password</label><input type='text' name='password'></div>
      <input type='submit' value='SUBMIT'>
    </form>
  </div>
<?php else: ?>
  <?php if ($zine):
    $clean = ZineHandler::sanitise($zine); ?>
    <div id='zine-data-target' style='display:none'><?php
      echo json_encode($clean);
    ?></div>
  <?php endif; ?>
<?php endif; ?>

<?php include('part-loading-screen.php'); ?>
<?php include('part-footer.php'); ?>
