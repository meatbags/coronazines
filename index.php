<?php include_once('inc/module-zine-handler.php'); ?>
<?php $zines = ZineHandler::listPublicZines(); ?>
<?php include('part-header.php'); ?>

<div class='wrapper'>
  <div class='wrapper__inner'>
    <div class='zine-list'>
      <?php foreach ($zines as $zine):
        // first page
        $ref = strip_tags($zine['zine_ref']);
        $title = htmlspecialchars($zine['zine_title']);
        $pages = explode(';', $zine['zine_content']);
        $p1 = strip_tags($pages[0]);
        $p2 = count($pages) > 0 ? strip_tags($pages[1]) : NULL;
        ?>
        <div class='item'>
          <div class='item__inner'>
            <a href='page-zine.php?z=<?php echo $ref; ?>'>
              <div class='item__background'>
                <?php echo !empty($p1) ? "<img src='" . $p1 . "'>" : "<div class='placeholder'></div>"; ?>
                <?php echo !empty($p2) ? "<img src='" . $p2 . "'>" : "<div class='placeholder'></div>"; ?>
              </div>
              <div class='item__title'>
                <div class='text'>
                  <?php echo $title; ?>
                  <div class='underline'></div>
                </div>
              </div>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<?php include('part-footer.php'); ?>
