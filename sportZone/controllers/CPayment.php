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

    private static function getOngoingPayment(): array {
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

        return USession::getSessionElement('ongoingPayment');
    }


    // TODO Vulnerability: this method can be called from any browser
    public static function startPayment(string $amount, string $redirectUrl, string $paymentSecret) {
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
            'paymentSecretHash' => password_hash($paymentSecret, PASSWORD_DEFAULT),
            'amountCents' => $amountCents,
            'redirectUrl' => $redirectUrl,
            'outcome' => null // this will be set later when the payment is confirmed
        ];
        USession::setSessionElement('ongoingPayment', $ongoingPayment); 
        
        // redirects to the payment method selection page
        header("Location: /payment/selectMethod");
        exit;
    }
    
    public static function selectMethod() {
        $ongoingPaymentData = self::getOngoingPayment();

        $amountCents = $ongoingPaymentData['amountCents'];
        $redirectUrl = $ongoingPaymentData['redirectUrl'];

        // mostra la lista dei metodi di pagamento dell'utente
        /** @var EClient $user */
        $user = CUser::getLoggedUser();
        $paymentMethods = $user->getPaymentMethods();

        $view = new VOnlinePayment();
        $view->showPaymentMethods($paymentMethods, $amountCents, $redirectUrl);
    }

    public static function confirmPay() {
        $ongoingPaymentData = self::getOngoingPayment();

        $amountCents = $ongoingPaymentData['amountCents'];
        $redirectUrl = $ongoingPaymentData['redirectUrl'];
        $outcome = $ongoingPaymentData['outcome'];

        echo "Amount: $amountCents, Redirect URL: $redirectUrl, Outcome: $outcome";

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

        // check if the payment has already been made
        if ($outcome == null) {
            $outcome = $paymentMethod->pay($amountCents); // amount in cents
        } else {
            $viewErr = new VError();
            $viewErr->show("Il pagamento è già stato effettuato.");
            exit;
        }

        // store the outcome in the session
        $ongoingPaymentData['outcome'] = $outcome; // store the outcome in the session
        USession::setSessionElement('ongoingPayment', $ongoingPaymentData);

        if (!$outcome) {
            $viewErr = new VError();
            $viewErr->show("Il pagamento non è andato a buon fine. Riprova più tardi.");
            USession::unsetSessionElement('ongoingPayment'); // remove the ongoing payment from session
            exit;
        }

        // payment successful, remove the ongoing payment from session
        header("Location: $redirectUrl");
    }

    public static function verifyAndEndPayment($paymentSecret): bool
    {
        $ongoingPaymentData = self::getOngoingPayment();
        print_r($ongoingPaymentData);
        
        // verify the payment secret
        if (!password_verify($paymentSecret, $ongoingPaymentData['paymentSecretHash'])) {
            echo "Payment secret does not match.";
            return false; // payment secret does not match
        }

        // remove the ongoing payment from session
        USession::unsetSessionElement('ongoingPayment');
        echo "Payment verified and ended successfully.";
        return true; // payment verified and ended successfully
    }

 
}