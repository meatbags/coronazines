<?php
include_once('module-zine-handler.php');

class Render {
  public static function zineListItem($zine, $editable=NULL) {
    $clean = ZineHandler::sanitise($zine);
    $pages = explode(';', $clean['zine_content']);
    $p1 = $pages[0];
    ?>
      <div class='item'>
        <div class='item__inner'>
          <a href='page-zine.php?z=<?php echo $clean['zine_ref']; ?>'>
            <div class='item__background'>
              <?php echo !empty($p1) ? "<img src='" . $p1 . "'>" : "<div class='placeholder'></div>"; ?>
              <div class='placeholder'></div>
            </div>
            <div class='item__title'>
              <div class='text'>
                <?php echo $clean['zine_title']; ?>
                <?php if ($editable): ?>
                  <a href='page-edit-zine.php?z=<?php echo $clean['zine_ref']; ?>'>[edit]</a>
                <?php endif; ?>
                <div class='underline'></div>
              </div>
            </div>
          </a>
        </div>
      </div>
    <?php
  }
}
