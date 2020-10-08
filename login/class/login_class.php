
<?php
//ログインクラス 
class Login
{   
    private $params;

    public function Validation() {
        $err = [];

        $this->params = filter_input_array(INPUT_POST, [
            'email' => FILTER_VALIDATE_EMAIL,
            'password' => FILTER_DEFAULT,
        ]);

        foreach((array)$this->params as $key => $value) {
            if($value === false) {
                $err[] = $this->checkInput($key);
            }
        }

        if(isset($this->params['email'])) {
            $Emsg = $this->mailCheck($this->params['email']);
            if(isset($Emsg)) {
                $err[] = $Emsg;
            }
        }

        return $err;
    }

    public function getUserInfo() {
        $user = (object)$this->params;
        return $user;
    }

    //値がPOSTされていれば、フィルターを適用し、プロパティに代入。
    private function checkInput($value) {
        $err = "${value}は入力必須です。";
        return $err;
    }

    //メアドの正規表現。誤っていればエラーが返される。
    private function mailCheck($mail) {
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
