<?php
// ini_set('display_errors', true);
// error_reporting(E_ALL);

session_start();
$login_user = $_SESSION['login_user'];

if(isset($login_user)){
    header('Location:main.php');
}

require 'database.php';
require './class/login_class.php';

$err = [];
$login = new Login();
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $err = $login->Validation();
    $user = $login->getUserInfo();

    if (count($err) === 0) {
        // DB接続
        $pdo = connect();

        // ステートメント
        $stmt = $pdo->prepare('SELECT * FROM USER WHERE email = ?');

        // パラメータ設定
        $params = [0 => $user->email];

        // SQL実行
        $success = $stmt->execute($params);

        $row = $stmt->fetch();

        if (password_verify($user->password, $row['password'])) {
            if(!isset($login_user)) {
                session_regenerate_id(true);
                $_SESSION['login_user'] = $row;
                header('Location:main.php');
            }
            return;
        }

        $err['login'] = 'ログインに失敗しました。';
    }
}
?>
<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <fieldset class="form-frame">
        <legend>ログインフォーム</legend>
        <?php if (count($err) !== 0) : ?>
            <?php foreach ($err as $e) : ?>
                <p class="error"><?php echo h($e); ?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <form action="" method="post">
            <p>
                <label class="form-frame__label" for="email">メールアドレス</label>
                <input id="email" name="email" type="email" />
            </p>
            <p>
                <label class="form-frame__label" for="password">パスワード</label>
                <input id="password" name="password" type="password" />
            </p>
            <p>
                <button type="submit">ログイン</button>
            </p>
            <p>
                <a href="adduser.php">新規ユーザー登録</a>
            </p>
        </form>
    </fieldset>
</body>

</html>
