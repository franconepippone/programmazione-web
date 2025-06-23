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

     public function viewReservation() { //dare reservation 
        $this->smarty->display("employee/view_reservation.tpl");
    }

    public function showCreateCourseForm($data) {

        $smarty->assign('name', $data['name'] ?? '');
        $smarty->assign('start_date', $data['start_date'] ?? '');
        $smarty->assign('start_time', $data['start_time'] ?? '');
        $smarty->assign('end_time', $data['end_time'] ?? '');
        $smarty->assign('days', $data['days'] ?? []);
        $smarty->assign('instructor', $data['instructor'] ?? '');
        $smarty->assign('field', $data['field'] ?? '');

        $this->$smarty->display('employee/create_course_form.tpl');
    }
    
}
