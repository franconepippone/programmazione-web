<?php
require __DIR__ . '/../../vendor/autoload.php';

class VReservation{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showReservationForm($field,$date,$avaiableHours) {
        $fieldData = EField::fieldToArray($field);
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign("fieldData", $fieldData);
        $this->smarty->assign("date", $date);
        $this->smarty->assign("avaiableHours", $avaiableHours);
        $this->smarty->display("reservation/reservation_form.tpl");
    }


    public function showReservationSummary($fullName, $date, $time, $field) {
        $fieldData = EField::fieldToArray($field);
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign("fullName", $fullName);
        $this->smarty->assign("date", $date);
        $this->smarty->assign("time", $time);
        $this->smarty->assign("fieldData", $fieldData);
        $this->smarty->display("reservation/reservation_summary.tpl");
    }

    public function showConfirmation() {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->display("reservation/confirmation.tpl");
    }

    public function showCancelReservation($reservation,$field) {
        $reservationData = EReservation::reservationToArray($reservation);
        $fieldData = EField::fieldToArray($field);
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign("reservation", $reservationData);
        $this->smarty->assign("field", $fieldData);
        $this->smarty->display("reservation/cancel_reservation.tpl");
    }

    public function showCancelConfirmation() {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->display("reservation/cancel_confirmation.tpl");
    }

    public function showCancelInfo() {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->display('reservation/cancel_info.tpl');
    }


    public function showReservationDetails($reservation) {
        USmarty::configureBaseLayout($this->smarty);
        $reservationArray = EReservation::reservationToArray($reservation);
        $this->smarty->assign('reservation', $reservationArray);
        $this->smarty->display('reservation/reservation_details.tpl');
    }
    
  

    public function showModifyForm($reservation) {
        USmarty::configureBaseLayout($this->smarty);
        $reservationArray = EReservation::reservationToArray($reservation);
        $this->smarty->assign('reservation', $reservationArray);
        $this->smarty->display('reservation/modify_reservation.tpl');
    }

    public function showModifyConfirmation() {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->display('reservation/modify_confirmation.tpl');
    }

    public function showModifyDateForm($reservation) {
        $reservationArray = EReservation::reservationToArray($reservation);
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('reservation', $reservationArray);
        $this->smarty->display('reservation/modify_date.tpl');
    }

    public function showModifyTimeForm($reservation, $newDate, $avaiableHours) {
        $reservationArray = EReservation::reservationToArray($reservation);
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('reservation', $reservationArray);
        $this->smarty->assign('date', $newDate);
        $this->smarty->assign('avaiableHours', $avaiableHours);
        $this->smarty->display('reservation/modify_time.tpl');
    }
}
