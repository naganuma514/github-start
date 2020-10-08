<?php

function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
}

function connect()
{
    //！Docker 設定に合わせた接続設定
    $dsn = 'mysql:host=mysql;dbname=login;charset=utf8mb4;'; // Dockerの設定に合わせて変更
    $username = 'root';
    $password = 'password'; // Dockerの設定に合わせて変更

    /* 
        // 元の設定
        $dsn = 'mysql:host=localhost;dbname=login;charset=utf8mb4;';
        $username = 'root';
        $password = '';
    */

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    $pdo = null;

    try {
        $pdo = new PDO($dsn, $username, $password, $options);
    } catch(PDOException $e) {
        echo '<p>'.$e->getMessage().'</p>';
    }

    return $pdo;
}
