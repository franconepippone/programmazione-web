<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

class CReservation{

  public static function createForm(){

     if (!CUser::isLogged()) {
            return;
        }
    
    $view = new VReservation();
    $fieldId = UHTTPMethods::get('fieldId');
    $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    $view->showReservationForm($fields);
  
  }
}
