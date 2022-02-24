<?php
session_start();

require_once '../functions.php';
require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if($result) {
  header('Location: mypage.php');
  return;
}

$login_err = isset($_SESSION['login_err']) ? $_SESSION['login_err'] : null;
unset($_SESSION['login_err']);
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
  <h2 class="mt-30">書道アカデミー　入会フォーム</h2>
  <?php if (isset($login_err)) : ?>
    <p><?php echo $login_err; ?></p>
    <?php endif; ?>
    <div>
      <form action="register.php" method="POST" class="center-block">
      <div class="mb-3">
        <label for="name" class="form-label">ユーザ名</label>
        <input type="text" name="name" class="form-control input_width" placeholder="山田　太郎">
      </div>
      
      <div class="mb-3">
        <label for="email" class="form-label">メールアドレス</label>
        <input type="email" name="email" class="form-control input_width" placeholder="sample@example.com">
      </div>
      
      <div class="mb-3">
        <label for="password" class="form-label">パスワード</label>
        <input type="password" name="password" class="form-control input_width" placeholder="半角英数字8〜20字">
      </div>
      
      <div class="mb-3">
        <label for="password_conf" class="form-label">パスワード確認</label>
        <input type="password" name="password_conf" class="form-control input_width" placeholder="もう一度同じパスワードを入力してください">
      </div>
      
      <div class="mb20">
        <a href="kiyaku.html" target="_blank">利用規約</a>
      </div>
      
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="chkbox">
        <label class="form-check-label" for="exampleCheck1">規約に同意する</label>
      </div>
      
      <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
      <div class="mb20">
        <input type="submit" class="btn btn-primary" value="新規登録" id="submit">
      </div>
      </form>
</div>
  <a href="login_form.php">ログイン画面へ</a>
<script>
$(function() {
  $(function() {
    $('#submit').attr('disabled', 'disabled');
      $('#chkbox').click(function() {
        if ( $(this).prop('checked') == false ) {
            $('#submit').attr('disabled', 'disabled');
        } else {
          $('#submit').removeAttr('disabled');
        }
    });
  });
});
</script>
</body>

</html>