<?php
require_once 'env.php'; //最初にenv.phpを呼び出す

function connect()
{
    $host = db_host;
    $db = db_name;
    $user = db_user;
    $pass = db_pass;

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
    
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
        // $pdo = new PDO('mysql:dbname=gs_user;charset=utf8;host=localhost', 'root', 'root');
    } catch(PDOException $e) {
        echo '接続失敗です'. $e->getMessage();
        exit();
    }
}

