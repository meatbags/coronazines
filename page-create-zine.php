<?php
include_once('inc/module-validate.php');
include_once('inc/module-zine-handler.php');
if (!Validate::isLoggedIn()) {
  header("Location: page-login.php");
  die();
}
$ref = $_GET['z'] ?? NULL;
$zine = $ref !== NULL && Validate::isZineOwner($ref) ? ZineHandler::getZine($ref) : NULL;
include('part-header.php'); ?>

<?php if ($zine):
  $clean = ZineHandler::sanitise($zine); ?>
  <div id='zine-prefill-target' style='display:none'><?php
    echo json_encode($clean);
  ?></div>
<?php endif; ?>

<div class='wrapper'>
  <div class='wrapper__inner'>
    <div class='page page--creator'>
      <div class='page--creator__left'>
        <div id='section-meta' class='section'>
          <div class='section__header'>META<div data-collapse='#section-meta'></div></div>
          <div class='section__body'>
            <div class='row'><label>Title</label><input type='text' name='title'></div>
            <div class='row'><label>Author</label><input type='text' name='author'></div>
            <div class='row'><label>Short Description</label><textarea rows='2' maxlength='200' name='description'></textarea></div>
          </div>
        </div>
        <div id='section-content' class='section'>
          <div class='section__header'>CONTENT<div data-collapse='#section-content'></div></div>
          <div class='section__body'>
            <div class='title'>Pages</div>
            <div class='page-list'></div>
          </div>
        </div>
        <div id='section-settings' class='section'>
          <div class='section__header'>SETTINGS<div data-collapse='#section-settings'></div></div>
          <div class='section__body'>
            <div class='row'><label>Make Public</small></label><div class='checkbox'><input type='checkbox' name='is_public' checked></div></div>
            <div class='row'><label>Require Passphrase</label><div class='checkbox'><input type='checkbox' name='is_password_protected'></div></div>
            <div class='row'><label>Passphrase</label><input type='text' name='password'></div>
          </div>
        </div>
        <div id='section-sharing' class='section'>
          <div class='section__header'>SETTINGS<div data-collapse='#section-sharing'></div></div>
          <div class='section__body'>
            generated URL here
          </div>
        </div>
      </div>
      <div class='page--creator__right'>
        <div id='zine-workspace-viewer' class='viewer'></div>
      </div>
    </div>
  </div>
</div>

<?php include('part-footer.php'); ?>
