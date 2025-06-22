<?php
require __DIR__ . '/../../vendor/autoload.php';

class VEmployee{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

  public function showCancelReservation() { //dare reservation
        $this->smarty->display("employee/cancel_reservation.tpl");
    }
}
