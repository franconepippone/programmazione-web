<?php
require_once __DIR__ . "/../../vendor/autoload.php";

class CCourse {

    public static function createCourseForm($data = []) {
    CUser::isLogged();
    //CUser::isEmployee();

    $view = new VEmployee();
    $pm = FPersistentManager::getInstance();

    $instructors = $pm->retriveAllInstructors();
    $fields = $pm->retriveAllFields();

    $view->showCreateCourseForm($instructors, $fields, $data);
}
    //********************************************************* */
    
        

    public static function courseSummary() {
   // CUser::isEmployee();

    $view = new VEmployee();
    $pm = FPersistentManager::getInstance();

    try {
        $validated = UValidate::validateInputArray($_POST, self::$rulesCourse, true);

        // Validazione custom per orari (start < end)
        if ($validated['start_time'] >= $validated['end_time']) {
            throw new ValidationException("L'orario di inizio deve precedere quello di fine.");
        }

        // Recupera oggetti istruttore e campo
        $instructor = $pm->retriveInstructorById($validated['instructor']);
        $field = $pm->retriveFieldById($validated['field']);
        if (!$instructor || !$field) {
            throw new ValidationException("Istruttore o campo selezionato non valido.");
        }

        $validated['instructor'] = $instructor;
        $validated['field'] = $field;

        if ($validated['start_date'] instanceof DateTime) {
            $validated['start_date'] = $validated['start_date']->format('Y-m-d');
        }
        if ($validated['start_time'] instanceof DateTime) {
            $validated['start_time'] = $validated['start_time']->format('H:i');
        }
        if ($validated['end_time'] instanceof DateTime) {
            $validated['end_time'] = $validated['end_time']->format('H:i');
        }

        $validated['start_date'] = $validated['start_date'];
      
        $view->showCourseSummary($validated);

    } catch (ValidationException $e) {
        $msg = $e->getMessage();
        if (isset($e->details['params'])) {
            $msg .= "<br>Mancano i seguenti parametri: " . implode(', ', $e->details['params']);
        }
        (new VError())->show($msg);
    }
}

public static function finalizeCourse() {
    //CUser::isEmployee();

    $view = new VEmployee();
    $pm = FPersistentManager::getInstance();

    $data = $_POST;

    $instructor = $pm->retriveInstructorById($data['instructor']);
    $field = $pm->retriveFieldById($data['field']);

    $course = new ECourse();
    $course->setTitle($data['title']);
    $course->setDescription($data['description']);
    $course->setStartDate(new DateTime($data['start_date']));
    $course->setEndDate((new DateTime($data['start_date']))->modify('+2 months'));
    $course->setTimeSlot($data['start_time'] . '-' . $data['end_time']);
    $course->setDaysOfWeek($data['days']);
    $course->setEnrollmentCost(floatval($data['cost']));
    $course->setMaxParticipantsCount(intval($data['max_participants']));
    $course->setInstructor($instructor);
    $course->setField($field);

    $pm->saveCourse($course);

    $view->confirmCourse($course);
}


private static $rulesCourse = [
    'title'            => 'validateTitle',
    'description'      => 'validateDescription',
    'start_date'       => 'validateStartDate',
    'start_time'       => 'validateTime',
    'end_time'         => 'validateTime',
    'cost'             => 'validatePrice',
    'max_participants' => 'validateMaxParticipants',
    'days'             => 'validateDays',
    'instructor'       => 'validateInstructorId',
    'field'            => 'validateFieldId'
];
    //********************************************************* */
    //here starts Kevin's code, please do not modify it
    
    //form per cercare i corsi, anche con filtri
    public static function searchForm() {
        
        
        //fine creazione corsi fittizi

        $view = new VCourse();
        $view->showSearchForm();
    }

    
    public static function showCourses() {  
        
           
        try {       
            if(!empty($_GET)){
                $filteredParams = UValidate::validateInputArray($_GET, self::$rulesCourse,false);
                $courses = FPersistentManager::getInstance()->retriveCoursesOnAttributes($filteredParams);
            }
            else{
                $courses = FPersistentManager::getInstance()->retriveCourses();
            }
               
        } catch (Exception $e) {
            (new VError())->show("Errore durante il recupero dei corsi: " . $e->getMessage());
        }        

        $view = new VCourse();
        $view->showCourses($courses, 'I tuoi corsi');
        
    }

    //********************************************************* */
    // metodo per visualizzare i dettagli di un corso
    public static function courseDetails($course_id) {
       
        $course = FPersistentManager::retriveCourseOnId($course_id);
        $modifyPermission = false;
        echo CUser::isLoggedBool();
        if(CUser::isLoggedBool()) {
            $userID = USession::getSessionElement('user');

            $user = FPersistentManager::retriveUserOnId($userID);
            if(CUser::isClient()) {
                $modifyPermission = true;
                
            } 

        }
        
        $view = new VCourse();
        $view->showDetails( $course , $modifyPermission);
    }

    //********************************************************* */
   
    public static function MyCourses(){
        if (!CUser::isLoggedBool()) {
            (new VError())->show("Devi essere loggato per accedere a questa pagina.");
            return;
        }
        
        $user = CUser::getCurrentUser();
        if(Cuser::isInstructor()){
            $mycourses= FPersistentManager::getInstance()->retriveCoursesOnInstructorId($user->getId());
        }
        else if(Cuser::isClient()){
            $myenrollmens= FPersistentManager::getInstance()->retriveEnrollmentsOnUserId($user->getId());
            foreach ($myenrollmens as $enrollment) {
                $mycourses[] = $enrollment->getCourse();
            }
        }
        else{
            (new VError())->show("Devi essere un istruttore o un cliente per accedere a questa pagina.");
            return;
        }

        

        // Mostra la vista di gestione corsi istruttore
        $view = new VCourse();
        $view->showCourses($mycourses, 'I miei corsi');
    }

   

    
    
    
    
    



































    




    public static function modifyForm($course_id) {
        $course = FPersistentManager::getInstance()->retriveCourseOnId($course_id);

        $view = new VCourse();
        $view->showModifyCourseForm($course);
    }

    
    
    // metodo per serializzare un corso in un array
    
    
    




    
    

    




    

   
}


