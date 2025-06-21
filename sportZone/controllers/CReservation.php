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
            VError::show("Dati mancanti per completare la prenotazione.");
        }

        $field = $pm->retrieveFieldById($fieldId);
        if (!$field) {
            VError::show("Campo non trovato.");
        }

        // Mostra riepilogo con scelta metodo di pagamento
        $view->showFinalizeReservation($field, $date, $time);
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Leggi parametri da POST
        $fieldId = UHTTPMethods::post("field_id");
        $date = UHTTPMethods::post("date");
        $time = UHTTPMethods::post("time");
        $paymentMethod = UHTTPMethods::post("payment_method");

        if (!$fieldId || !$date || !$time || !$paymentMethod) {
            VError::show("Dati incompleti per finalizzare la prenotazione.");
        }

        $field = $pm->retrieveFieldById($fieldId);
        if (!$field) {
            VError::show("Campo non trovato.");
        }

        $client = USession::get("user");
        if (!$client) {
            VError::show("Utente non autenticato.");
        }

        // Crea prenotazione
        $reservation = new EReservation();
        $reservation->setClient($client);
        $reservation->setField($field);
        $reservation->setDate($date);
        $reservation->setTime($time);

        // Gestione metodo di pagamento
        if ($paymentMethod === "onsite") {
            $payment = new EOnsitePayment();
            $reservation->setPaymentMethod($payment);

            // Salva prenotazione con pagamento in sede
            $pm->storeReservation($reservation);

            $view->showSuccess("Prenotazione completata con pagamento in sede.");
            return;

        } elseif ($paymentMethod === "online") {
            // Reindirizza a pagina pagamento online con parametri
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
