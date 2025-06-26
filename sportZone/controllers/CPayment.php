<?php

use App\Enum\UserSex;

require_once __DIR__ . "/../../vendor/autoload.php";

class CPayment {

    #[PathUrl('pay')]
    public static function paymentEntryPoint() {
        $ongoingPaymentData = self::getOngoingPayment();
        if ($ongoingPaymentData == null) exit;

        header("Location: /payment/selectMethod");
    }

    public static function selectMethod() {
       
        $view = new VOnlinePayment();
        $view->showPaymentMethodSelection(); 
    }
    
    

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
        
        // @var EClient $user 
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

    #[PathUrl(PathUrl::HIDDEN)]
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

    /**
     * Starts a payment process by storing the payment details in the session.
     * If 'redirectNow' is true, it redirects to the payment method selection page.
     * Otherwise, you must manually redirect to '/payment/pay' (i.e. through form).
     * 
     * @param string $amount The amount to be paid, in euros.
     * @param string $success_url The URL to redirect to after the payment is completed.
     * @param string $cancel_url The URL to redirect to after the payment is cancelled or fails.
     * @param string $paymentSecret A secret key for verifying the payment later.
     */
    #[PathUrl(PathUrl::HIDDEN)]
    public static function startPayment(
        string $amount, 
        string $success_url, 
        string $cancel_url, 
        string $paymentSecret, 
        bool $redirectNow = false
    ): never {
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
            'successRedirectUrl' => $success_url,
            'cancelRedirectUrl' => $cancel_url,
            'outcome' => null // this will be set later when the payment is confirmed
        ];
        USession::setSessionElement('ongoingPayment', $ongoingPayment); 
        
        // redirects to the payment method selection page
        if ($redirectNow) header("Location: /payment/pay");
        exit;
    }
    
    public static function __selectMethod() {
        $ongoingPaymentData = self::getOngoingPayment();

        $amountCents = $ongoingPaymentData['amountCents'];

        // mostra la lista dei metodi di pagamento dell'utente
        /** @var EClient $user */
        $user = CUser::getLoggedUser();
        $paymentMethods = $user->getPaymentMethods();

        $view = new VOnlinePayment();
        $view->showPaymentMethods($paymentMethods, $amountCents);
    }

    public static function confirmPay() {
        $ongoingPaymentData = self::getOngoingPayment();

        $amountCents = $ongoingPaymentData['amountCents'];
        $successRedirectUrl = $ongoingPaymentData['successRedirectUrl'];
        $cancelRedirectUrl = $ongoingPaymentData['cancelRedirectUrl'];
        $outcome = $ongoingPaymentData['outcome'];

        echo "Amount: $amountCents, Redirect URL: $successRedirectUrl, Outcome: $outcome, Cancel URL: $cancelRedirectUrl";

        // arrivano in POST:
        //  - il metodo di pagamento scelto (id)

        try {
            $inputs = UValidate::validateInputArray($_POST, ['methodId' => 'validateId'], true);
        } catch (ValidationException $e) {
            $viewErr = new VError();
            $viewErr->show($e->getMessage());
            exit;
        }

        $methodId = $inputs['methodId'];
        
        // check if the methodId is valid and belongs to the user and recovers it
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
        header("Location: $successRedirectUrl");
    }

    #[PathUrl(PathUrl::HIDDEN)]
    public static function verifyAndEndPayment($paymentSecret): bool
    {
        $ongoingPaymentData = self::getOngoingPayment();

        // verify the payment secret
        if (!password_verify($paymentSecret, $ongoingPaymentData['paymentSecretHash'])) {
            echo "Payment secret does not match.";
            return false; // payment secret does not match
        }

        // remove the ongoing payment from session
        USession::unsetSessionElement('ongoingPayment');
        return true; // payment verified and ended successfully
    }

}   