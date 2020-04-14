<?php
include_once('module-message.php');
include_once('module-validate.php');
include_once('module-zine-handler.php');

// session
if (!Validate::sessionToken()) {
  echo message('ERROR', 'Invalid session', NULL);
  die();
}

// title must be set
$title = $_POST['title'] ?? NULL;
if (empty($title)) {
  echo message('ERROR', 'Missing title', NULL);
  die();
}

// params
$params = array(
  'zine_ref' => $_POST['ref'] ?? NULL,
  'zine_title' => $title,
  'zine_author' => $_POST['author'] ?? NULL,
  'zine_password' => $_POST['password'] ?? NULL,
  'zine_published' => $_POST['published'] ?? NULL,
  'zine_private' => $_POST['private'] ?? NULL,
  'zine_protected' => $_POST['protected'] ?? NULL,
  'zine_password' => $_POST['password'] ?? NULL,
  'zine_content' => '',
);

// validate image urls
$content = $_POST['content'] ?? '';
$maxLength = 512;
$urls = explode(';', $content);

// validate, build delimited string
for ($i=0, $lim=count($urls); $i<$lim; $i++) {
  $url = $urls[$i];
  if (strlen($url) > $maxLength) {
    echo message('ERROR', 'Image URL too long', NULL);
    die();
  }
  $params['zine_content'] .= $url . ($i == $lim - 1 ? '' : ';');
}

// create zine
if (empty($params['zine_ref'])) {
  $ref = ZineHandler::createZine($title);
  $link = 'page-edit-zine.php?z=' . $ref;
  echo message('REDIRECT', NULL, $link);
} else {
  ZineHandler::saveZine($params);
  echo message('SUCCESS', 'Saved', NULL);
}
