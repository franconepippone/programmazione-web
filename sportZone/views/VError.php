<?php
require __DIR__ . '/../../vendor/autoload.php';

class VError{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function show($message) {
        $smarty = USmarty::getSmarty();
        $smarty->assign("errorMessage", $message);
        $smarty->display("error.tpl");
        exit;
    }
}
