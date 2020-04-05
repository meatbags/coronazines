<?php
include_once('module-message.php');
include_once('module-user-handler.php');

// check input
$name = UserHandler::sanitiseName($_POST['name'] ?? NULL);
$password = $_POST['password'] ?? NULL;
$confirm = $_POST['confirm'] ?? NULL;
if (!$name || !$password || !$confirm) {
  echo message('ERROR', 'action-register', 'Missing fields');
  die();
}

// check name
if (!UserHandler::isValidName($name)) {
  echo message('ERROR', 'action-register', 'Invalid name');
  die();
}

// check password
if (!Password::isValidPassword($password, $confirm)) {
  echo message('ERROR', 'action-register', 'Invalid password');
  die();
}

// create user
UserHandler::createUser($name, $password);
echo message('SUCCESS', 'action-register', NULL);
