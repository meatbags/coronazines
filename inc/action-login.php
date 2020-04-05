<?php
include_once('module-message.php');
include_once('module-user-handler.php');
include_once('module-session.php');
include_once('module-validate.php');
include_once('module-utils.php');
include_once('module-logger.php');

// check input
$name = $_POST['name'] ?? NULL;
$password = $_POST['password'] ?? NULL;
if (!$name || !$password) {
  echo message('ERROR', 'action-login', 'Missing fields');
  die();
}

// login
$user = UserHandler::login($name, $password);
if ($user === NULL) {
  echo message('ERROR', 'action-login', NULL);
  die();
}

// set session
$session = new Session();
$session->set('user_id', $user['user_id']);
$session->set('user_role_id', $user['user_role_id']);
$session->set('session_token', Utils::getSessionToken());

// log
Logger::log('[action-login] user_id=' . $user['user_id'] . ' user_name=' . $user['user_name']);

echo message('SUCCESS', 'action-login', NULL);
