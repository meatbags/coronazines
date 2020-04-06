<?php
include('part-header.php');
$ref = $_GET['z'] ?? NULL;
?>

<div class='wrapper'>
  <div class='wrapper__inner'>
    <?php echo $ref; ?>
  </div>
</div>

<?php include('part-footer.php'); ?>
