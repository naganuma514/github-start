<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

//セッションスタート。
session_start();

//DBとClassの読み込み。
require dirname(__FILE__) . '/database.php';
require dirname(__FILE__) . '/add_class.php';

$err=[]; //エラーメッセージ格納配列。

//ログインインスタンス生成。
$user1=new Login();
$user1->firstLogin(); //新規登録用メソッド。

//各ゲッターを変数に代入。
$mail = $user1->getMail();
$password = $user1->getPassword();
$password_conf = $user1->getPassword_conf();

//メアド、パスワードの入力チェック。未入力ならそれぞれエラーが代入される。
$err[0] = $user1->checkInput($mail,'mail','メールアドレス');
$err[1] = $user1->checkInput($password,'password','パスワード');

//確認用パスワードが一致しているか調べ、異なればエラーが変数に代入される。
$err[2] = $user1->samePass($password,$password_conf);

//メアドの正規表現。誤っていればエラーが返される。
$err[3] = $user1->mailCheck($mail);

//エラーが飛ばされていれば、それを配列から取り出して表示。
$user1->errCheck($err);
    

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