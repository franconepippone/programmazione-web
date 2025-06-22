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
       if (!CUser::isLogged()) {
        return;
    }

    // Prendi userId dalla sessione, se esiste
    $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

    // Prendi parametri GET o POST con controllo esistenza
    $fieldId = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);
    $date = isset($_GET['data']) ? $_GET['data'] : (isset($_POST['data']) ? $_POST['data'] : null);
    $time = isset($_GET['orario']) ? $_GET['orario'] : (isset($_POST['orario']) ? $_POST['orario'] : null);

    $field = null;
    if ($fieldId !== null) {
       // $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    }

    if (isset($_POST['confirm']) && isset($_POST['paymentMethod']) && $_POST['paymentMethod'] === 'onsite') {
        $client = null;
        if ($userId !== null) {
            $client = FPersistentManager::getInstance()->retriveClientByUserId($userId);
        }
        //$payment = new EOnsitePayment();
        //$reservation = new EReservation($date, $time, $field, $client, $payment);
        //FPersistentManager::getInstance()->storeReservation($reservation);

        $view = new VReservation();
        $view->showConfirmation();
        return;
    }

    $view = new VReservation();
    $view->showFinalizeReservation();
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
