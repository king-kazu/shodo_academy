<?php
// session_start();
require_once '../classes/UserLogic.php';
require_once '../functions.php';
require_once '../dbconnect.php';
$pdo = connect();

$id = $_GET["id"];


$stmt = $pdo->prepare('SELECT * FROM gs_users WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status === false) {
  sql_error($status);
} else {
  $result = $stmt->fetch();
}

// $result = UserLogic::checkLogin();
// if($result) {
//   header('Location: mypage.php');
//   return;
// }

// $err = $_SESSION;

// $_SESSION = array();
// session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <title>ユーザ登録画面</title>
</head>

<body>
  <h2>習字アカデミー ユーザ情報変更フォーム</h2>
  <?php if (isset($login_err)) : ?>
    <p><?php echo $login_err; ?></p>
    <?php endif; ?>
    <div>
      <form action="update.php" method="POST" class="center-block">
      <div class="mb-3">
        <label for="name" class="form-label">新しいユーザ名</label>
        <input type="text" name="name" value="<?= $result['name'] ?>"class="form-control input_width" placeholder="山田　太郎">
      </div>
      
      <div class="mb-3">
        <label for="email" class="form-label">新しいメールアドレス</label>
        <input type="email" name="email" value="<?= $result['email'] ?>"class="form-control input_width" placeholder="sample@example.com">
      </div>
      
      <div class="mb-3">
        <label for="password" class="form-label">パスワード</label>
        <input type="password" name="password" value="" class="form-control input_width" placeholder="半角英数字8〜20字">
      </div>
      
      <div class="mb-3">
        <label for="password_conf" class="form-label">パスワード確認</label>
        <input type="password" name="password_conf" value="<?= $result['password_conf'] ?>" class="form-control input_width" placeholder="もう一度同じパスワードを入力してください">
      </div>
      
      <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
      <input type="hidden" name="id" value="<?= $result['id'] ?>">
      <div class="mb20">
        <input type="submit" class="btn btn-primary" value="登録変更" id="submit">
      </div>
      </form>
</div>
  <a href="login_form.php">ログイン画面へ</a>

</body>

</html>