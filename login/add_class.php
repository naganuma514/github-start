<?php
//ログインクラス
class Login
{
    //メアド、パスワード、確認パスワードプロパティ
    private $mail;
    private $password;
    private $password_conf;

    public function __construct()
    {
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            $this->mail = filter_input(INPUT_POST, 'mail');
            $this->password = filter_input(INPUT_POST, 'password');
            $this->password_conf = filter_input(INPUT_POST, 'password_conf');
        }
    }
    public function getMail()
    {
        return $this->mail;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getPassword_conf()
    {
        return $this->password_conf;
    }
    //値がPOSTされていれば、フィルターを適用
    public function checkInput($text,$err_text,$value) {
        if ($text === '') {
            $err['$err_text'] = "${value}は入力必須です。";
            echo $err['$err_text'];
            return $err['$err_text'];
        }

    }
}

?>