<?php
include_once('module-session.php');
include_once('module-request.php');

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

  public static function isZineOwner($ref) {
    if ($ref === NULL || !Validate::isLoggedIn()) {
      return false;
    }
    $req = new Request();
    $userId = (new Session())->get('user_id');
    $sql = 'SELECT zine_id FROM zine WHERE zine_ref=? AND zine_user_id=?';
    $data = $req->preparedQuery($sql, 'si', array($ref, $userId));
    return count($data) > 0;
  }

  public static function getSessionToken() {
    $sessionToken = (new Session())->get('session_token');
    return $sessionToken;
  }

  public static function sessionToken() {
    $token = $_POST['session_token'] ?? NULL;
    $sessionToken = Validate::getSessionToken();
    return !empty($token) && !empty($sessionToken) && $token === $sessionToken;
  }
}
