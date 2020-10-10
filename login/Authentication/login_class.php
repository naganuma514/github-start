<?php
//ログインクラス 
class Login
{
    private $params;

    public function validation()
    {
        $err = [];

        $this->params = filter_input_array(INPUT_POST, [
            'email' => FILTER_DEFAULT,
            'password' => FILTER_DEFAULT,
        ]);

        foreach ((array)$this->params as $key => $value) {
            if ($value === '') {
                $err[] = $this->check_input($key);
            }
        }

        if ($this->params['email'] !== '' && $this->mail_check($this->params['email'])) {
            $err[] = "メールアドレスの入力に誤りがあります";
        }

        return $err;
    }

    public function get_user_info()
    {
        $user = (object)$this->params;
        return $user;
    }

    //値がPOSTされていれば、フィルターを適用し、プロパティに代入。
    private function check_input($value)
    {
        $err = "${value}は入力必須です。";
        return $err;
    }

    //メアドの正規表現。誤っていればtrueが返される。
    private function mail_check($mail)
    {
        $reg_str = "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
        if (preg_match($reg_str, $mail)) {
            return  false;
        } else {
            return true;
        }
    }
}
