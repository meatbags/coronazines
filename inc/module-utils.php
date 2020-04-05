<?php
class Utils {
  public static function getSessionToken() {
    return bin2hex(openssl_random_pseudo_bytes(64));
  }

  public static function getToken() {
    $token = '';
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $chars_len = strlen($chars);
    $n = 8;
    for ($i=0; $i<$n; ++$i) {
      $token .= $chars[rand(0, $chars_len - 1)];
    }
    return $token;
  }
}
