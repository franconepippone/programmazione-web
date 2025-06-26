<?php
require_once __DIR__ . "/../../vendor/autoload.php";

class CCourse {

    private static $attributi = ["title", "description", "timeSlot", "startDate", "endDate", "cost", "MaxParticipantsCount"];

    public static function createCourseForm() {
        CUser::isLogged();
        //CUser::isEmployee();  
      

        $view = new VCourse();
        $pm = FPersistentManager::getInstance();

        $instructors = $pm->retriveAllInstructors();
        $fields = $pm->retriveAllFields();

        $view->showCreateCourseForm($instructors, $fields);
}
    //********************************************************* */
    public static function finalizeCreateCourse() {
        //CUser::isEmployee();
        
        $data = $_POST;
        if (!isset($data['confirm'])) {

        
            $view = new VEmployee();
            $pm = FPersistentManager::getInstance();

            $title = trim($data['title'] ?? '');
            if (empty($title)) {
            (new VError())->show("Il titolo del corso è obbligatorio.");
            return;
            }

            $description = trim($data['description'] ?? '');
            if (empty($description)) {
            (new VError())->show("La descrizione del corso è obbligatoria.");
            return;
            }

            $startDateStr = $data['start_date'] ?? '';
            $startDate = DateTime::createFromFormat('Y-m-d', $startDateStr);
            $minStartDate = (new DateTime())->modify('+7 days');
            if (!$startDate || $startDate < $minStartDate) {
            (new VError())->show("La data di inizio deve essere almeno tra 7 giorni da oggi.");
            return;
            }

            $startTime = $data['start_time'] ?? '';
            $endTime = $data['end_time'] ?? '';
            if (strtotime($startTime) >= strtotime($endTime)){ 
            (new VError())->show("L'orario di inizio deve precedere quello di fine.");
            return;
            }

            $days = $data['days'] ?? [];
            if (!is_array($days) || count($days) === 0) {
            (new VError())->show("Seleziona almeno un giorno della settimana.");
            return;
            }

            $cost = $data['cost'] ?? '';
            if (!is_numeric($cost) || floatval($cost) < 0) {
            (new VError())->show("Inserisci un costo valido.");
            return;
            }

            $maxParticipants = $data['max_participants'] ?? '';
            if (!ctype_digit($maxParticipants) || intval($maxParticipants) < 1) {
            (new VError())->show("Numero partecipanti non valido.");
            return;
            }

            $instructorId = $data['instructor'] ?? '';
            $fieldId = $data['field'] ?? '';
            $instructor = $pm->retriveInstructorById($instructorId);
            $field = $pm->retriveFieldById($fieldId);
            if (!$instructor || !$field) {
            (new VError())->show("Istruttore o campo selezionato non valido.");
                return;
            }

            
            $view->showFinalizeCreateCourse($data, $instructor, $field);
            return;
        }
        

        
            $view = new VEmployee(); 
            $pm = FPersistentManager::getInstance();

            
            $course = new ECourse();
            $course->setTitle($data['title']);
            $course->setDescription($data['description']);
            $course->setStartDate(new DateTime($data['start_date']));
            $course->setEndDate((new DateTime($data['start_date']))->modify('+2 months'));
            $course->setTimeSlot($data['start_time'] . '-' . $data['end_time']);
            $course->setDaysOfWeek($data['days']);
            $course->setEnrollmentCost(floatval($data['cost']));
            $course->setMaxParticipantsCount(intval($data['max_participants']));

            $instructor = $pm->retriveInstructorById($data['instructor']);
            $field = $pm->retriveFieldById($data['field']);
            $course->setInstructor($instructor);
            $course->setField($field);

            $pm->saveCourse($course);
            $view->showCourseConfirmation($course);

        
    }
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


