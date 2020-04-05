<?php
include_once('module-zine-handler.php');
include_once('module-message.php');

// get zine
$ref = $_POST['ref'] ?? NULL;
if ($ref === NULL) {
  echo message('ERROR', 'action-get-zine', NULL);
  die();
}

// get zine data
$data = ZineHandler::getZine($ref);

// convert to JSON
echo message('SUCCESS', 'action-get-zine', $data);
