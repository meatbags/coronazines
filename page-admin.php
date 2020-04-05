<?php
include_once('inc/module-validate.php');
if (!Validate::isAdmin()) {
  header("Location: 404.php");
  die();
}
?>
<?php include('part-header.php'); ?>

<div class='wrapper'>
  <div class='wrapper__inner'>
    Admin...
  </div>
</div>

<?php include('part-footer.php'); ?>
