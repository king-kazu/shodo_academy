<?php

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$id = $_POST['id'];

require_once('../classes/UserLogic.php');
require_once('../functions.php');
require_once('../dbconnect.php');

$pdo = connect();

$stmt = $pdo->prepare('UPDATE gs_users SET name=:name, email=:email, password=:password WHERE id=:id;');

// try {
    $hashedpass = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $hashedpass, PDO::PARAM_STR);

    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
    $status = $stmt->execute();

  if($status === false) {
      $error = $stmt->errorInfo();
      exit('SQLError:' . print_r($error, true));
  } else {
    header('Location: mypage.php');
    exit();
  }