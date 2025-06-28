<?php
require_once __DIR__ . "/../../vendor/autoload.php";

class CCourse {


     private static $rulesCourse = [
        'title'            => 'validateTitle',
        'description'      => 'validateDescription',
        'start_date'       => 'validateStartDate',
        'end_date'         => 'validateEndDate',
        'cost'             => 'validatePrice',
        'max_participants' => 'validateMaxParticipants',
        'days'             => 'validateDays',
        'instructor'       => 'validateInstructorId',
        'field'            => 'validateFieldId'
    ];

   
    //********************************************************* */
    
    public static function createCourseForm($data = []) {
    
        CUser::isEmployee();
        $view = new VCourse();
  
        $pm = FPersistentManager::getInstance();

        $instructors = $pm->retriveAllInstructors();
        $fields = $pm->retriveAllFields();

        $view->showCreateCourseForm($instructors, $fields, $data); 
  }


    public static function courseSummary() {
       
        CUser::isEmployee();

        $view = new VCourse();
        $pm = FPersistentManager::getInstance();
        $post=$_POST;

        try {
            $validated = UValidate::validateInputArray($post, self::$rulesCourse, true);

        // Validazione incrociata date
            if ($validated['end_date'] <= $validated['start_date']) {
                throw new ValidationException("La data di fine deve essere successiva a quella di inizio.");
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

            $datas = UUtility::getDatesForWeekdays($validated['days'], new DateTime($validated['start_date']), new DateTime($validated['end_date']));
            $possiblehours= UUtility::getCommonAvailableStartTimesForDuration($field, $datas, $post['duration']); 

            $validated['duration'] = $post['duration'];
            $view->showCourseSummary($validated, $possiblehours);

        } catch (ValidationException $e) {
            $msg = $e->getMessage();
            if (isset($e->details['params'])) {
              //  $msg .= "<br>Mancano i seguenti parametri: " . implode(', ', $e->details['params']);
            }
            (new VError())->show($msg);
        }
         
    }

    public static function finalizeCourse() {
        //CUser::isEmployee();

        $view = new VCourse();
        $pm = FPersistentManager::getInstance();
        $data = $_POST;

        $startTimeStr = $data['start_time'];    
        $duration = intval($data['duration']);
        $startTime = DateTime::createFromFormat('H:i:s', $startTimeStr);
        $endTime = (clone $startTime)->modify("+{$duration} hours");



        $instructor = $pm->retriveInstructorById($data['instructor']);
        $field = $pm->retriveFieldById($data['field']);

        $course = new ECourse();
        $course->setTitle($data['title']);
        $course->setDescription($data['description']);
        $course->setStartDate(new DateTime($data['start_date']));
        $course->setEndDate(new DateTime($data['end_date']));
        $course->setTimeSlot($startTime->format('H:i') . '-' . $endTime->format('H:i'));
        $course->setDaysOfWeek($data['days']);
        $course->setEnrollmentCost(floatval($data['cost']));
        $course->setMaxParticipantsCount(intval($data['max_participants']));
        $course->setInstructor($instructor);
        $course->setField($field);

        $pm->saveCourse($course);


        $datas= UUtility::getDatesForWeekdays($data['days'], new DateTime($data['start_date']), new DateTime($data['end_date']));

        UUtility::generateAndSaveCourseReservations($datas, $data['start_time'], $duration, $field,$instructor);
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

    public static function courseDetails($course_id) {
    
        try {       
            $course = FPersistentManager::retriveCourseOnId($course_id);              
        } catch (Exception $e) {
            (new VError())->show("Errore durante il recupero dei corsi: " . $e->getMessage());
        } 
        
        
       
        //echo $enrollments[0]->getDate();
       
    
        
        $view = new VCourse();
        $view->showCourseDetails( $course );
    }

    //********************************************************* */
    // metodo per visualizzare i dettagli di un corso
    
    //********************************************************* */

    

   

   public static function modifyForm($course_id) {
        $course = FPersistentManager::getInstance()->retriveCourseOnId($course_id);
        $user=CUser::getLoggedUser();
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
            
            UUtility::dateSlot($attributes['startDate'], $attributes['endDate']);
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
            $instructor = CUser::getLoggedUser();
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
            $butt_action="window.location.href='/dashboard/myCourses'";
            $view = new VError;
            $view->showSuccess($message, $butt_name,$butt_action);

    }












////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////






    

    


}















