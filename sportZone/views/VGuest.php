<?php
require __DIR__ . '/../../vendor/autoload.php';

class VGuest {

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showGuestHome() {

        $this->chooseLayout();
        $this->smarty->display('guest/home.tpl');
    }

    private function chooseLayout() {
        $this->smarty->assign('layout', true ? 
        'sportZone/views/Smarty/templates/layouts/guest_base.tpl' : 'sportZone/views/Smarty/templates/layouts/layout.tpl');
    }

}