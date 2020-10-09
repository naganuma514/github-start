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
            'email' => FILTER_DEFAULT,
            'password' => FILTER_DEFAULT,
            'password_conf' => FILTER_DEFAULT
        ]);

        foreach ((array)$this->params as $key => $value) {
            if ($value === '') {
                $err[] = $this->checkInput($key);
            }
        }

        if ($this->params['email'] !== '' && $this->mailCheck($this->params['email'])) {
            $err[] = "メールアドレスの入力に誤りがあります";
        }

        $pass = $this->params['password'];
        $pass_conf = $this->params['password_conf'];

        if ($pass !== $pass_conf) {
            $err[] = 'パスワードが一致しません。';
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

    //メアドの正規表現。誤っていればtrueが返される。
    private function mailCheck($mail)
    {
        $reg_str = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
        if (preg_match($reg_str, $mail)) {
            return  false;
        } else {
            return true;
        }
    }
}