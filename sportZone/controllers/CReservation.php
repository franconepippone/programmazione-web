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

    $fieldId = UHTTPMethods::get('field_id');
    $date = UHTTPMethods::get('date');
    $time = UHTTPMethods::get('time');

    // Check if form is submitted via POST (payment method selected)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $paymentMethod = UHTTPMethods::post('payment_method');

        if (!$paymentMethod) {
            $view = new VError();
            $view->show("Payment method not selected.");
            return;
        }

        if ($paymentMethod === 'online') {
            // Redirect to online payment page with field_id, date, time
            header("Location: /onlinepayment/payForm?field_id={$fieldId}&date={$date}&time={$time}");
            exit;
        } elseif ($paymentMethod === 'onsite') {
            // Create reservation and redirect to confirmation
            $client = CUser::getUser();
            $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);

            // Check required entities
            if ($client && $field && $date && $time) {
                $reservation = new EReservation();
                $reservation->setClient($client);
                $reservation->setField($field);
                $reservation->setDate($date);
                $reservation->setTime($time);
                $reservation->setPaymentMethod(new EOnsitePayment());

                FPersistentManager::getInstance()->store($reservation);

                header("Location: /reservation/confirmation");
                exit;
            } else {
                $view = new VError();
                $view->show("Missing data to complete the reservation.");
                return;
            }
        } else {
            $view = new VError();
            $view->show("Invalid payment method.");
            return;
        }
    }

    // If GET request (first arrival), show the summary form
    $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);

    $view = new VReservation();
    $view->showFinalizeReservation($field, $date, $time);
}
}
