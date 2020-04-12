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
<?php else: ?>
  <?php $clean = ZineHandler::sanitise($zine); ?>
  <div id='zine-prefill' style='display:none;'>
    <?php echo json_encode($clean); ?>
  </div>
  <div class='wrapper'>
    <div class='wrapper__inner'>
      <div class='page page--creator'>
        <div class='page--creator__left'>
          <div id='section-meta' class='section'>
            <div class='section__header'>META<div data-collapse='#section-meta'></div></div>
            <div class='section__body'>
              <div class='row'><label>Title</label><input type='text' name='title' value='<?php echo $clean['zine_title']; ?>'></div>
              <div class='row'><label>Author</label><input type='text' name='author' value='<?php echo $clean['zine_author']; ?>'></div>
            </div>
          </div>
          <div id='section-content' class='section'>
            <div class='section__header'>CONTENT<div data-collapse='#section-content'></div></div>
            <div class='section__body'>
              <div class='title'>Pages</div>
              <div class='page-list'></div>
            </div>
          </div>
          <div id='section-sharing' class='section'>
            <div class='section__header'>SHARING<div data-collapse='#section-sharing'></div></div>
            <div class='section__body'>
              <div class='row'><label>Make Public</small></label><div class='checkbox'><input type='checkbox' name='is_public' value='1' checked></div></div>
              <div class='row'><label>Require Passphrase</label><div class='checkbox'><input type='checkbox' name='is_password_protected' value='1'></div></div>
              <div class='row'><label>Passphrase</label><input type='text' name='password'></div>
              <br />
              <div class='row'><div id='button-copy-url-target'><?php echo BASE_URL . $clean['zine_ref']; ?></div></div>
              <div class='row'><div id='button-copy-url' data-clipboard-target="#button-copy-url-target">COPY LINK</div></div>
            </div>
          </div>
        </div>
        <div class='page--creator__right'>
          <div id='zine-workspace-viewer' class='viewer'></div>
        </div>
      </div>
    </div>
  </div>
  <?php include('part-loading-screen.php'); ?>
<?php endif; ?>

<?php include('part-footer.php'); ?>
