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

    public function showHomePage() {
        $this->smarty->assign('base_url', 'http://yourdomain.com');
        $this->smarty->display('user/home.tpl');
    }

}