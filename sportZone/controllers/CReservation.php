<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

class CReservation{
  

  public static function reservationForm(){
    
    CUser::isLogged();
    
    $view = new VReservation();
    
    $fieldId = $_GET['fieldId'] ?? null;
    if (!$fieldId){ 
        $error = new VError();
        $error->show("ID non specificato.");
        return;
    }

     $date = $_GET['data'] ?? null;
    if (!$date) {
        $error = new VError();
        $error->show("Data non specificata.");
        return;
    }
     // Get available hours for this field and date through FReservation
    $avaiableHours = FReservation::getAvailableHours($fieldId, $date);

    $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    if (!$field) {
    $error = new VError();
        $error->show("Campo non trovato.");
        return;
    }
     
   
    $view->showReservationForm($field,$date,$avaiableHours); //da passare field, date e avaiablehours
  
    
 }

 public static function finalizeReservation() {
    // Check if user is logged in
    CUser::isLogged();
      
    // Get user ID from session
    $userId = $_SESSION['userId'] ?? null;

    // Get POST parameters
    $fieldId = $_POST['field_id'] ?? null;
    $date = $_POST['date'] ?? null;
    $time = $_POST['time'] ?? null;

    // Validate parameters individually and show error immediately
    if (!$fieldId) {
        $error = new VError();
        $error->show("ID non specificato.");
        return;
    }
    if (!$date) {
        $error = new VError();
        $error->show("Data non specificato.");
        return;
    }
    if (!$time) {
        $error = new VError();
        $error->show("Orario non specificato.");
        return;
    }

    // Retrieve field from database
    $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    if (!$field) {
        $error = new VError();
        $error->show("Campo non trovato.");
        return;
    }

    $client = FPersistentManager::getInstance()->retriveClientById($userId);
      //  Get full name from client (EClient extends EUser)
    $fullName = $client->getName() . ' ' . $client->getSurname();
     
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
        $time,
        'field' => $field
        ]);
 }

  
  public static function cancelReservation() {
    
    CUser::isLogged();
    $userId = $_SESSION['userId'] ?? null;

    // 3. Get POST parameter
    $reservationId = $_POST['id'] ?? null;

    // 4. Retrieve reservation from DB
    $reservation = null;
    if ($reservationId !== null && is_numeric($reservationId)) {
        $reservation = FPersistentManager::getInstance()->retriveObj(EReservation::class, intval($reservationId));
    }

   //  5. Check reservation exists
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
        FPersistentManager::getInstance()->deleteObj($reservation);
        $view = new VReservation();
        $view->showCancelConfirmation();
        return;
    }

    // 8. Otherwise, show cancellation form
    $view = new VReservation();
    $view->showCancelReservation($reservation);
 }
}
