<?php
include_once('module-message.php');
include_once('module-validate.php');
include_once('module-zine-handler.php');

// session
if (!Validata::sessionToken()) {
  echo message('ERROR', 'action-save-zine', NULL);
  die();
}

// params
$params = array(
  'zine_ref' => $_POST['ref'] ?? NULL,
  'zine_title' => $_POST['title'] ?? NULL,
  'zine_author' => $_POST['author'] ?? NULL,
  'zine_password' => $_POST['password'] ?? NULL,
  'zine_content' => '',
);

// TODO: security
// TODO: check user created zine? use IP for public zines? disable editing on page leave?

// validate image urls
$content = $_POST['content'] ?? '';
$maxLength = 512;
$urls = explode(';', $content);

// validate, build delimited string
for ($i=0, $lim=count($urls); $i<$lim; $i++) {
  $input = $urls[$i];
  $url = strlen($input) <= $maxLength && ;
  $params['zine_content'] .= $url . ($i == $lim - 1 ? '' : ';');
}

// save zine
$res = ZineHandler::updateZine($params);
echo message('SUCCESS', 'action-save-zine', $res);
