<?php include_once('inc/module-validate.php'); ?>
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
    <link href='./build/style.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Karla|Playfair+Display:400,800&display=swap" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <script type='text/javascript' src='./build/app.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
    <script type="text/javascript">
		  //<![CDATA[
  			var SITE_URL = '';
  			var APP_ROOT = '';
      //]]>
    </script>
    <link rel="icon" type="image/png" href="./img/favicon-bw.png">
  </head>
<?php if (Validate::isLoggedIn()): ?>
  <body data-session-token='<?php echo Validate::getSessionToken(); ?>'>
<?php else: ?>
  <body>
<?php endif; ?>
  <?php include('part-nav.php'); ?>
