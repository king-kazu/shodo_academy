<?php
session_start();
require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if($result) {
  header('Location: mypage.php');
  return;
}

$err = $_SESSION;

$_SESSION = array();
session_destroy();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/style2.css">
  <title>ログイン画面</title>
</head>
<body>
<!-- <img src="../hude.jpg" width=500px hight=400px class="back-ground"> -->
<!-- <img src="../hude.jpg" class="back-ground"> -->

<div class="bg_test">
    <div class="bg_test-text">
    <wrapper>
      <h1>書道アカデミー</h1>
      <h2>ログイン</h2>
          <?php if (isset($err['msg'])) : ?>
              <p><?php echo $err['msg']; ?></p>
          <?php endif; ?>
        <form action="login.php" method="POST">
        <div class="mb-3">
          <label for="email" class="form-label">メールアドレス</label>
          <input type="email" name="email" class="form-control input_width" placeholder="sample@example.com">
          <?php if (isset($err['email'])) : ?>
              <p><?php echo $err['email']; ?></p>
          <?php endif; ?>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">パスワード</label>
          <input type="password" name="password" class="form-control input_width" placeholder="半角英数字8〜20字">
          <?php if (isset($err['password'])) : ?>
              <p><?php echo $err['password']; ?></p>
          <?php endif; ?>
        </div>
        <p>
          <input type="submit" class="btn btn-primary" value="ログイン">
        </p>
        </form>
        <a href="signup_form.php">新規入会はこちら</a>
  </wrapper> 
    </div>
</div>

</body>
</html>