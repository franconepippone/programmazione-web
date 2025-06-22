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

    public function showCancelConfirmation(){
        $this->smarty->display("employee/cancel_confirmation.tpl");
    }

     public function showReservations() { //dare array reservation e filtri
        $this->smarty->display("employee/show_reservations.tpl");
    }
    
}
