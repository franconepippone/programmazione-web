<?php

use App\Enum\UserSex;

require_once __DIR__ . "/../../vendor/autoload.php";

class COnlinePayment {

    private static $rulesAddCreditCard = [
        "number" => 'validateCreditCardNumber',
        "expirationDate" => 'validateFutureDate',
        "cardNetwork" => 'validateCardNetwork',
        "bank" => 'validateBank',
        "cvv" => 'validateCVV',
        "owner" => 'validateFullName'
    ];

    public static function addCreditCardForm() {
        CUser::isLogged();

        $view = new VOnlinePayment();
        $view->showAddCreditCardForm();
    }

    public static function finalizeAddCreditCard() {
        CUser::isLogged();
        if (!CUser::isClient()) {
            $viewErr = new VError();
            $viewErr->show("You are not allowed to add a credit card.");
            exit;
        }; // only clients can add credit cards
        
        /** @var EClient $user */
        $user = CUser::getLoggedUser();

        try {
            $inputs = UValidate::validateInputArray($_POST, self::$rulesAddCreditCard, true);
        } catch (ValidationException $e) {
            $viewErr = new VError();
            $viewErr->show($e->getMessage());
            exit;
        }

        print_r($inputs);

        $card = (new ECreditCard())
        ->setBank($inputs['bank'])
        ->setCardNetwork($inputs['cardNetwork'])
        ->setCvv($inputs['cvv'])
        ->setExpirationDate($inputs['expirationDate'])
        ->setNumber($inputs['number'])
        ->setOwner($inputs['owner']);

        // HA SENSO CHE PAYMENT METHOD ABBIA LE RESERVATION E ENROLLEMENTS?
        $paymentMethod = (new EOnlinePayment())
        ->setClient($user)
        ->setCreditCard($card);

        $user->addPaymentMethod($paymentMethod);

    }

    public static function payOnline() {
        // arrivano:
        //  - somma da pagare
        //  - il metodo di pagamento scelto
        //  - redirect uri (dove reindirizzare dopo il pagamento)

        // L'utente è recuperato dalla sessione
        $userid = USession::getSessionElement('user');
        $user = FPersistentManager::retriveUserOnId($userid);

        try {
            $inputs = UValidate::validateInputArray($_GET, ["paymentMethod", "amount", "redirect_url"], true);
        } catch (ValidationException $e) {
            $viewErr = new VError();
            $viewErr->show($e->getMessage());
            exit;
        }
    }

    public static function payPaypal() {

    }

    public static function payCard() {

    }
}