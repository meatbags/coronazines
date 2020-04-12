<?php
include_once('module-zine-handler.php');

class Render {
  public static function zineListItem($zine, $editable=NULL) {
    $clean = ZineHandler::sanitise($zine);
    $pages = explode(';', $clean['zine_content']);
    $p1 = $pages[0];
    $link = ($editable ? 'page-edit-zine.php?z=' : 'page-zine.php?z=' ) . $clean['zine_ref'];
    ?>
      <div class='item'>
        <div class='item__inner'>
          <div class='item__background' data-href='<?php echo $link; ?>'>
            <?php echo !empty($p1) ? "<img src='" . $p1 . "'>" : "<div class='placeholder'></div>"; ?>
            <div class='placeholder'></div>
          </div>
          <div class='item__title'>
            <div class='text' data-href='<?php echo $link; ?>'>
              <?php echo $clean['zine_title']; ?>
              <?php if ($editable): ?>&nbsp;[edit]<?php endif; ?>
              <div class='underline'></div>
            </div>
          </div>
        </div>
      </div>
    <?php
  }
}
