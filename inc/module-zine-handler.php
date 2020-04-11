<?php
include_once('module-request.php');
include_once('module-utils.php');
include_once('module-validate.php');
include_once('module-session.php');

class ZineHandler {
  public static function listPublicZines() {
    $req = new Request();
    $sql = 'SELECT * FROM zine WHERE zine_published=1 AND (zine_private IS NULL OR zine_private != 1) AND (zine_deleted IS NULL OR zine_deleted != 1)';
    $data = $req->query($sql);
    return $data;
  }

  public static function listMyZines() {
    $userId = (new Session())->get('user_id');
    if ($userId === NULL) {
      return array();
    }
    $req = new Request();
    $sql = 'SELECT * FROM zine WHERE zine_user_id=?';
    $data = $req->preparedQuery($sql, 'i', $userId);
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

  public static function getZineByPassword($password) {
    $req = new Request();
    $sql = 'SELECT * FROM zine WHERE zine_password=?';
    $data = $req->preparedQuery($sql, 's', $password);
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
      'zine_private' => htmlspecialchars($zine['zine_private']),
      'zine_protected' => htmlspecialchars($zine['zine_protected']),
      'zine_updated_at' => htmlspecialchars($zine['zine_updated_at'])
    );
  }

  public static function getZinePassword($ref) {
    if (!Validate::isZineOwner($ref)) {
      return NULL;
    }
    $req = 'SELECT zine_password FROM zine WHERE zine_ref=?';
    $data = $req->preparedQuery($sql, 's', $ref);
    if (count($data) > 0) {
      return $data[0]['zine_password'];
    }
    return NULL;
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
