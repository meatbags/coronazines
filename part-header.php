<?php
include_once('inc/module-validate.php');
include_once('inc/module-session.php');
$loggedIn = Validate::isLoggedIn();
$isAdmin = Validate::isAdmin();
$sessionToken = $loggedIn ? (new Session())->get('session_token') : NULL;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>virulent zines</title>
    <meta name="description" content="virulent zines for infectious times">
    <meta name="keywords" content="">
    <meta name="author" content="http://xavierburrow.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta property="og:url" content="">
    <meta property="og:title" content="virulent zines">
    <meta property="og:image" content="">
    <meta property="og:site_name" content="virulent zines">
    <meta property="og:description" content="virulent zines for infectious times">
    <link href="https://fonts.googleapis.com/css?family=Karla|Playfair+Display:600&display=swap" rel="stylesheet">
    <link href='./build/style.min.css' rel='stylesheet'>
    <script type='text/javascript' src='./build/app.min.js'></script>
    <script type="text/javascript">
		  //<![CDATA[
			var SITE_URL = '';
			var APP_ROOT = '';
      //]]>
    </script>
    <link rel="icon" type="image/png" href="./img/favicon-bw.png">
  </head>
<?php if ($loggedIn): ?>
  <body data-session-token='<?php echo $sessionToken; ?>'>
<?php else: ?>
  <body>
<?php endif; ?>
    <?php include('part-loading-screen.php'); ?>
    <div class='nav'>
      <div class='nav__inner'>
        <div class='nav__pane'>
          <div class='nav__item'><a href='index.php'>VIRULENT zines</a></div>
          <?php if ($isAdmin): ?>
            <div class='nav__item'><a href='page-admin.php'>admin</a></div>
          <?php endif; ?>
        </div>
        <div class='nav__pane'>
          <?php if ($loggedIn): ?>
            <div class='nav__item'><a href='index.php'>zines</a></div>
            <div class='nav__item'><a href='page-my-zines.php'>my zines</a></div>
            <div class='nav__item'><a href='page-create-zine.php'>create a zine</a></div>
            <div class='nav__item'><a href='page-about.php'>about</a></div>
            <div class='nav__item'><a href='page-logout.php'>log out</a></div>
          <?php else: ?>
            <div class='nav__item'><a href='index.php'>zines</a></div>
            <div class='nav__item'><a href='page-login.php'>create a zine</a></div>
            <div class='nav__item'><a href='page-login.php'>log in</a></div>
            <div class='nav__item'><a href='page-login.php'>register</a></div>
            <div class='nav__item'><a href='page-about.php'>about</a></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
