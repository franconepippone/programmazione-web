<?php
require __DIR__ . '/../../vendor/autoload.php';

class VReservation{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showReservationForm() {
        //passare avaiable hours, field, date
        $this->smarty->display("reservation/reservation_form.tpl");
    }

    public function showFinalizeReservation(){
        //$this->smarty->assign("name", $name);
        //$this->smarty->assign("field", $field);
        //$this->smarty->assign("date", $date);
        //$this->smarty->assign("time", $time);
        $this->smarty->display("reservation/finalize_reservation.tpl");
    }

    public function showConfirmation(){
        $this->smarty->display("reservation/confirmation.tpl");
    }

    public function showCancelReservation() {
        $this->smarty->display("reservation/cancel_reservation.tpl");
    }

     public function showCancelConfirmation() {
        $this->smarty->display("reservation/cancel_confirmation.tpl");
    }
        
}
