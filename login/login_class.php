<?php
//ログインクラス作成
class Login
{
    private $email;
    private $pass1;
    private $pass2;
//ゲッターとセッターで安全対策まで
    public function getEmail() {
        return $this->email;

    }
    public function getPassword1() {
        return $this->pass1;
    }
    public function getPassword2() {
        return $this->pass2;
    }
    public function setName($email, $pass1, $pass2)
    {
        $this->email=htmlspecialchars($email, ENT_QUOTES, 'utf-8');
        $this->pass1=htmlspecialchars($pass1, ENT_QUOTES, 'utf-8');
        $this->pass2=htmlspecialchars($pass2, ENT_QUOTES, 'utf-8');
    }
    //２つのパスワードが同じか判定
    public function samePassword($a,$b) {
        if($a !== $b) {
            echo "パスワードと確認用パスワードは同じ値を入力してください";
        }
    }
    //入力値が空なのか確かめるメソッド
    public function emptyId($id,$name) {
        if (empty($id)) {
            echo "${name}の入力は必須です。";
        }
    }
}  

?>