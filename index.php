<?php include_once('inc/module-zine-handler.php'); ?>
<?php $zines = ZineHandler::listZines(); ?>
<?php include('header.php'); ?>
<?php include('nav.php'); ?>

<div class='loading-screen'></div>

<div class='wrapper'>
  <div class='wrapper__inner'>
    <!-- HOME -->
    <div id='view-home' class='view'>
      <div class='zine-list'>
        <?php foreach ($zines as $zine):
          // first page
          $ref = strip_tags($zine['zine_ref']);
          $title = htmlspecialchars($zine['zine_title']);
          $pages = explode(';', $zine['zine_content']);
          $p1 = strip_tags($pages[0]);
          $p2 = count($pages) > 0 ? strip_tags($pages[1]) : NULL;
          ?>
          <div class='item' data-zine='<?php echo $ref; ?>'>
            <div class='item__inner'>
              <div class='item__background'>
                <?php echo !empty($p1) ? "<img src='" . $p1 . "'>" : "<div class='placeholder'></div>"; ?>
                <?php echo !empty($p2) ? "<img src='" . $p2 . "'>" : "<div class='placeholder'></div>"; ?>
              </div>
              <div class='item__title'><?php echo $title; ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- VIEWER -->
    <div id='view-viewer' class='view'>
      <div id='zine-target' class='viewer'></div>
    </div>

    <!-- ZINE CREATOR -->
    <div id='view-create' class='view active'>
      <div class='view__side-bar'>
        <div class=''></div>
        <div class='pages'>
          ......!
        </div>
        <div class=''></div>
      </div>
      <div class='view__workspace'>
        <div class='viewer'></div>
      </div>
    </div>

    <!-- ABOUT -->
    <div id='view-about' class='view'>
      {{ ABOUT }}
    </div>
  </div>
</div>

<?php include('footer.php'); ?>
