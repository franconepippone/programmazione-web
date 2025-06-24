<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

class CReservation{
  

  public static function reservationForm(){
    
    CUser::isLogged();
    
    $view = new VReservation();
    
    $fieldId = $POST('fieldId');
    if (!$fieldId) {
        VError::show("ID del campo non specificato.");
        return;

     // Get available hours for this field and date through FReservation
    $availableHours = FReservation::getAvailableHours($fieldId, $date);

     $date = $POST('date');
     if (!$date) {
        VError::show("data non specificata.");
        return;
    
    
     $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
     if (!$field) {
        VError::show("Campo non trovato.");
        return;

    $fieldData [] = EField::fieldToArray($field);
      
   
   
   
    $view->showReservationForm($fieldData,$date,$avaiableHours); //da passare field, date e avaiablehours
  
  }

 public static function finalizeReservation() {
    // Check if user is logged in
    CUser::isLogged();
      
    // Get user ID from session
    $userId = $_SESSION['userId'] ?? null;

    // Get POST parameters
    $fieldId = $_POST['id'] ?? null;
    $date = $_POST['data'] ?? null;
    $time = $_POST['orario'] ?? null;

    // Validate parameters individually and show error immediately
    if (!$fieldId) {
        $error = new VError();
        $error->show("Field ID is missing.");
        return;
    }
    if (!$date) {
        $error = new VError();
        $error->show("Date is not specified.");
        return;
    }
    if (!$time) {
        $error = new VError();
        $error->show("Time is not specified.");
        return;
    }

     Retrieve field from database
    $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    if (!$field) {
        $error = new VError();
        $error->show("Selected field not found.");
        return;
    }

    // Retrieve client from database
   $client = null;
   $fullName = null;

   if ($userId !== null) {
       $client = FPersistentManager::getInstance()->retriveClientById($userId);

       if (!$client) {
           $error = new VError();
           $error->show("Client information could not be found.");
           return;
       }

        Get full name from client (EClient extends EUser)
       $fullName = $client->getName() . ' ' . $client->getSurname();
    } else {
        $error = new VError();
        $error->show("User session invalid.");
        return;
    }

    // Process reservation if form confirmed with onsite payment
    if (isset($_POST['confirm']) && isset($_POST['paymentMethod']) && $_POST['paymentMethod'] === 'onsite') {
        $payment = new EOnsitePayment();
        $reservation = new EReservation($date, $time, $field, $client, $payment);
        FPersistentManager::getInstance()->storeReservation($reservation);

        $view = new VReservation();
        $view->showConfirmation();
        return;
    }

    // Otherwise, show the finalize reservation page with data for user to choose payment method
    $view = new VReservation();
    $view->showFinalizeReservation([ //passare i parametri
        $fullName,
        $date,
        $time;
        'field' => $field
        ]);
 }

  
  public static function cancelReservation() {
    // 1. Check if user is logged in
    CUser::isLogged();

    // 2. Get user ID from session
    $userId = $_SESSION['userId'] ?? null;

    // 3. Get POST parameter
    $reservationId = $_POST['id'] ?? null;

    // 4. Retrieve reservation from DB
    $reservation = null;
    if ($reservationId !== null && is_numeric($reservationId)) {
        $reservation = FPersistentManager::getInstance()->retriveObj(EReservation::class, intval($reservationId));
    }

     5. Check reservation exists
    if (!$reservation) {
        $errorView = new VError();
        $errorView->show("Prenotazione non trovata.");
        return;
    }

   //  6. Check user owns the reservation
    $client = $reservation->getClient();
    if (!$client || $client->getId() !== $userId) {
        $errorView = new VError();
        $errorView->show("Non sei autorizzato a cancellare questa prenotazione.");
        return;
    }

    // 7. If confirmed, delete and show confirmation
    if (isset($_POST['confirm'])) {
     //   FPersistentManager::getInstance()->deleteObj($reservation);
        $view = new VReservation();
        $view->showCancelConfirmation();
        return;
    }

    // 8. Otherwise, show cancellation form
    $view = new VReservation();
    $view->showCancelReservation($reservation);
 }
}
