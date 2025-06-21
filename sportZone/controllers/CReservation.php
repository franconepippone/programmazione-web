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

        $userId = USession::getElement('userId');
        $fieldId = UHTTPMethods::get('id');
        $date = UHTTPMethods::get('data');
        $time = UHTTPMethods::get('orario');

        $field = null;
        if ($fieldId !== null) {
            $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
        }

        // Se il form è stato inviato con metodo onsite
        if (UHTTPMethods::post('confirm') && UHTTPMethods::post('paymentMethod') === 'onsite') {
            $client = FPersistentManager::getInstance()->retriveClientByUserId($userId);
            $payment = new EOnsitePayment();
            $reservation = new EReservation($date, $time, $field, $client, $payment);
            FPersistentManager::getInstance()->storeReservation($reservation);

            $view = new VReservation();
            $view->showConfirmation();
            return;
        }

        // Visualizzazione iniziale
        $view = new VReservation();
        $view->showFinalizeForm($field, $date, $time);
    }
   }
  } 
