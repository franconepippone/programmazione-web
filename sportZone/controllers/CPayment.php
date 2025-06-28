<?php

use App\Enum\UserSex;

require_once __DIR__ . "/../../vendor/autoload.php";

class CPayment {

    const METHOD_ONSITE = 0;
    const METHOD_ONLINE = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_FAILED = 3;
    const STATUS_PENDING = 4; // for onsite payments

    public static function selectMethod() {
        CUser::isLogged();
        CUser::assertRole(EClient::class);
        self::getOngoingPayment(); // automatically shows error and exits if not valid

        $view = new VPayment();
        $view->showPaymentMethodSelection(); 
    }

    public static function test() {
        CPayment::startPayment("29", "/payment/endtest");
    }

    public static function endtest() {
        CUser::isLogged();
        
        $outcome = self::getPaymentOutcome();
        print_r($outcome);
    }
    
/*    private static $rulesAddCreditCard = [
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
*/

    private static function getOngoingPayment(): array {
        CUser::isLogged();

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
        string $redirect_url
    ) {
        CUser::isLogged();
        CUser::assertRole(EClient::class);
        
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
            'redirect_url' => $redirect_url
        ];
        USession::setSessionElement('ongoingPayment', $ongoingPayment); 
        
        // redirects to the payment method selection page
        header("Location: /payment/selectMethod");
    }

    public static function payOnline() {
        // TODO IMPLEMENT ONLINE PAYMENT

        $ongoingPayment = self::getOngoingPayment(); // if this return then there is an ongoing payment
        $redirect = $ongoingPayment["redirect_url"];
        
        self::endPaymentAndStoreOutcome(self::METHOD_ONLINE, self::STATUS_SUCCESS);

        sleep(2);
        echo 'redirecting to '. $redirect . '...';
        header("Location: " . $redirect);
        exit;
    }

    public static function payOnsite() {
        // just mark the payment as pending
        $ongoingPayment = self::getOngoingPayment(); // if this return then there is an ongoing payment
        $redirect = $ongoingPayment["redirect_url"];
        
        self::endPaymentAndStoreOutcome(self::METHOD_ONSITE, self::STATUS_PENDING);

        echo 'redirecting to '. $redirect . '...';
        header("Location: " . $redirect);
        exit;
    }
    
    private static function endPaymentAndStoreOutcome(int $type, int $status)
    {
        USession::unsetSessionElement('ongoingPayment');
        $outcome = [
            'type' => $type,
            'status' => $status
        ];
        USession::setSessionElement('paymentOutcome', $outcome);
    }

    /*
    @returns null if there is no payment outcome 
    */ 
    #[PathUrl(PathUrl::HIDDEN)]
    public static function getPaymentOutcome(): ?array {
        if (USession::isSetSessionElement('paymentOutcome')) {
            $outcome = USession::getSessionElement('paymentOutcome');
            USession::unsetSessionElement('paymentOutcome');
            return $outcome;
        } else return null;
    }

}   