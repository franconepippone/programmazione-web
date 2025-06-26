<?php
require __DIR__ . '/../../vendor/autoload.php';

class VOnlinePayment{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showAddCreditCardForm() {
        $this->smarty->display("payment/add_credit_card.tpl");
    }

    public function showPaymentMethodSelection() {
        $this->smarty->display("payment/select_payment_method.tpl");
    }

    public function showUserPaymentMethods($paymentMethods, $amount) {
        $methodsInfo = [];
        foreach ($paymentMethods as $method) {
            $info = [
                'id' => $method->getId(),
                'type' => $method->getType(),
            ];

            // If this is an online payment and has a credit card, add card details
            if ($method instanceof EOnlinePayment) {
                $card = $method->getCreditCard();
                $info['number'] = $card->getNumber();
                $info['owner'] = $card->getOwner();
                $info['bank'] = $card->getBank();
                $info['cardNetwork'] = $card->getCardNetwork();
            } else {
                // For other payment types, set as empty or null
                $info['number'] = '';
                $info['owner'] = '';
                $info['bank'] = '';
                $info['cardNetwork'] = '';
            }

            $methodsInfo[] = $info;
        }

        $amount_eur = number_format($amount / 100, 2, ',', '.');

        $this->smarty->assign('amount', $amount_eur);
        $this->smarty->assign('paymentMethods', $methodsInfo);
        $this->smarty->display("payment/choose_method.tpl");
    }
    
}