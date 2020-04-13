<?php include('part-header.php'); ?>

<?php
include_once('inc/define.php');
include_once('inc/module-validate.php');
include_once('inc/module-zine-handler.php');
if (!Validate::isLoggedIn()) {
  header("Location: page-login.php");
  die();
}
$ref = $_GET['z'] ?? NULL;
$zine = $ref !== NULL && Validate::isZineOwner($ref) ? ZineHandler::getZine($ref) : NULL;
?>

<?php if ($zine === NULL): ?>
  <div class='wrapper'>
    <div class='wrapper__inner'>
      <div class='page page--creator'>
        <div id='create-zine-form'>
          <form action='inc/action-save-zine.php' method='POST' data-msg=''>
            <div class='title'>Create Zine</div>
            <div class='row'><label>Zine Title</label><input type='text' name='title'></div>
            <div class='row'><input type='submit' value='Create'</div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php else:
  $clean = ZineHandler::sanitise($zine);
  $url = BASE_URL . 'page-zine.php?z=' . $clean['zine_ref'];
  $password = ZineHandler::getZinePassword($ref);
  ?>
  <div id='zine-prefill-json' style='display:none;'><?php echo json_encode($clean); ?></div>
  <div class='wrapper'>
    <div class='wrapper__inner'>
      <div class='page page--creator'>
        <div id='zine-creator-form' class='page--creator__left'>
          <div id='section-meta' class='section'>
            <div class='section__header'>META<div data-collapse='#section-meta'></div></div>
            <div class='section__body'>
              <div class='row'><label>Title</label><input type='text' name='title' value='<?php echo $clean['zine_title']; ?>'></div>
              <div class='row'><label>Author</label><input type='text' name='author' value='<?php echo $clean['zine_author']; ?>'></div>
              <input type='text' name='ref' hidden value='<?php echo $clean['zine_ref']; ?>'>
            </div>
          </div>
          <div id='section-content' class='section'>
            <div class='section__header'>CONTENT<div data-collapse='#section-content'></div></div>
            <div class='section__body'>
              <div class='title'>Pages</div>
              <div class='row'><div id='button-add-page' class='button'>ADD PAGE</div></div>
              <div id='zine-page-list' class='page-list'></div>
            </div>
          </div>
          <div id='section-sharing' class='section'>
            <div class='section__header'>SHARING<div data-collapse='#section-sharing'></div></div>
            <div class='section__body'>
              <div class='row'>
                <label>Make Private</label>
                <div class='checkbox'><input type='checkbox' name='private' <?php echo $clean['zine_private'] ? 'checked' : '' ?>></div>
              </div>
              <div class='row'>
                <label>Require Passphrase</label>
                <div class='checkbox'><input type='checkbox' name='protected' <?php echo $clean['zine_protected'] ? 'checked' : '' ?>></div>
              </div>
              <div class='row'>
                <label>Passphrase</label>
                <input type='text' name='password' value='<?php echo $password; ?>'>
              </div>
              <br />
              <div class='row'><div id='button-copy-url-target'><?php echo $url; ?></div></div>
              <div class='row'><a href='<?php echo $url; ?>' target='_blank'>PREVIEW</a></div>
              <div class='row'>
                <div id='button-copy-url' class='button' data-clipboard-target="#button-copy-url-target">COPY LINK</div>
                <span id='button-copy-msg'></span>
              </div>
            </div>
          </div>
          <div id='section-save' class='section'>
            <div class='section__header'>SAVE & PUBLISH<div data-collapse='#section-save'></div></div>
            <div class='section__body'>
              <div class='row'>
                <label>Draft</label>
                <div class='checkbox'><input type='checkbox' name='draft' <?php echo $clean['zine_published'] ? '' : 'checked' ?>></div>
              </div>
              <div class='row'>
                <div id='button-save-zine' class='button'>SAVE</div>
                <div id='button-publish-zine' class='button'>SAVE & PUBLISH</div>
              </div>
            </div>
          </div>
        </div>
        <div class='page--creator__right'>
          <div id='zine-viewer' class='viewer'></div>
        </div>
      </div>
    </div>
  </div>
  <?php include('part-loading-screen.php'); ?>
<?php endif; ?>

<?php include('part-footer.php'); ?>
