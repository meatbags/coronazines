<?php
include_once('module-zine-handler.php');
include_once('module-message.php');

// get zine ref or password
$ref = $_POST['ref'] ?? NULL;
$password = $_POST['password'] ?? NULL;
if ($ref === NULL && $password === NULL) {
  echo message('ERROR', 'action-get-zine', NULL);
  die();
}

// get zine data
if ($ref) {
  $zine = ZineHandler::getZine($ref);
  $res = $zine !== NULL
    ? message('SUCCESS', 'action-get-zine', ZineHandler::sanitise($zine))
    : message('ERROR', 'No zine found', NULL);
  echo $res;
} else {
  $zine = ZineHandler::getZineByPassword($password);
  $res = $zine !== NULL
    ? message('SUCCESS', 'action-get-zine', ZineHandler::sanitise($zine))
    : message('ERROR', 'Incorrect password', NULL);
  echo $res;
}
