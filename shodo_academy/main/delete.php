<?php
// 対象のIDを取得
$id = $_GET['id'];

// DB接続します
session_start();
require_once '../classes/UserLogic.php';
require_once '../functions.php';
require_once '../dbconnect.php';
$pdo = connect();

//削除SQLを作成
$stmt = $pdo->prepare('DELETE FROM gs_users WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status === false) {
    sql_error($stmt);
} else {
    header('Location: mypage.php');
  exit();
}