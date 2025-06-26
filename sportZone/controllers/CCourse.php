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

    public static function showCoursesOfInstructor() {  
        CUser::isLogged();
        $userID = USession::getSessionElement('user');

        try {
            if(CUser::isInstructor()) {
                $courses = FPersistentManager::getInstance()->retriveCoursesOnInstructorId($userID);
                $view = new VCourse();
                $view->showSearchResults($courses, 'I tuoi corsi');
            }
        } catch (Exception $e) {
            (new VError())->show("Errore durante il recupero dei corsi: " . $e->getMessage());
        }
        
    }

    public static function showCourses() {  
        
           
        try {       
            if(!empty($_GET)){
                $filteredParams = UValidate::validateInputArray($_GET, self::$attributi,false);
                $courses = FPersistentManager::getInstance()->retriveCoursesOnAttributes($filteredParams);
            }
            else{
                $courses = FPersistentManager::getInstance()->retriveCourses();
            }
               
        } catch (Exception $e) {
            (new VError())->show("Errore durante il recupero dei corsi: " . $e->getMessage());
        }        

        $view = new VCourse();
        $view->showSearchResults($courses, 'I tuoi corsi');
        
    }
    //********************************************************* */
    // metodo per visualizzare i dettagli di un corso
    public static function courseDetail($course_id) {
        $course = FPersistentManager::retriveCourseOnId($course_id);
        $modifyPermission = false;
        if(USession::isSetSessionElement('user') === true) {
            $userID = USession::getSessionElement('user');
            
            $user= FPersistentManager::retriveUserOnId($userID);
            if(CUser::isClient()) {
                $modifyPermission = true;
            } 
        }
        
        
         
        $view = new VCourse();
        $view->showDetails( $course , $modifyPermission);
    }

    //********************************************************* */
    // metodo per visualizzare il form di iscrizione ad un corso
    public static function enrollmentDetails($course_id) {
        CUser::isLogged();
        //prendo l id dell utente dalla sessione
        $userID = USession::getSessionElement('user');
        $user= FPersistentManager::retriveUserOnId($userID);
        $course=FPersistentManager::getInstance()->retriveCourseOnId($course_id);
        
        
        $view = new VCourse();
        $view->showEnrollmentDetails($course,$user);
    }

    //*********************************************************************************** */
    
    public static function enrollForm($course_id) {
        
        $course = FPersistentManager::getInstance()->retriveCourseOnId($course_id);
        $view = new VCourse();
        $view->showEnrollForm($course);

    }
    
    
    
    public static function manageForm($course_id) {

        $view = new VCourse();
        $view->showManageForm($course_id);
    }

    public static function createForm() {
        $view = new VCourse();
        $view->showCreateForm();
    }
    public static function daysToString(array $daysOfWeek) {
        $days = '';
        foreach ($daysOfWeek as $day) {
            // Converti l'oggetto DayOfWeek in una stringa
            $days .= $day . ', ';
        }
        return rtrim($days, ', '); // Rimuove l'ultima virgola e spazio
    }
    // metodo per serializzare un corso in un array
    
    
    public static function manageMyCourses()
    {
        if (!CUser::isLogged()) {
            (new VError())->show("Devi essere loggato per accedere a questa pagina.");
            return;
        }
        if (CUser::isInstructor()) {
            (new VError())->show("Devi essere un istruttore per accedere a queste funzionalità.");
            return;
        }

        
        $userID = USession::getSessionElement('user');
        $courses = FPersistentManager::getInstance()->retriveCoursesByInstructor($userID);
        

        // Mostra la vista di gestione corsi istruttore
        $view = new Vcourse();
        $view->showCourses($courses, $userID, 'I tuoi corsi');
    }


}

    
    

    


    

    

   



