<?php
include('module-message.php');
include('module-session.php');

// log out
$session = new Session();
$session->logOut();

return message('SUCCESS', 'action-logout', NULL);
