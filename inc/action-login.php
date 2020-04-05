<?php
include_once('module-message.php');
include_once('module-user-handler.php');
include_once('module-session.php');

// check input
$name = $_POST['name'] ?? NULL;
$password = $_POST['password'] ?? NULL;
if (!$name || !$password) {
  echo message('ERROR', 'Missing fields');
  die();
}

// login
if (!UserHandler::login($name, $password)) {
  echo message('ERROR', 'Error');
  die();
}

// redirect
echo message('REDIRECT', NULL, 'index.php');
