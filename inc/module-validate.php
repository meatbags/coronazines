<?php
include_once('module-session.php');

class Validate {
  public static function loggedIn() {
    $session = new Session();
    $id = $session->get('user_id') ?? NULL;
    return $id !== NULL;
  }

  public static function sessionToken() {
    $token = $_POST['session_token'] ?? NULL;
    $valid = $token === NULL ? false : (new Session())->validateSessionToken($token);
    return $valid;
  }
}
