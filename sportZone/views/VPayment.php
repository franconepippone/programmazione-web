<?php
require __DIR__ . '/../../vendor/autoload.php';

class VPayment{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }



    public function showPaymentMethodSelection() {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->display("payment/select_payment_method.tpl");
    }

    
}