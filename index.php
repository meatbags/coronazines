<?php include_once('inc/module-zine-handler.php'); ?>
<?php $zines = ZineHandler::listZines(); ?>
<?php include('header.php'); ?>
<?php include('nav.php'); ?>

<div class='loading-screen'></div>

<div class='wrapper'>
  <div class='wrapper__inner'>
    <!-- HOME -->
    <div id='view-home' class='view active'>
      <div class='zine-list'>
        <?php foreach ($zines as $zine):
          // first page
          $img = explode(';', $zine['zine_content'])[0];
          ?>
          <div class='item' data-zine='<?php echo $zine['zine_ref']; ?>'>
            <div class='item__inner'>
              <div class='item__background'>
                <?php if (!empty($img)): ?>
                  <img src='<?php echo $img; ?>'>
                <?php else: ?>
                  <div class='placeholder'></div>
                <?php endif; ?>
              </div>
              <div class='item__title'><?php echo $zine['zine_title']; ?></div>
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
    <div id='view-create' class='view'>
      {{ CREATOR HERE }}
    </div>

    <!-- ABOUT -->
    <div id='view-about' class='view'>
      {{ ABOUT }}
    </div>
  </div>
</div>

<?php include('footer.php'); ?>
