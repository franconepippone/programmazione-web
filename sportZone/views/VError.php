<?php
require __DIR__ . '/../../vendor/autoload.php';

class VError{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function show(string $message) {
        $this->smarty->assign("error_message", $message);
        $this->smarty->display("error.tpl");
    }
}
