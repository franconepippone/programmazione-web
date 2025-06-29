<?php

require_once __DIR__ . '/../../vendor/autoload.php';

class VCourse
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = USmarty::getInstance();
    }
    //********************************************************* */
    public function showCreateCourseForm($instructors, $fields, $data = []) {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('instructors', array_map(fn($i) => EInstructor::instructorToArray($i), $instructors));
        $this->smarty->assign('fields', array_map(fn($f) => EField::fieldToArray($f), $fields));
        foreach (['title','description','start_date','cost','max_participants','days','instructor','field'] as $k) {
            $this->smarty->assign($k, $data[$k] ?? '');
        }
        $this->smarty->display('course/create_course_form.tpl');
    }

    public function showCourseSummary($data,$possiblehours) {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('title', $data['title']);
        $this->smarty->assign('description', $data['description']);
        $this->smarty->assign('start_date', $data['start_date']);
        $this->smarty->assign('end_date', $data['end_date']);
        $this->smarty->assign('duration', $data['duration']);
        $this->smarty->assign('days', $data['days']);
        $this->smarty->assign('days_string', implode(', ', $data['days']));
        $this->smarty->assign('cost', $data['cost']);
        $this->smarty->assign('max_participants', $data['max_participants']);
        $this->smarty->assign('instructor', EInstructor::instructorToArray($data['instructor']));
        $this->smarty->assign('field', EField::fieldToArray($data['field']));
        $this->smarty->assign('possiblehours', $possiblehours);
        $this->smarty->display('course/course_summary.tpl');
    }

    public function confirmCourse(ECourse $course) {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('data', ECourse::courseToArray($course));
        $this->smarty->display('course/confirm_course.tpl');
    }

    //******************************************************** */

    public function showSearchForm()
    {
    
        $this->smarty->display('course/searchForm.tpl');

    }
    //********************************************************* */
    

    
    // Metodo per visualizzare il form di iscrizione a un corso

    public function showCourseDetails($course)
    {
        // Controlla se il corso è stato trovato
        if ($course === null) {
            (new VError())->show("Corso non trovato.");
            return;
        }
        $courseData = [];
    
        $courseData [] = ECourse::courseToArray($course);
        //print_r($courseData);
        $this->smarty->assign('courses', $courseData);
        
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->display('course/courseDetails.tpl');

        //$this->smarty->display('course/courseDetailsClient.tpl');
    
    }



    public function showEnrollmentDetails($course, $user)
    {
        $userData = EUser::userToArray($user);
        $courseData = ECourse::courseToArray($course);
        // Assegna i dati del corso e dell'utente alla vista
        $this->smarty->assign('course', $courseData);
        $this->smarty->assign('user', $userData);
        
        // Mostra il template per il form di iscrizione
        $this->smarty->display('course/enrollmentDetails.tpl');
    }

    public function showEnrollForm($course)
    {
        $courseData = ECourse::courseToArray($course);
        $this->smarty->assign('course', $courseData);
        $this->smarty->display('course/enrollForm.tpl');
    }

    
 

    public function showCreateResult($result = null)
    {
        $this->smarty->assign('result', $result);
        $this->smarty->display('course/createResult.tpl');
    }

    
}   

// End of VCourse.php
// This class handles the view logic for courses, including displaying forms and results.   
// It uses Smarty for templating and expects templates to be located in the specified directories.
// Make sure to create the corresponding .tpl files in the templates directory for this to work.
// The class methods are designed to be called by the controller to render the appropriate views based on user actions.
//
// You can extend this class with more methods as needed for additional functionality, such as editing or deleting courses. 
// Ensure that the Smarty library is properly included and configured in your project for this to function correctly.
// Make sure to handle any necessary data retrieval and processing in the controller before calling these view methods.
// This class is part of a larger MVC framework, so it assumes that the controller will handle the logic and data retrieval.
// Ensure that the Smarty library is properly included and configured in your project for this to function correctly
