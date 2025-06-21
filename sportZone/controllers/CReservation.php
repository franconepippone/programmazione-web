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
    if (!CUser::isLogged()) {
        header("Location: /user/login");
        exit;
    }

    // Get parameters ONLY via GET
    $fieldId = $_GET['field_id'] ?? null;
    $date = $_GET['date'] ?? null;
    $time = $_GET['time'] ?? null;

    // Try to retrieve the EField object (may be null during testing)
    $field = null;
    if ($fieldId !== null) {
        $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    }

    // If no POST (i.e., no payment method chosen yet), show recap page
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $view = new VReservation();
        $view->showFinalizeReservation($field, $date, $time);
        return;
    }

    // Handle POST form submission (confirm clicked)
    $paymentMethod = $_POST['paymentMethod'] ?? null;

    if ($paymentMethod === 'online') {
        // Redirect to online payment form via GET
        $query = http_build_query([
            'field_id' => $fieldId,
            'date' => $date,
            'time' => $time
        ]);
        header("Location: /onlinepayment/payForm?$query");
        exit;

    } elseif ($paymentMethod === 'onsite') {
        // Retrieve current client
        $client = CUser::getUserLogged();
        if (!$client || !$field || !$date || !$time) {
            VError::show("Missing data for onsite reservation.");
            return;
        }

        // Create and store the reservation
        $reservation = new EReservation();
        $reservation->setDate(new DateTime($date));
        $reservation->setTime($time);
        $reservation->setField($field);
        $reservation->setClient($client);
        $reservation->setPaymentMethod(new EOnsitePayment());

        FPersistentManager::getInstance()->storeReservation($reservation);

        // Redirect to confirmation page
        header("Location: /reservation/confirmation");
        exit;

    } else {
        VError::show("Invalid or missing payment method.");
    }
}
}
