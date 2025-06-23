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

    public function showCreateCourseForm($data, $instructors, $fields) {
        $this->smarty->assign('name', $data['name'] ?? '');
        $this->smarty->assign('start_date', $data['start_date'] ?? '');
        $this->smarty->assign('start_time', $data['start_time'] ?? '');
        $this->smarty->assign('end_time', $data['end_time'] ?? '');
        $this->smarty->assign('days', $data['days'] ?? []);
        $this->smarty->assign('instructor', $data['instructor'] ?? '');
        $this->smarty->assign('field', $data['field'] ?? '');
        $this->smarty->assign('cost', $data['cost'] ?? '');
        $this->smarty->assign('max_participants', $data['max_participants'] ?? ''); // <-- modificato qui

        $this->smarty->assign('instructors', $instructors);
        $this->smarty->assign('fields', $fields);

        $this->smarty->display('employee/create_course_form.tpl');
   }

   public function showFinalizeCoursePage(array $data, EInstructor $instructor, EField $field) {
        $this->smarty->assign('name', $data['name']);
        $this->smarty->assign('start_date', $data['start_date']);
        $this->smarty->assign('start_time', $data['start_time']);
        $this->smarty->assign('end_time', $data['end_time']);
        $this->smarty->assign('days_string', implode(', ', $data['days']));
        $this->smarty->assign('cost', $data['cost']);
        $this->smarty->assign('max_participants', $data['max_participants']); // <-- già corretto qui
        $this->smarty->assign('instructor', $instructor);
        $this->smarty->assign('field', $field);
        $this->smarty->display('employee/finalize_course.tpl');
  }
}
