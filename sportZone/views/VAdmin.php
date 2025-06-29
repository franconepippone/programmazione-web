<?php

require_once __DIR__ . '/../../vendor/autoload.php';
class VAdmin{

    private $smarty;

    public function __construct() {
        $this->smarty = USmarty::getInstance();
    }


    public function showUserCreationForm(){
         USmarty::configureBaseLayout($this->smarty);
         $this->smarty->display("admin/create_user_form.tpl");

    }




}