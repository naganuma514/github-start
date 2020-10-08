
<?php
// レジスタークラス(新規登録)
class Register
{
    private $params;

    public function Validation()
    {
        $err = [];

        $this->params = filter_input_array(INPUT_POST, [
            'user_name' => FILTER_DEFAULT,
            'email' => FILTER_VALIDATE_EMAIL,
            'password' => FILTER_DEFAULT,
            'password_conf' => FILTER_DEFAULT
        ]);

        foreach ((array)$this->params as $key => $value) {
            if ($value === false) {
                $err[] = $this->checkInput($key);
            }
        }
        
        if(isset($this->params['email'])) {
            $Emsg = $this->mailCheck($this->params['email']);
            if(isset($Emsg)) {
                $err[] = $Emsg;
            }
        }

        if(isset($this->params['password']) && isset($this->params['password_conf'])) {
            $Emsg = $this->samePass($this->params['password'], $this->params['password_conf']);
            if(isset($Emsg)) {
                $err[] = $Emsg;
            }
        }


        return $err;
    }

    public function getUserInfo()
    {
        $user = (object)$this->params;
        unset($user->password_conf);
        return $user;
    }

    //値がPOSTされていれば、フィルターを適用し、プロパティに代入。
    private function checkInput($value)
    {
        $err = "${value}は入力必須です。";
        return $err;
    }

    //確認用パスワードは同じ値を求める。
    private function samePass($a, $b)
    {
        if ($a !== $b) {
            $err = 'パスワードが一致しません。';
            return $err;
        }
    }

    //メアドの正規表現。誤っていればエラーが返される。
    private function mailCheck($mail)
    {
        $reg_str = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
        if (!preg_match($reg_str, $mail)) {
            return "メールアドレスの入力に誤りがあります";
        }
    }
}
