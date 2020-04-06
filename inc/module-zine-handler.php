<?php
include_once('module-request.php');
include_once('module-utils.php');

class ZineHandler {
  public static function listPublicZines() {
    $req = new Request();
    $sql = 'SELECT * FROM zine WHERE (zine_private IS NULL OR zine_private != 1) AND (zine_deleted IS NULL OR zine_deleted != 1)';
    $data = $req->query($sql);
    return $data;
  }

  public static function getZine($ref) {
    $req = new Request();
    $sql = 'SELECT * FROM zine WHERE zine_ref=?';
    $data = $req->preparedQuery($sql, 's', $ref);
    if (count($data) > 0) {
      return $data[0];
    }
    return NULL;
  }

  public static function sanitise($zine) {
    return array(
      'zine_ref' => htmlspecialchars($zine['zine_ref']),
      'zine_title' => htmlspecialchars($zine['zine_title']),
      'zine_author' => htmlspecialchars($zine['zine_author']),
      'zine_description' => htmlspecialchars($zine['zine_description']),
      'zine_content' => filter_var($zine['zine_content'], FILTER_SANITIZE_URL),
    );
  }

  public static function saveZine($params) {
    $title = $params['title'];
    $content = $params['content'];
    $ref = $params['ref'];
    $timestamp = time();
    $exists = ZineHandler::getZine($ref) !== NULL;
  }

  public static function getUniqueRef() {
    $ref = Utils::getToken();
    while (ZineHandler::isUniqueRef($ref) === false) {
      $ref = Utils::getToken();
    }
    return $ref;
  }

  public static function isUniqueRef($ref) {
    $req = new Request();
    $sql = 'SELECT COUNT(*) as total FROM zine WHERE zine_ref=?';
    $res = $req->preparedQuery($sql, 's', $ref);
    $total = intval($res[0]['total']);
    return $total === 0;
  }
}
