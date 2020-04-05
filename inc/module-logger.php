<?php
class Logger {
  private static $logRoot = 'tmp/';

  public static function log($log) {
    $logfile = Logger::$logRoot . 'log_' . date('j-n-Y') . '.log';
    $timestamp = date('h:i:s');
    file_put_contents($logfile, $timestamp . ' ' . $log . PHP_EOL, FILE_APPEND);
  }
}
