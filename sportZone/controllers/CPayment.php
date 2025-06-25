<?php

use App\Enum\UserSex;

require_once __DIR__ . "/../../vendor/autoload.php";

class CPayment {

    private static $rulesAddCreditCard = [
        "number" => 'validateCreditCardNumber',
        "expirationDate" => 'validateFutureDate',
        "cardNetwork" => 'validateCardNetwork',
        "bank" => 'validateBank',
        "cvv" => 'validateCVV',
        "owner" => 'validateFullName'
    ];

    private static $rulesPay = [
        "amount" => 'validateCurrencyAmount',
        "redirectUrl" => 'skipValidation'
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

        // TODO maybe Check if a card with the same number already exists for this user

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
        FPersistentManager::getInstance()->uploadObj($paymentMethod);
        echo "uploaded";
    }

    // TODO Vulnerability: this method can be called from any browser
    public static function startPayment(string $amount, string $redirectUrl) {
        CUser::isLogged();
        if (!CUser::isClient()) {
            $viewErr = new VError();
            $viewErr->show("Solo i clienti possono pagare.");
            exit;
        }; // only clients can pay
        
        try {
            $amountCents =  UValidate::validateCurrencyAmount($amount); // validate amount
        } catch (ValidationException $e) {
            $viewErr = new VError();
            $viewErr->show($e->getMessage());
            exit;
        }

        // stores in session, so they are safe and not modifiable
        $ongoingPayment = [
            'amountCents' => $amountCents,
            'redirectUrl' => $redirectUrl
        ];
        USession::setSessionElement('ongoingPayment', $ongoingPayment); 
        
        // redirects to the payment method selection page
        header("Location: /payment/selectMethod");
        exit;
    }
    
    public static function selectMethod() {
        CUser::isLogged();
        if (!CUser::isClient()) {
            $viewErr = new VError();
            $viewErr->show("Solo i clienti possono pagare.");
            exit;
        }; // only clients can pay

        // verify that the user has started a payment
        if (!USession::isSetSessionElement('ongoingPayment')) {
            $viewErr = new VError();
            $viewErr->show("Non hai iniziato un pagamento.");
            exit;
        }

        // recupera i dati del pagamento in corso dalla sessione
        $ongoingPayment = USession::getSessionElement('ongoingPayment');
        $amountCents = $ongoingPayment['amountCents'];
        $redirectUrl = $ongoingPayment['redirectUrl'];

        // mostra la lista dei metodi di pagamento dell'utente
        /** @var EClient $user */
        $user = CUser::getLoggedUser();
        $paymentMethods = $user->getPaymentMethods();

        $view = new VOnlinePayment();
        $view->showPaymentMethods($paymentMethods, $amountCents, $redirectUrl);
    }

    public static function pay() {
        CUser::isLogged();
        if (!CUser::isClient()) {
            $viewErr = new VError();
            $viewErr->show("Solo i clienti possono pagare.");
            exit;
        }; // only clients can pay

        // verify that the user has started a payment
        if (!USession::isSetSessionElement('ongoingPayment')) {
            $viewErr = new VError();
            $viewErr->show("Non hai iniziato un pagamento.");
            exit;
        }

        // recupera i dati del pagamento in corso dalla sessione
        $ongoingPayment = USession::getSessionElement('ongoingPayment');
        $amount = $ongoingPayment['amount'];
        $redirectUrl = $ongoingPayment['redirectUrl'];
        $paymentIdentifierHash = $ongoingPayment['paymentIdentifierHash'];

        echo "Amount: $amount, Redirect URL: $redirectUrl";

        // arrivano in POST:
        //  - il metodo di pagamento scelto (id)

        try {
            $inputs = UValidate::validateInputArray($_POST, ['methodId' => 'skipValidation'], true);
        } catch (ValidationException $e) {
            $viewErr = new VError();
            $viewErr->show($e->getMessage());
            exit;
        }

        $methodId = $inputs['methodId'];
        
        // recupera il metodo di pagamento scelto dall'utente
        /** @var EClient $user */
        $user = CUser::getLoggedUser();
        $paymentMethods = $user->getPaymentMethods();
        $paymentMethod = null;
        foreach ($paymentMethods as $method) {
            if ($method->getId() == $methodId) {
                $paymentMethod = $method;
                break;
            }
        }

        // validate that the payment method exists and belongs to the user
        if ($paymentMethod === null) {
            $viewErr = new VError();
            $viewErr->show("Il metodo di pagamento scelto non esiste o non ti appartiene.");
            exit;
        }

        $outcome = $paymentMethod->pay((int) ($amount * 100)); // amount in cents

        // effettua il pagamento chiamando pay() sull'oggetto PaymentMethod

        // se il pagamento va a buon fine, reindirizza l'utente alla redirect uri, senno mostra un errore

    }

 
}