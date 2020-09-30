<?php 
require_once dirname(__FILE__)."/login_class.php";
?>
<?php
$user = new Login();
$user->setName($_POST['email'],$_POST['pass1'],$_POST['pass2']);
$getEmail=$user->getEmail();
$getPass1=$user->getPassword1();
$getPass2=$user->getPassword2();
$user->emptyId($getEmail,'メールアドレス');
$user->emptyId($getPass1,'パスワード');
$user->emptyId($getPass2,'確認用パスワード');
$user->samePassword($getPass1,$getPass2);
?>