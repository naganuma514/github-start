<?php

    ini_set('display_errors', true);
    error_reporting(E_ALL);

    //セッションスタート。
    session_start();

    //DBとClassの読み込み。
    require 'database.php';
    require './class/login_class.php';

    //ログインインスタンス生成。
    $login = new Login();
    $err = $login->Validation();
    $user = $login->getUserInfo();

    if (count($err) === 0) {
        // DB接続
        $pdo = connect();

        // ステートメント
        $stmt = $pdo->prepare('INSERT INTO `USER` (`id`, `user_name`, `email`, `password`) VALUES (null, ?, ?, ?)');

        // パラメータ設定
        $params = [];
        $params[] = $user->user_name;
        $params[] = $user->email;
        $params[] = password_hash($user->password, PASSWORD_DEFAULT);

        // SQL実行
        $success = $stmt->execute($params);
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
    <?php if (count($err) > 0) : ?>
        <?php foreach ($err as $e) : ?>
            <p class="error"><?php echo h($e); ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (isset($success) && $success) : ?>
        <p>登録に成功しました。</p>
        <p><a href="index.php">こちらからログインしてください。</a></p>
    <?php else : ?>
        <fieldset class="form-frame">
            <legend>新規アカウント登録フォーム</legend>
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
