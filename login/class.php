<?php

class Login
{
    private $name;
    private $pass1;
    private $pass2;

    public function getName()
    {
        return [
            $this->name,
            $this->pass1,
            $this->pass2,
               ];
    }
    public function setName($name, $pass1, $pass2)
    {
        $this->name=htmlspecialchars($name, ENT_QUOTES, 'utf-8');
        $this->pass1=htmlspecialchars($pass1, ENT_QUOTES, 'utf-8');
        $this->pass2=htmlspecialchars($pass2, ENT_QUOTES, 'utf-8');
    }
}  

$user = new Login();
$user->setName($_POST['name'],$_POST['pass1'],$_POST['pass2']);
$userid[]=$user->getName(); 
foreach($user->getName() as $val){
    echo $val;
  }

?>