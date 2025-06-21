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
   
    // Get available hours for this field and date through FReservation
    //$availableHours = FReservation::getAvailableHours($fieldId, $date);
    //$date = UHTTPMethods::get('date') ?? (new DateTime())->format('Y-m-d');
    
    $view->showReservationForm();
  
  }

  public static function finalizeReservation() {
    // Verifica login
    if (!CUser::isLogged()) {
        header("Location: /user/login");
        exit;
    }

    $view = new VReservation();
    $pm = FPersistentManager::getInstance();

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Leggi parametri da query string
        $fieldId = UHTTPMethods::get("field_id");
        $date = UHTTPMethods::get("date");
        $time = UHTTPMethods::get("time");

        if (!$fieldId || !$date || !$time) {
            $errorView = new VError();
            $errorView->show("Dati mancanti per completare la prenotazione.");
            return;  
        }

        $field = $pm->retrieveFieldById($fieldId);
        if (!$field) {
            $errorView = new VError();
            $errorView->show("Campo non trovato.");
            return;
        }

        
        $view->showFinalizeReservation($field, $date, $time);
        return;
    }

    else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $fieldId = UHTTPMethods::post("field_id");
        $date = UHTTPMethods::post("date");
        $time = UHTTPMethods::post("time");
        $paymentMethod = UHTTPMethods::post("payment_method");

        if (!$fieldId || !$date || !$time || !$paymentMethod) {
            $errorView = new VError();
            $errorView->show("Dati incompleti per finalizzare la prenotazione.");
            return;
        }

        $field = $pm->retrieveFieldById($fieldId);
        if (!$field) {
            $errorView = new VError();
            $errorView->show("Campo non trovato.");
            return;
        }

        $client = USession::get("user");
        if (!$client) {
            $errorView = new VError();
            $errorView->show("Utente non autenticato.");
            return;
        }

       
        $reservation = new EReservation();
        $reservation->setClient($client);
        $reservation->setField($field);
        $reservation->setDate($date);
        $reservation->setTime($time);

        
        if ($paymentMethod === "onsite") {
            $payment = new EOnsitePayment();
            $reservation->setPaymentMethod($payment);

            
            $pm->storeReservation($reservation);

            $view->showSuccess("Prenotazione completata con pagamento in sede.");
            return;
        }

        elseif ($paymentMethod === "online") {
            
            $query = http_build_query([
                "field_id" => $fieldId,
                "date" => $date,
                "time" => $time
            ]);
            header("Location: /onlinepayment/payForm?$query");
            exit;
        }

        else {
            $errorView = new VError();
            $errorView->show("Metodo di pagamento non valido.");
            return;
        }
    }
 }
}
