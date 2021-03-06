<?php
session_start();

require_once '../classes/UserLogic.php';

// エラーメッセージ
$err = [];

$token = filter_input(INPUT_POST, 'csrf_token');
//トークンがない、もしくは一致しない場合、処理を中止
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
  echo "LOGIN ERROR!";
  exit();
} else{
  session_regenerate_id();
  session_id();
}

unset($_SESSION['csrf_token']);

// バリデーション
if(!$username = filter_input(INPUT_POST, 'name')) {
  $err[] = 'ユーザ名を記入してください。';
}
if(!$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
  $err[] = 'メールアドレスを正しく記入してください。';
}
$password = filter_input(INPUT_POST, 'password');
// 正規表現 
if (!preg_match("/\A[a-z\d]{8,20}+\z/i",$password)) {
  $err[] = 'パスワードは英数字8文字以上20文字以下にしてください。';
}
$password_conf = filter_input(INPUT_POST, 'password_conf');
if ($password !== $password_conf) {
  $err[] = '確認用パスワードと異なっています。';
}

if (count($err) === 0) {
  // ユーザを登録する処理
  $hasCreated = UserLogic::createUser($_POST);
  
  if(!$hasCreated) {
    $err[] = '登録に失敗しました';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <title>ユーザ登録完了画面</title>
</head>
<body>
<?php if (count($err) > 0) : ?>
  <?php foreach($err as $e) : ?>
    <p><?php echo $e ?></p>
  <?php endforeach ?>
<?php else : ?>
  <p>ユーザ登録が完了しました!</p>
<?php endif ?>
<a href="login_form.php">ログイン画面へ</a>
<a href="signup_form.php" class="ml30">戻る</a>
  
</body>
</html>