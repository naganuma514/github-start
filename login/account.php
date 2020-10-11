<?php

session_start();
$login_user = $_SESSION['login_user'];

require_once './tools/tools.php';

if (!isset($login_user)) {
    header('Location:index.php');
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    unset($_SESSION['login_user']);
    header('Location:index.php');
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title><?php echo $login_user['user_name']; ?>のアカウントページ</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php if ($login_user) : ?>
        <fieldset class="form-frame">
            <legend>Successful</legend>
            <?php foreach ($login_user as $key => $val) : ?>
                <p><?php echo h($key); ?> : <?php echo h($val); ?></p>
            <?php endforeach; ?>
            <form action="" method="post">
                <button type="submit">ログアウト</button>
            </form>
        </fieldset>
    <?php endif; ?>
</body>

</html>
