<?php

// ini_set('display_errors', true);
// error_reporting(E_ALL);

//セッションスタート。
session_start();

require_once './Database/controller_class.php';
require_once './tools/tools.php';
require_once './Authentication/register_class.php';

$err = [];
$register = new Register();
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $err = $register->Validation();
    $user = $register->getUserInfo();

    if (count($err) === 0) {
        // DB接続
        $database = new Controller();

        // SQL、パラメータ定義
        $sql_sentence = 'INSERT INTO `USER` (`id`, `user_name`, `email`, `password`) VALUES (null, ?, ?, ?)';
        $pass_hash = password_hash($user->password, PASSWORD_DEFAULT);
        $params = [0 => $user->user_name, 1 => $user->email, 2 => $pass_hash];

        // SQL実行
        $success = $database->query($sql_sentence,  $params);
    }
}
?>
<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>新規アカウント登録</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php if (isset($success) && $success) : ?>
        <div class="form-frame">
            <p>登録に成功しました。</p>
            <p><a href="index.php">こちらからログインしてください。</a></p>
        </div>
    <?php else : ?>
        <fieldset class="form-frame">
            <legend>新規アカウント登録</legend>
            <?php if (count($err) !== 0) : ?>
                <?php foreach ($err as $e) : ?>
                    <p class="error">・<?php echo h($e); ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
            <form action="" method="post">
                <p>
                    <label class="form-frame__label" for="user_name">ユーザー名</label>
                    <input id="user_name" name="user_name" type="text" />
                </p>
                <p>
                    <label class="form-frame__label" for="email">メールアドレス</label>
                    <input id="email" name="email" type="text" />
                </p>
                <p>
                    <label class="form-frame__label" for="password">パスワード</label>
                    <input id="password" name="password" type="password" />
                </p>
                <p>
                    <label class="form-frame__label" for="password_conf">確認用パスワード</label>
                    <input id="password_conf" name="password_conf" type="password" />
                </p>
                <p>
                    <button type="submit">登録</button>
                </p>
                <p>
                    <a href="index.php">ログイン</a>
                </p>
            </form>
        </fieldset>
    <?php endif; ?>
</body>

</html>
