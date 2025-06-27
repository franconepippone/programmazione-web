<?php
require_once __DIR__ . "/../../vendor/autoload.php";

class CCourse {


     private static $rulesCourse = [
        'title'            => 'validateTitle',
        'description'      => 'validateDescription',
        'start_date'       => 'validateStartDate',
        'end_date'         => 'validateEndDate',
        'start_time'       => 'validateTime',
        'end_time'         => 'validateTime',
        'cost'             => 'validatePrice',
        'max_participants' => 'validateMaxParticipants',
        'days'             => 'validateDays',
        'instructor'       => 'validateInstructorId',
        'field'            => 'validateFieldId'
    ];

    public static function createCourseForm($data = []) {
    CUser::isLogged();
    //CUser::isEmployee();

    $view = new VCourse();
    $pm = FPersistentManager::getInstance();

    $instructors = $pm->retriveAllInstructors();
    $fields = $pm->retriveAllFields();

    $view->showCreateCourseForm($instructors, $fields, $data);
}
    //********************************************************* */
    
        

    public static function courseSummary() {
   // CUser::isEmployee();

        $view = new VCourse();
        $pm = FPersistentManager::getInstance();

        try {
            $validated = UValidate::validateInputArray($_POST, self::$rulesCourse, true);

        // Validazione incrociata date
            if ($validated['end_date'] <= $validated['start_date']) {
                throw new ValidationException("La data di fine deve essere successiva a quella di inizio.");
            }

        // Validazione incrociata orari
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

           
            $validated['start_date'] = $validated['start_date']->format('Y-m-d');
            $validated['end_date'] = $validated['end_date']->format('Y-m-d');
            $validated['start_time'] = $validated['start_time']->format('H:i');
            $validated['end_time'] = $validated['end_time']->format('H:i');
            
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

        $view = new VCourse();
        $pm = FPersistentManager::getInstance();

        $data = $_POST;

        $instructor = $pm->retriveInstructorById($data['instructor']);
        $field = $pm->retriveFieldById($data['field']);

        $course = new ECourse();
        $course->setTitle($data['title']);
        $course->setDescription($data['description']);
        $course->setStartDate(new DateTime($data['start_date']));
        $course->setEndDate(new DateTime($data['end_date']));
        $course->setTimeSlot($data['start_time'] . '-' . $data['end_time']);
        $course->setDaysOfWeek($data['days']);
        $course->setEnrollmentCost(floatval($data['cost']));
        $course->setMaxParticipantsCount(intval($data['max_participants']));
        $course->setInstructor($instructor);
        $course->setField($field);

        $pm->saveCourse($course);

        $view->confirmCourse($course);
    }



    //************************************************************************** */
    //here starts Kevin's code, please do not modify it
    


    private static $rulesCourseKevin = [
        'title'                => 'validateTitle',
        'description'          => 'validateDescription',
        'startDate'            => 'validateStartDate',
        'endDate'              => 'validateDate', // oppure 'validateEndDate' se vuoi controllare rispetto a startDate
        'timeSlot'             => 'validateTimeSlot', // oppure crea un metodo specifico se vuoi validare il formato
        'daysOfWeek'           => 'validateDays',   // assicurati che arrivi come array
        'cost'                 => 'validatePrice',
        'MaxParticipantsCount' => 'validateMaxParticipants',
        'instructor'           => 'validateName',
        'field'                => 'validateFieldName'
    ];


    //form per cercare i corsi, anche con filtri
    /*public static function searchForm() {
        
        
        //fine creazione corsi fittizi

        $view = new VCourse();
        $view->showSearchForm();
    }*/

    
    public static function showCourses() {  
        
           
        try {       
                $courses = FPersistentManager::getInstance()->retriveCourses();               
        } catch (Exception $e) {
            (new VError())->show("Errore durante il recupero dei corsi: " . $e->getMessage());
        }        

        $view = new VCourse();
        $view->showCourses($courses, 'I tuoi corsi');
        
    }

    //********************************************************* */
    // metodo per visualizzare i dettagli di un corso
    public static function courseDetailsInstructor($course_id) {
        $user = CUser::getLoggedUser();
        
        $enrollmentsData = [];
        $course = FPersistentManager::retriveCourseOnId($course_id);
        $courseData= ECourse::courseToArray($course);
        $enrollments = FPersistentManager::retriveEnrollmentsOnCourseId($course_id);
        foreach($enrollments as $enrolled){
            $enrollmentsData = EEnrollment::enrollmentToArray($enrolled);
        }
        
    
        
        $view = new VCourse();
        $view->showDetailsInstrcutor( $course , $enrollmentsData);
    }

    //********************************************************* */

    

   

   public static function modifyForm($course_id) {
        $course = FPersistentManager::getInstance()->retriveCourseOnId($course_id);
        $user=CUser::getCurrentUser();
        $modifyPermission=true;
        if($course->getInstructor()->getId() !== $user->getId()){
            (new VError())->show("non possiedi i permessi per modificare questo corso");
            return;
        }
        $view = new VCourse();
        $view->showModifyCourseForm($course,$modifyPermission);
    }













    public static function finalizeModifyCourse($course_id) {
        $pm = FPersistentManager::getInstance();

        try {
            $attributes = UValidate::validateInputArray($_POST, self::$rulesCourseKevin, true);
            
            self::dateSlot($attributes['startDate'], $attributes['endDate']);
            //echo var_dump($attributes);
            //echo var_dump($_POST);
            // Validazione custom per orari (start < end)
        } catch (ValidationException $e) {
            $msg = $e->getMessage();
            $view = new VError();
            $view->show($msg);
            return;
        }


            // Recupera oggetti istruttore , campo e corso
        try{    
            $course = $pm->retriveCourseOnId($course_id);
            $instructor = CUser::getCurrentUser();
            $field = $pm->retriveFieldByAttribute('name',$attributes['field']);
            if (!$instructor || !$field || !$course) {
                $view = new VError();
                $view->show("errore durante il recupero dei dati: istruttore, campo o idcorso non valido.");
                return;  
            }
        } catch (Exception $e) {
            $view = new VError();
            $view->show("Si è verificato un errore imprevisto. Riprova più tardi.");
            return;
        }
        //echo "corso in aggiornamento";
            // Aggiorna il corso
            $course->setTitle($attributes['title']);
            $course->setDescription($attributes['description']);
            $course->setStartDate($attributes['startDate']);
            $course->setEndDate($attributes['endDate']);
            $course->setTimeSlot($attributes['timeSlot']);
            $course->setDaysOfWeek($attributes['daysOfWeek']);
            $course->setEnrollmentCost(floatval($attributes['cost']));
            $course->setMaxParticipantsCount(intval($attributes['MaxParticipantsCount']));
            $course->setInstructor($instructor);
            $course->setField($field);

            // Salva le modifiche
            $pm->saveCourse($course);

            $message='corso modificato con successo';
            $butt_name ="Vai ai miei corsi";
            $butt_action="window.location.href='/course/myCourses'";
            $view = new VError;
            $view->showSuccess($message, $butt_name,$butt_action);

    }

    private static function dateSlot($start, $end) {
        // Controlla che l'orario di inizio sia prima di quello di fine
        if ($start >= $end) {
            throw new ValidationException("La data di inizio deve essere prima della data di fine.");
        }
        return true;
    }
    // metodo per serializzare un corso in un array
    
    
    


}















