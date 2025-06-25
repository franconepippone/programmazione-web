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
    // Metodo per visualizzare il form di ricerca dei corsi
    public function showCreateCourseForm($instructors, $fields) {
        $instructorsData = [];
        $fieldsData = [];

        foreach ($fields as $field) {
            $fieldsData[] = EField::fieldToArray($field);
        }
       
        foreach ($instructors as $instructor) {
            $instructorsData[] = EInstructor::instructorToArray($instructor);
        }

        
        $this->smarty->assign('instructors', $instructors);
        $this->smarty->assign('fields', $fields);

        $this->smarty->display('course/create_course_form.tpl');
    }



    //******************************************************** */

    public function showSearchForm()
    {
    
        $this->smarty->display('course/searchForm.tpl');

    }
    //********************************************************* */
    // Metodo per visualizzare i risultati della ricerca dei corsi
    public function showSearchResults($coursesData, $messaggio)
    {
        //$this->smarty->assign('courses', $courses);     
        //echo 'courses: ' . $courses;
       //echo 'course:' . $courses[0]->getTitle();
       $this->smarty->assign('courses', $coursesData);
        //$this->smarty->assign('messaggio', $messaggio);
        
        // Mostra i risultati della ricerca
        // Assicurati che il template 'course/searchResults.tpl' esista e sia configurato correttamente 
       $this->smarty->display('course/searchResults.tpl');
    }

    public function showDetails($courseData)
    {
        // Qui dovresti recuperare i dettagli del corso dal model
        $this->smarty->assign('courses', $courseData);
        $this->smarty->display('course/courseDetails.tpl');
    }

    //********************************************************* */
    // Metodo per visualizzare il form di iscrizione a un corso





    public function showEnrollmentDetails($courseData, $userData)
    {
        // Assegna i dati del corso e dell'utente alla vista
        $this->smarty->assign('course', $courseData);
        $this->smarty->assign('user', $userData);
        
        // Mostra il template per il form di iscrizione
        $this->smarty->display('course/enrollmentDetails.tpl');
    }

    public function showEnrollForm($courseData)
    {
        $this->smarty->assign('course', $courseData);
        $this->smarty->display('course/enrollForm.tpl');
    }

    public function showManageForm($course_id)
    {
        $this->smarty->assign('course_id', $course_id);
        $this->smarty->display('course/manageForm.tpl');
    }

    public function showCreateForm()
    {
        $this->smarty->display('course/createForm.tpl');
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