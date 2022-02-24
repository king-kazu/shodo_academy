<?php

require_once '../dbconnect.php';

class UserLogic
{
  public static function createUser($userData)
  {
    $result = false;

    $sql = 'INSERT INTO gs_users (name, email, password, image) VALUES (:name, :email, :password, :image)';

    $hashedpass = password_hash($userData['password'], PASSWORD_DEFAULT);

    try {
      $stmt = connect()->prepare($sql);
      $stmt->bindValue(':name', $userData['name'], PDO::PARAM_STR);
      $stmt->bindValue(':email', $userData['email'], PDO::PARAM_STR);
      $stmt->bindValue(':password', $hashedpass, PDO::PARAM_STR);
      $stmt->bindValue(':image', $userData['image'], PDO::PARAM_STR);


      $result = $stmt->execute();
      return $result;
    } catch(\Exception $e) { //バックスラッシュをつけるとすべてのExceptionをcatchする（グローバルなnamespaceを指定）
      echo $e; // エラーを出力
      return $result;
    }
  }

  public static function login($email, $password)
  {
    // 結果
    $result = false;
    // ユーザをemailから検索して取得
    $user = self::getUserByEmail($email);

    if (!$user) {
      $_SESSION['msg'] = 'emailが一致しません。';
      return $result;
    }

    // パスワードの照会
    if (password_verify($password, $user['password'])) {
      //ログイン成功
      session_regenerate_id(true);
      $_SESSION['login_user'] = $user;
      $result = true;
      return $result;
    }

    $_SESSION['msg'] = 'パスワードが一致しません。';
    return $result;
  }

  public static function getUserByEmail($email)
  {
    // SQLの準備
    // SQLの実行
    // SQLの結果を返す
    $sql = 'SELECT * FROM gs_users WHERE email = :email';

    try {
      $stmt = connect()->prepare($sql);
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->execute();
      // SQLの結果を返す
      $user = $stmt->fetch();
      return $user;
    } catch(\Exception $e) {
      return false;
    }
  }

  /**
   * ログインチェック
   */
  public static function checkLogin()
  {
    $result = false;
    
    // セッションにログインユーザが入っていなかったらfalse
    if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
      return $result = true;
    }
    return $result;
  }


  /**
   * ログアウト処理
   */
  public static function logout()
  {
    $_SESSION = array();
    session_destroy();
  }
}