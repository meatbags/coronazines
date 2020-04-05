<?php include_once('inc/module-validate.php'); ?>
<?php $loggedIn = Validate::loggedIn(); ?>
<?php //$name = basename($_SERVER['PHP_SELF']); ?>

<div class='nav'>
  <div class='nav__inner'>
    <div class='nav__pane'>
      <div data-view='#view-home' class='nav__item'>virulent zines</div>
    </div>
    <div class='nav__pane'>
      <div data-view='#view-home' class='nav__item'>zines</div>
      <?php if ($loggedIn): ?>
        <div data-view="#view-my-zines" class='nav__item'>my zines</div>
        <div data-view='#view-create' class='nav__item'>create a zine</div>
        <div data-view="#view-logout" class='nav__item'>log out</div>
      <?php else: ?>
        <div data-view='#view-login' class='nav__item'>create a zine</div>
        <div data-view='#view-login' class='nav__item'>log in</div>
        <div data-view='#view-login' class='nav__item'>register</div>
      <?php endif; ?>
      <div data-view='#view-about' class='nav__item'>about</div>
    </div>
  </div>
</div>
