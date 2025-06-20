<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

class CReservation{

  public static function createForm(){

     if (!CUser::isLogged()) {
            return;
        }
    
    $fields = FPersistentManager::getInstance()->loadAllFields();
    $view = new VReservation();
    $view->showReservationForm($fields);
  
  }
}
