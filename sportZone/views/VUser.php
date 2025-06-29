<?php
require __DIR__ . '/../../vendor/autoload.php';

class VUser{

    private $smarty;

    public function __construct() {
        $this->smarty = USmarty::getInstance();
    }

    public function showLoginForm(string $redirectUrl) {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign("redirectUrl", $redirectUrl);
        $this->smarty->display("user/login.tpl");
    }

    public function showRegistrationForm() {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->display("user/register.tpl");
    }

    public function showHome($logged) {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->display('user/home.tpl');
    }

    public function showModifyForm($user, $role) {
        $userArray = EUser::usertoArray($user);
        $this->smarty->assign('user', $userArray);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('modifiedUserClass', $role);
        $this->smarty->assign('formTemplate', "user/modify_forms/client.tpl");
        $this->smarty->display("user/modify_forms/modify_user_generic.tpl");
    }

    
    public function showUserCreationForm(){
         USmarty::configureBaseLayout($this->smarty);
         $this->smarty->display("user/create_user_form.tpl");

    }

    

}