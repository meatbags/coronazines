<?php
include_once('module-message.php');
include_once('module-user-handler.php');

// check input
$name = UserHandler::sanitiseName($_POST['name'] ?? NULL);
$password = $_POST['password'] ?? NULL;
$confirm = $_POST['confirm'] ?? NULL;
if (!$name || !$password || !$confirm) {
  echo message('ERROR', 'Missing fields');
  die();
}

// check name
if (!UserHandler::isValidName($name)) {
  echo message('ERROR', 'Invalid name');
  die();
}

// check password
if (!Password::isValidPassword($password, $confirm)) {
  echo message('ERROR', 'action-register', 'Invalid password');
  die();
}

// create user
if (!UserHandler::createUser($name, $password)) {
  echo message('ERROR', 'Registration failed');
  die();
}

// log in
if (!UserHandler::login($name, $password)) {
  echo message('ERROR', 'Error');
  die();
}

echo message('REDIRECT', NULL, 'index.php');
