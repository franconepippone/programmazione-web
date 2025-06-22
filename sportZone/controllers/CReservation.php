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

     //$date = UHTTPMethods::get('date');
     //if (!$date) {
       // VError::show("data non specificata.");
        //return;
    
    
    //$field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    //if (!$field) {
       // VError::show("Campo non trovato.");
        //return;
   
    // Get available hours for this field and date through FReservation
    //$availableHours = FReservation::getAvailableHours($fieldId, $date);
   
    $view->showReservationForm(); //da passare field, date e avaiablehours
  
  }

 public static function finalizeReservation() {
    // Check if user is logged in
    if (!CUser::isLogged()) {
        $error = new VError();
        $error->show("You must be logged in to proceed.");
        return;
    }

    // Get user ID from session
    $userId = $_SESSION['userId'] ?? null;

    // Get POST parameters
    $fieldId = $_POST['id'] ?? null;
    $date = $_POST['data'] ?? null;
    $time = $_POST['orario'] ?? null;

    // Validate parameters individually and show error immediately
  //  if (!$fieldId) {
    //    $error = new VError();
     //   $error->show("Field ID is missing.");
     //   return;
   // }
   // if (!$date) {
     //   $error = new VError();
     //   $error->show("Date is not specified.");
      //  return;
    //}
    //if (!$time) {
      //  $error = new VError();
       // $error->show("Time is not specified.");
       // return;
    //}

    // Retrieve field from database
    //$field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    //if (!$field) {
      //  $error = new VError();
       // $error->show("Selected field not found.");
       // return;
    //}

    // Retrieve client from database
    $client = null;
    $username = null;
    if ($userId !== null) {
        $client = FPersistentManager::getInstance()->retriveClientByUserId($userId);
        if (!$client) {
            $error = new VError();
            $error->show("Client information could not be found.");
            return;
        }
        $username = $client->getUser()->getUsername();
    } else {
        $error = new VError();
        $error->show("User session invalid.");
        return;
    }

    // Process reservation if form confirmed with onsite payment
    if (isset($_POST['confirm']) && isset($_POST['paymentMethod']) && $_POST['paymentMethod'] === 'onsite') {
       // $payment = new EOnsitePayment();
        //$reservation = new EReservation($date, $time, $field, $client, $payment);
        //FPersistentManager::getInstance()->storeReservation($reservation);

        $view = new VReservation();
        $view->showConfirmation();
        return;
    }

    // Otherwise, show the finalize reservation page with data for user to choose payment method
    $view = new VReservation();
    $view->showFinalizeReservation(); //passare i parametri
      //  ['username' => $username,
       // 'date' => $date,
       // 'time' => $time,
       // 'field' => $field
   // ]);
 }

  
  public static function cancelReservation() {
    if (!CUser::isLogged()) {
        header('Location: index.php?controller=user&task=loginForm');
        exit;
    }

    $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : null;

   // if ($id === null || $id <= 0) {
     //   $errorView = new VError();
       // $errorView->show('ID prenotazione non valido.');
       // return;
    //}

    //$reservation = FPersistentManager::getInstance()->retriveObj(EReservation::class, $id);

    //if ($reservation === null) {
      //  $errorView = new VError();
        //$errorView->show('Prenotazione non trovata.');
        //return;
    //}

   // $userId = USession::getSessionElement('userId') ?? null;
    //if ($userId === null) {
      //  header('Location: index.php?controller=user&task=loginForm');
        //exit;
    //}

    //$client = $reservation->getClient();
    //if ($client === null || $client->getUserId() !== $userId) {
      //  $errorView = new VError();
        //$errorView->show('Non sei autorizzato a cancellare questa prenotazione.');
        //return;
    //}

    $view = new VReservation();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
      //  FPersistentManager::getInstance()->deleteObj($reservation);
        $view->showCancelConfirmation();
        return;
    }

   // $view->reservation = $reservation;
    $view->showCancelReservation();
 }
}
