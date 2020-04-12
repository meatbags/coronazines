<?php include('part-header.php'); ?>

<?php
include_once('inc/module-validate.php');
if (!Validate::isAdmin()) {
  header("Location: 404.php");
  die();
}
include_once('inc/module-user-handler.php');
$users = UserHandler::listUsers();
?>

<div class='wrapper'>
  <div class='wrapper__inner'>
    <div class='page'>
      <div class='table'>
        <div class='table__header'>
          <div class='row'>
            <div class='cell'>ID</div>
            <div class='cell'>Name</div>
            <div class='cell'>Role</div>
            <div class='cell'>Created At</div>
            <div class='cell'>Deleted</div>
          </div>
        </div>
        <div class='table__body'>
          <?php foreach($users as $u): ?>
            <div class='row'>
              <div class='cell'><?php echo $u['user_id']; ?></div>
              <div class='cell'><?php echo $u['user_name']; ?></div>
              <div class='cell'><?php echo $u['user_role_id']; ?></div>
              <div class='cell'><?php echo $u['user_created_at']; ?></div>
              <div class='cell'><?php echo $u['user_deleted']; ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('part-footer.php'); ?>
