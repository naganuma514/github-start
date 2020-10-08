<?php

session_start();
$login_user = $_SESSION['login_user'];

require './tools/database.php';

if (!isset($login_user)) {
    header('Location:index.php');
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    unset($_SESSION['login_user']);
    header('Location:index.php');
    exit;
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
        <?php foreach ($login_user as $key => $val) : ?>
            <p><?php echo h($key); ?> : <?php echo h($val); ?></p>
        <?php endforeach; ?>
        <form action="" method="post">
            <input type="submit" name="logout" value="ログアウト">
        </form>
    <?php endif; ?>
</body>

</html>
