<?php
include_once('module-session.php');

class Validate {
  public static function isLoggedIn() {
    $session = new Session();
    $id = $session->get('user_id') ?? NULL;
    return $id !== NULL;
  }

  public static function isAdmin() {
    $session = new Session();
    $role = $session->get('user_role_id') ?? NULL;
    return $role !== NULL && (int)$role === 1;
  }

  public static function sessionToken() {
    $token = $_POST['session_token'] ?? NULL;
    $valid = $token === NULL ? false : (new Session())->validateSessionToken($token);
    return $valid;
  }
}
