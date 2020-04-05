<?php
include_once('module-logger.php');

class Session {
  function __construct() {
    $this->start();
  }

  function start() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }
  }

  function logOut() {
    $this->destroy();
  }

  function destroy() {
    session_destroy();
  }

  function set($key, $value) {
    $this->start();
    $_SESSION[$key] = $value;
  }

  function get($key) {
    $this->start();
    return $_SESSION[$key] ?? NULL;
  }

  function isUser($id) {
    $this->start();
    return isset($_SESSION['user_id']) && $id !== NULL && (int)$_SESSION['user_id'] === (int)$id;
  }

  function isLoggedIn() {
    $this->start();
    return isset($_SESSION['session_token']) && isset($_SESSION['role']) && $_SESSION['role'] !== 'none';
  }

  function getToken() {
    return $this->isLoggedIn() ? $_SESSION['session_token'] : NULL;
  }

  function validateSessionToken($token=NULL) {
    $token = $token === NULL ? $this->getToken() : $token;
    return $token !== NULL && !empty($token) && $token === $this->getToken();
  }
}
