<?php

use App\Enum\UserSex;

require_once __DIR__ . "/../../vendor/autoload.php";

class COnlinePayment{

    public static function payForm() {
        CUser::isLogged();



        $available_payments = [
            'paypal' => true,  // Mostra box PayPal
            'card' => true     // Mostra box pagamento con carta
        ];

        $view = new VOnlinePayment();
        $view->showPaymentMethodForm($available_payments);
    }

    public static function payOnline() {
        // arrivano:
        //  - somma da pagare
        //  - redirect uri (dove reindirizzare dopo il pagamento)

        // L'utente è recuperato dalla sessione
        $userid = USession::getSessionElement('user');
        $user = FPersistentManager::retriveUserOnId($userid);
        
    }

    public static function payPaypal() {

    }

    public static function payCard() {

    }
}