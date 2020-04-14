<?php
include_once('inc/module-validate.php');
include_once('inc/module-zine-handler.php');
$loggedIn = Validate::isLoggedIn();
$isAdmin = Validate::isAdmin();
$page = basename($_SERVER['PHP_SELF']);
$ref = $_GET['z'] ?? NULL;
?>

<!-- NAV -->
<div class='nav mobile-hide'>
  <div class='nav__inner'>
    <?php if ($page !== 'page-zine.php'): ?>
      <div class='nav__pane'>
        <div class='nav__item' style='font-weight:bold'><a href='index.php'>VIRULENT ZINES</a></div>
        <?php if ($isAdmin): ?>
          <div class='nav__item'><a href='page-admin.php'>admin</a></div>
        <?php endif; ?>
      </div>
      <div class='nav__pane'>
        <?php if ($loggedIn): ?>
          <div class='nav__item'><a href='index.php'>zines</a></div>
          <div class='nav__item'><a href='page-my-zines.php'>my zines</a></div>
          <div class='nav__item'><a href='page-edit-zine.php'>create a zine</a></div>
          <div class='nav__item'><a href='page-logout.php'>log out</a></div>
          <div class='nav__item'><a href='page-zine.php?z=about'>about</a></div>
        <?php else: ?>
          <div class='nav__item'><a href='index.php'>zines</a></div>
          <div class='nav__item'><a href='page-login.php'>create a zine</a></div>
          <div class='nav__item'><a href='page-login.php'>log in</a></div>
          <div class='nav__item'><a href='page-register.php'>register</a></div>
          <div class='nav__item'><a href='page-zine.php?z=about'>about</a></div>
        <?php endif; ?>
      </div>
    <?php else:
      $zine = $ref !== NULL ? ZineHandler::getZine($ref) : NULL;
      $title = $zine !== NULL ? htmlspecialchars($zine['zine_title']) : '';
      $author = $zine !== NULL ? htmlspecialchars($zine['zine_author']) : '';
      ?>
      <div class='nav__pane'><div class='nav__item'><a href='index.php'>&larr;&nbsp;home</a></div></div>
      <div class='nav__pane'>
        <div class='nav__item'>
          <a href='index.php'>
            <!-- Virulent Zines&nbsp;|&nbsp; -->
            <?php echo (empty($title) ? 'Untitled' : $title) . (empty($author) ? '' : '&nbsp;by&nbsp;' . $author); ?>
          </a>
        </div>
      </div>
      <div class='nav__pane'></div>
    <?php endif; ?>
  </div>
</div>

<!-- MOBILE MENU -->
<div id='mobile-menu' class='mobile-menu mobile-show'>
  <div class='mobile-menu__inner'>
    <?php if ($loggedIn): ?>
      <div class='item'><a href='index.php'>zines</a></div>
      <div class='item'><a href='page-my-zines.php'>my zines</a></div>
      <div class='item'><a href='page-edit-zine.php'>create a zine</a></div>
      <div class='item'><a href='page-about.php'>about</a></div>
      <div class='item'><a href='page-logout.php'>log out</a></div>
    <?php else: ?>
      <div class='item'><a href='index.php'>zines</a></div>
      <div class='item'><a href='page-login.php'>create a zine</a></div>
      <div class='item'><a href='page-login.php'>log in</a></div>
      <div class='item'><a href='page-about.php'>about</a></div>
    <?php endif; ?>
  </div>
</div>
<div id='mobile-menu-button' class='mobile-menu-button mobile-show'>
  <div class='mobile-menu-button__inner'>
    <div></div><div></div><div></div>
  </div>
</div>
