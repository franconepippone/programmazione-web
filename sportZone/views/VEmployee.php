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

<<<<<<< Updated upstream
<<<<<<< Updated upstream
    public function showCreateCourseForm($instructors, $fields, $data = []) {
        $this->smarty->assign('instructors', array_map(fn($i) => EInstructor::instructorToArray($i), $instructors));
        $this->smarty->assign('fields', array_map(fn($f) => EField::fieldToArray($f), $fields));
        foreach (['title','description','start_date','start_time','end_time','cost','max_participants','days','instructor','field'] as $k) {
            $this->smarty->assign($k, $data[$k] ?? '');
        }
        $this->smarty->display('employee/create_course_form.tpl');
    }

    public function showCourseSummary($data) {
        $this->smarty->assign('title', $data['title']);
        $this->smarty->assign('description', $data['description']);
        $this->smarty->assign('start_date', $data['start_date']);
        $this->smarty->assign('start_time', $data['start_time']);
        $this->smarty->assign('end_time', $data['end_time']);
        $this->smarty->assign('days', $data['days']);
        $this->smarty->assign('days_string', implode(', ', $data['days']));
        $this->smarty->assign('cost', $data['cost']);
        $this->smarty->assign('max_participants', $data['max_participants']);
        $this->smarty->assign('instructor', EInstructor::instructorToArray($data['instructor']));
        $this->smarty->assign('field', EField::fieldToArray($data['field']));
        $this->smarty->display('employee/course_summary.tpl');
    }

    public function confirmReservation(ECourse $course) {
        $this->smarty->assign('data', ECourse::courseToArray($course));
        $this->smarty->display('employee/confirm_reservation.tpl');
    }
=======

public function showCreateCourseForm($instructors, $fields, $data = []) {
    $instructorsArr = array_map(fn($i) => EInstructor::instructorToArray($i), $instructors);
    $fieldsArr = array_map(fn($f) => EField::fieldToArray($f), $fields);

=======

public function showCreateCourseForm($instructors, $fields, $data = []) {
    $instructorsArr = array_map(fn($i) => EInstructor::instructorToArray($i), $instructors);
    $fieldsArr = array_map(fn($f) => EField::fieldToArray($f), $fields);

>>>>>>> Stashed changes
    $formData = [
        'instructors' => $instructorsArr,
        'fields' => $fieldsArr,
        'form' => $data
    ];
    $this->smarty->assign('data', $formData);
    $this->smarty->display('employee/create_course_form.tpl');
}

public function showCourseSummary($validated) {
    $instructorArr = EInstructor::instructorToArray($validated['instructor']);
    $fieldArr = EField::fieldToArray($validated['field']);

    $summaryData = [
        'title' => $validated['title'],
        'description' => $validated['description'],
        'start_date' => $validated['start_date']->format('Y-m-d'),
        'start_time' => $validated['start_time']->format('H:i'),
        'end_time' => $validated['end_time']->format('H:i'),
        'days' => $validated['days'],
        'cost' => $validated['cost'],
        'max_participants' => $validated['max_participants'],
        'instructor' => $instructorArr,
        'field' => $fieldArr,
        'days_string' => implode(', ', $validated['days']),
    ];
    $this->smarty->assign('data', $summaryData);
    $this->smarty->display('employee/course_summary.tpl');
}

public function confirmReservation($course) {
    $courseArr = ECourse::courseToArray($course);
    $this->smarty->assign('data', $courseArr);
    $this->smarty->display('employee/confirm_reservation.tpl');
}
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
}
