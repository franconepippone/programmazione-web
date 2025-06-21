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
        $payment = new EOnsitePayment();
        //$reservation = new EReservation($date, $time, $field, $client, $payment);
        //FPersistentManager::getInstance()->storeReservation($reservation);

        $view = new VReservation();
        $view->showConfirmation();
        return;
    }

    $view = new VReservation();
    $view->showFinalizeReservation();
}
   }
   
