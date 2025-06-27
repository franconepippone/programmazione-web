<?php
require __DIR__ . '/../../vendor/autoload.php';

class VError{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function show(string $message) {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign("error_message", $message);
        $this->smarty->display("status/error.tpl");
    }

    public function showSuccess(
        string $message, 
        string $buttName = "Continue", 
        string $buttAction = ""
    ) {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign("success_message", $message);
        $this->smarty->assign("butt_name", $buttName);
        $this->smarty->assign("butt_action", $buttAction);
        $this->smarty->display("status/success.tpl");      
    }
}
