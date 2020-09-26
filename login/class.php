<?php

class Login {
    private $name;
    private $pass1;
    private $pass2;

    public function getName() {
        return $this->name;
    }
    public function getPass1() {
        return $this->pass1;
    }
    public function getPass2() {
        return $this->pass2;
    }
    public function setName($name) {
        $this->name=$name;
    }
    public function setPass1($pass1) {
        $this->pass1=$pass1;
    }
    public function setPass2($pass2) {
        $this->pass2=$pass2;
    }
}

$user = new Login();
$user->setName($_POST['name']);
echo $user->getName();
$user->setPass1($_POST['pass1']);
echo $user->getPass1();
$user->setPass2($_POST['pass2']);
echo $user->getpass2();


?>