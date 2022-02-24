<?php
require_once('../classes/UserLogic.php');
require_once('../functions.php');
require_once('../dbconnect.php');
session_start();

$pdo = connect();

$result = UserLogic::checkLogin();

$login_user = $_SESSION['login_user'];
$session_id = $login_user['id'];
$id = $login_user['id'];
// echo $id;


if (!$result) {
  $_SESSION['login_err'] = 'ユーザを登録してログインしてください！';
  header('Location: login_form.php');
  return;
}
    $stmt = $pdo->prepare("SELECT * FROM gs_users WHERE id=:id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $image = $stmt->fetch(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <title>Document</title>
</head>
  <body>
<div class="work-img">
  <h1>作品画像表示</h1>
  <img src="images/<?php echo $image['image']; ?>" max-width="500" height="800">
</div>
<div class="tac">
  <a href="upload.php">アップロード画像を更新する</a>
</div>
  </body>
</html>
