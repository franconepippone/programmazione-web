<?php
require __DIR__ . '/../../vendor/autoload.php';

class VOnlinePayment{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showPaymentMethodForm($available_payments) {
        $this->smarty->assign('available_payments', $available_payments);
        $this->smarty->display("onlinepayment/choose_method.tpl");
    }
}