<?php
//ログインクラス 
class Login
{
    //メアド、パスワード、確認パスワードプロパティ。
    private $mail;
    private $password;
    private $password_conf;
    
    //POSTがあったとき値を各プロパティにセット。
    public function firstLogin()
    {
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            $this->mail = filter_input(INPUT_POST, 'mail');
            $this->password = filter_input(INPUT_POST, 'password');
            $this->password_conf = filter_input(INPUT_POST, 'password_conf');
        }
    
        //各ゲッター    
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
    
    //値がPOSTされていれば、フィルターを適用し、プロパティに代入。
    public function checkInput($text,$value) {
        if ($text === '') {
            $err = "${value}は入力必須です。";
            return $err;
        }
    }
   
    //確認用パスワードは同じ値を求める。
    public function samePass($a,$b) {
        if ($a !== $b) {
            $err = 'パスワードが一致しません。';
            return $err;
        } 
        
    } 
   
    //エラー時エラー内容を表示。
    public function errCheck($err) {
        if(isset($err)) {
            foreach($err as $er) {
                echo $er;
            }
        }
    }
    
    //メアドの正規表現。誤っていればエラーが返される。
    public function mailCheck($mail) {
        $reg_str = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
        if (preg_match($reg_str, $mail)) {
    //正規表現がTRUEなら何もしない。
        } else if(empty($mail)) {
    //空欄なら何もしない。
        } else {
            if(isset($mail)) {
                $e = "メールアドレスの入力に誤りがあります";
                return $e;  
            }//ユーザーから入力があり、かつ正規表現から外れた場合にエラー表示。
        }
    }
}

?>