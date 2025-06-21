<?php
require __DIR__ . '/../../vendor/autoload.php';

class VReservation{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showReservationForm() {
        $this->smarty->display("reservation/reservation_form.tpl");
    }

    public function showFinalizeReservation($field, $date, $time){
        $this->smarty->assign("field", $field);
        $this->smarty->assign("date", $date);
        $this->smarty->assign("time", $time);
        $this->smarty->display("reservation/finalize_reservation.tpl");
    }
}
