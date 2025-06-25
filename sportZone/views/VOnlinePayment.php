<?php
require __DIR__ . '/../../vendor/autoload.php';

class VOnlinePayment{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showAddCreditCardForm() {
        $this->smarty->display("onlinepayment/add_credit_card.tpl");
    }
    
}