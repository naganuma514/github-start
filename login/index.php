<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

session_start();


require 'database.php';
require 'login_class.php';

if(isset($login_user)){
    header('Location:account.php');
}

$err = [];
$login = new Login();
if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $err = $login->Validation();
    $user = $login->getUserInfo();

    if (count($err) === 0) {
        // DB接続
        $pdo = connect();

        // SQL、パラメータ定義
        $stmt = $pdo->prepare('SELECT * FROM USER WHERE email = ?');
        
        $params = [];
        $params[] = $user->email;

        $stmt->execute($params);

        $rows = $stmt->fetchAll();

        // パスワード検証
        foreach ($rows as $row) {
            $password_hash = $row['password'];

            // パスワード一致
            if (password_verify($user->password, $password_hash)) {
                session_regenerate_id(true);
                $_SESSION['login_user'] = $row;
                header('Location:account.php');
                return;
            }
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
                <p class="error">・<?php echo h($e); ?></p>
            <?php endforeach; ?>
        <?php endif; ?>

        <form action="" method="post">
            <p>
                <label class="form-frame__label" for="email">メールアドレス</label>
                <input id="email" name="email" type="text" />
            </p>
            <p>
                <label class="form-frame__label" for="password">パスワード</label>
                <input id="password" name="password" type="password" />
            </p>
            <p>
                <button type="submit">ログイン</button>
            </p>
            <p>
                <a href="add_user.php">新規ユーザー登録</a>
            </p>
        </form>
    </fieldset>
</body>

</html>