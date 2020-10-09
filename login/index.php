<?php
// ini_set('display_errors', true);
// error_reporting(E_ALL);

session_start();
$login_user = $_SESSION['login_user'];

require './tools/tools.php';
require './database/database.php';
require './Authentication/login_class.php';

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
        $database = new DatabBase();

        // SQL、パラメータ定義
        $sql_sentence = 'SELECT * FROM USER WHERE email = ?';
        $params = [0 => $user->email];

        $row = $database->queryfetch($sql_sentence, $params);

        if (count($row) !== 0 && password_verify($user->password, $row['password'])) {
            session_regenerate_id(true);
            header('Location:account.php');
            if(!isset($login_user)) {
                $_SESSION['login_user'] = $row;
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
                <a href="register.php">新規ユーザー登録</a>
            </p>
        </form>
    </fieldset>
</body>

</html>
