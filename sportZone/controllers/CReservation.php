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
    // Check if user is logged in
    if (!CUser::isLogged()) {
        header('Location: /user/login');
        exit;
    }

    // Retrieve POST parameters or fallback to null
    $fieldId = $_POST['field_id'] ?? null;
    $date = $_POST['date'] ?? null;
    $time = $_POST['time'] ?? null;
    $paymentMethod = $_POST['payment'] ?? null;

    // Retrieve the field object if ID is present
    $field = null;
    if ($fieldId) {
        $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    }

    // Instantiate views for reservation and error
    $viewReservation = new VReservation();
    $viewError = new VError();

    // If payment method is not set, show the payment selection form
    if ($paymentMethod === null) {
        $viewReservation->showFinalizeReservation($field, $date, $time);
        return;
    }

    // Get logged-in client object
    $client = CUser::getLoggedUser();

    // Validate all necessary data before proceeding
    if (!$field || !$date || !$time || !$client) {
        $viewError->show("Insufficient data to complete the reservation.");
        return;
    }

    // Process based on payment method
    if ($paymentMethod === 'onsite') {
        // Create a new reservation entity and populate it
        $reservation = new EReservation();
        $reservation->setField($field);
        $reservation->setClient($client);
        $reservation->setDate($date);
        $reservation->setTime($time);

        // Save the reservation in the database
        FPersistentManager::getInstance()->saveReservation($reservation);

        // Redirect to onsite reservation confirmation page
        header('Location: /reservation/confirmation');
        exit;
    }

    if ($paymentMethod === 'online') {
        // Redirect to the online payment page with necessary query parameters
        $query = http_build_query([
            'field_id' => $fieldId,
            'date' => $date,
            'time' => $time,
            'client_id' => $client->getId()
        ]);
        header('Location: /onlinepayment/payForm' . $query);
        exit;
    }

    // If payment method is invalid, show an error message
    $viewError->show("Invalid payment method selected.");
}
}
