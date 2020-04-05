<?php
include_once('module-request.php');
include_once('module-password.php');
include_once('module-logger.php');
include_once('module-session.php');
include_once('module-utils.php');

class UserHandler {
  public static function login($name, $password) {
    $req = new Request();
    $sql = 'SELECT user_id, user_role_id, user_name, user_password FROM user WHERE user_name=? AND (user_deleted IS NULL OR user_deleted != 1)';
    $data = $req->preparedQuery($sql, 's', $name);
    $len = count($data);

    // get user
    $user = NULL;
    for ($i=0; $i<$len; $i++) {
      if (Password::passwordMatch($password, $data[$i]['user_password'])) {
        $user = $data[$i];
        break;
      }
    }

    // set session
    if ($user !== NULL) {
      $session = new Session();
      $session->set('user_id', $user['user_id']);
      $session->set('user_role_id', $user['user_role_id']);
      $session->set('session_token', Utils::getSessionToken());

      // log
      Logger::log('[action-login] user_id=' . $user['user_id'] . ' user_name=' . $user['user_name']);
      return TRUE;
    } else {
      Logger::log('[action-login] FAILED: name=' . $name);
      return FALSE;
    }
  }

  public static function createUser($name, $password) {
    $req = new Request();
    $sql = 'INSERT INTO user (user_name, user_role_id, user_password, user_created_at) VALUES (?, ?, ?, ?)';
    $hash = Password::getHash($password);
    $role = 2;
    $timestamp = time();
    $req->preparedQuery($sql, 'sisi', array($name, $role, $hash, $timestamp));
    return TRUE;
  }

  public static function sanitiseName($name) {
    if ($name === NULL) {
      return NULL;
    }
    $name = preg_replace('/[^0-9a-zA-Z_]/', '', $name);
    return $name;
  }

  public static function isValidName($name) {
    if (empty($name)) {
      return FALSE;
    }
    $req = new Request();
    $sql = 'SELECT COUNT(*) as total FROM user WHERE user_name=?';
    $res = $req->preparedQuery($sql, 's', $name);
    $total = intval($res[0]['total']);
    return $total === 0;
  }
}
