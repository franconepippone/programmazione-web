<?php
require __DIR__ . '/../../vendor/autoload.php';

class VUser{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showLoginForm() {
        $this->smarty->display("user/login.tpl");
    }

    public function showRegistrationForm() {
        $this->smarty->display("user/register.tpl");
    }

    public function showHomePage(string $username) {
        $this->smarty->assign('username', $username);
        $this->smarty->display('user/home.tpl');
    }

}