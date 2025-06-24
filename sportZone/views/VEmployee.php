<?php
require __DIR__ . '/../../vendor/autoload.php';

class VEmployee{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showCancelReservation($reservation) { 
        $this->smarty->assign('reservation', $reservation);
        $this->smarty->display("employee/cancel_reservation.tpl");    
    }

    public function showCancelConfirmation(){
        $this->smarty->display("employee/cancel_confirmation.tpl");
    }

     public function showReservations() { //dare array reservation e filtri
        $this->smarty->display("employee/show_reservations.tpl");
    }

     public function viewReservation($reservation) { 
        $this->smarty->assign('reservation', $reservation);                                         
        $this->smarty->display("employee/view_reservation.tpl");
    }

    public function showCreateCourseForm($instructors, $fields) {
        $this->smarty->assign('instructors', $instructors);
        $this->smarty->assign('fields', $fields);

        $this->smarty->display('employee/create_course_form.tpl');
   }

   public function showFinalizeCreateCourse(array $data, EInstructor $instructor, EField $field) {
        $this->smarty->assign('name', $data['name']);
        $this->smarty->assign('description', $data['description']);
        $this->smarty->assign('start_date', $data['start_date']);
        $this->smarty->assign('start_time', $data['start_time']);
        $this->smarty->assign('end_time', $data['end_time']);
        $this->smarty->assign('days_string', implode(', ', $data['days']));
        $this->smarty->assign('cost', $data['cost']);
        $this->smarty->assign('max_participants', $data['max_participants']); 
        $this->smarty->assign('instructor', $instructor);
        $this->smarty->assign('field', $field);
        $this->smarty->display('employee/finalize_create_course.tpl');
  }
    public function showCourseConfirmation(){
        $this->smarty->display("employee/course_confirmation.tpl");
    }
}
