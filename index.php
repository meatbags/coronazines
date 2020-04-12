<?php include('part-header.php'); ?>
<?php include_once('inc/module-zine-handler.php'); ?>
<?php include_once('inc/module-render.php'); ?>
<?php $zines = ZineHandler::listPublicZines(); ?>

<div class='wrapper'>
  <div class='wrapper__inner'>
    <div class='zine-list'>
      <?php foreach ($zines as $zine) {
        Render::zineListItem($zine);
      } ?>
    </div>
  </div>
</div>

<?php include('part-loading-screen.php'); ?>
<?php include('part-footer.php'); ?>
