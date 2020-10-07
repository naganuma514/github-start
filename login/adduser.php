<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
//セッションスタート
session_start();
//DBとClassの読み込み
require dirname(__FILE__) . '/database.php';
require dirname(__FILE__) . '/add_class.php';

//ログインインスタンス生成
$user1=new Login();
//各ゲッターを変数に代入
$mail = $user1->getMail();
$password = $user1->getPassword();
$password_conf = $user1->getPassword_conf();
$a=$user1->checkInput($mail,'mail','メールアドレス');
$b=$user1->checkInput($password,'password','パスワード');
if(isset($b)) {
    echo $b;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
                <p>
                    <label for="mail">メールアドレス</label>
                    <input id="mail" name="mail" type="text" />
                </p>
                <p>
                    <label for="">パスワード</label>
                    <input id="password" name="password" type="password" />
                </p>
                <p>
                    <label for="">確認用パスワード</label>
                    <input id="password_conf" name="password_conf" type="password" />
                </p>
                <input type ="submit" 送信>
</form>
</body>
</html>