<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

class CReservation{

  public static function createForm(){
    
    $fields = FPersistentManager::getInstance()->retriveAll(EField::getEntity());
    $view = new VReservation();
    $view->showReservationForm($fields);
  
  }
}
