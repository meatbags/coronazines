<?php
include_once('inc/module-zine-handler.php');
$ref = $_GET['z'] ?? NULL;
$zine = $ref !== NULL ? ZineHandler::getZine($ref) : NULL;
include('part-header.php')
?>

<div class='wrapper'>
  <div class='wrapper__inner'>
    <div id='zine-target' class='viewer'></div>
  </div>
</div>

<?php if ($zine):
  $clean = ZineHandler::sanitise($zine); ?>
  <div id='zine-data-target' style='display:none'><?php
    echo json_encode($clean);
  ?></div>
<?php endif; ?>

<?php include('part-footer.php'); ?>
