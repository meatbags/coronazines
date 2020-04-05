<?php
define('PASSWORD_MIN_LENGTH', 8);

class Password {
  public static function isValidPassword($password, $confirm) {
    return (
      $password === $confirm &&
      strlen($password) >= PASSWORD_MIN_LENGTH
      // (preg_match('/[a-z]/', $password) || preg_match('/[A-Z]/', $password))
      // preg_match('/\d/', $password)
      // preg_match('/[^a-zA-Z\d]/', $password)
    );
  }

  public static function passwordMatch($password, $hash) {
    return password_verify($password, $hash);
  }

  public static function getHash($password) {
    return password_hash($password, PASSWORD_DEFAULT);
  }
}
