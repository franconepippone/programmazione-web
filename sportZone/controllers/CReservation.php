<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

class CReservation{

  public static function reservationForm(){

     if (!CUser::isLogged()) {
            return;
        }
    
    $view = new VReservation();
    
    //$fieldId = UHTTPMethods::get('fieldId');
    //if (!$fieldId) {
       // VError::show("ID del campo non specificato.");
        //return;
    
    //$field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    //if (!$field) {
       // VError::show("Campo non trovato.");
        //return;

    //$date = UHTTPMethods::get('date') ?? (new DateTime())->format('Y-m-d');
    $view->showReservationForm();
  
  }

  public static function finalizeReservation() {
    // Check if the user is logged in
    if (!CUser::isLogged()) {
        header("Location: /user/login");
        exit;
    }

    $view = new VReservation();
    $pm = FPersistentManager::getInstance();

    // Phase 1: GET — show reservation summary and payment method selection
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $fieldId = UHTTPMethods::get("field_id");
        $date = UHTTPMethods::get("date");
        $time = UHTTPMethods::get("time");

        if (!$fieldId || !$date || !$time) {
            VError::show("Dati mancanti per completare la prenotazione.");
            return;
        }

        $field = $pm->retriveFieldById($fieldId);
        if (!$field) {
            VError::show("Campo non trovato.");
            return;
        }

        // Show summary page with payment method dropdown
        $view->showFinalizeForm($field, $date, $time);
        return;
    }

    // Phase 2: POST — handle selected payment method
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $fieldId = UHTTPMethods::post("field_id");
        $date = UHTTPMethods::post("date");
        $time = UHTTPMethods::post("time");
        $paymentMethod = UHTTPMethods::post("payment_method");

        if (!$fieldId || !$date || !$time || !$paymentMethod) {
            VError::show("Dati incompleti per finalizzare la prenotazione.");
            return;
        }

        $field = $pm->retriveFieldById($fieldId);
        if (!$field) {
            VError::show("Campo non trovato.");
            return;
        }

        $client = USession::get("user");
        if (!$client) {
            VError::show("Utente non autenticato.");
            return;
        }

        // Create the reservation object
        $reservation = new EReservation();
        $reservation->setClient($client);
        $reservation->setField($field);
        $reservation->setDate($date);
        $reservation->setTime($time);

        if ($paymentMethod === "onsite") {
            // Create an onsite payment
            $payment = new EOnsitePayment();
            $reservation->setPaymentMethod($payment);

            // Save to DB
            $pm->storeReservation($reservation);

            $view->showSuccess("Prenotazione completata con pagamento in sede.");
            return;

        } elseif ($paymentMethod === "online") {
            // Redirect to the payment form with necessary info
            $query = http_build_query([
                "field_id" => $fieldId,
                "date" => $date,
                "time" => $time
            ]);
            header("Location: /onlinepayment/payForm?$query");
            exit;

        } else {
            VError::show("Metodo di pagamento non valido.");
        }
    }
}
}
