<?php


require_once __DIR__ . '/../../vendor/autoload.php';

class VEnrollment
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = USmarty::getInstance();
    }

    // Mostra il form di iscrizione a un corso
    public function showEnrollForm($course, $user)
    {
        $courseData = ECourse::courseToArray($course);
        $userData = EUser::userToArray($user);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('course', $courseData);
        $this->smarty->assign('user', $userData);
        $this->smarty->display('enrollment/enrollForm.tpl');
    }

    // Mostra la conferma di iscrizione
    public function showEnrollmentConfirmation($user, $course)
    {
        $userData = EUser::userToArray($user);
        $courseData = ECourse::courseToArray($course);

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('user', $userData);
        $this->smarty->assign('course', $courseData);
        $this->smarty->display('enrollment/enrollmentConfirmation.tpl');
    }
    
    public function showEnrollmentFinalization($enrollment)
    {
        USmarty::configureBaseLayout($this->smarty);
        $enrollmentData = EEnrollment::enrollmentToArray($enrollment);
        $this->smarty->assign('enrollment', $enrollmentData);
        $this->smarty->display('enrollment/enrollmentFinalization.tpl');
    }

    // Mostra tutte le iscrizioni dell'utente loggato
    public function showMyEnrollments($enrollments)
    {
        $enrollmentsData = [];
        foreach ($enrollments as $enrollment) {
            $enrollmentsData[] = EEnrollment::enrollmentToArray($enrollment);
        }
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('enrollments', $enrollmentsData);
        $this->smarty->display('enrollment/myEnrollments.tpl');
    }

    // Mostra la conferma di cancellazione iscrizione
    public function showDeleteConfirmation()
    {
        $this->smarty->display('enrollment/deleteConfirmation.tpl');
    }

    // Mostra tutti gli iscritti a un corso
    public function showEnrollmentsOfCourse($enrollments, $course_id)
    {
        $enrollmentsData = [];
        foreach ($enrollments as $enrollment) {
            $enrollmentsData[] = EEnrollment::enrollmentToArray($enrollment);

        }
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('enrollments', $enrollmentsData);
        $this->smarty->assign('course_id', $course_id);
        $this->smarty->display('enrollment/enrollmentsOfCourse.tpl');
    }
}