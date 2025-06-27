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

            $datas = self::getDatesForWeekdays($validated['days'], new DateTime($validated['start_date']), new DateTime($validated['end_date']));
            $available_hours = $pm->retriveCommonAvaiableHours($field->getId(), $datas);
            $view->showCourseSummary($validated, $available_hours);

             
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

        if (self::Dateslot($data['start_date'], $data['end_date']) === false) {
            (new VError())->show("La data di inizio deve essere prima della data di fine.");
            return;
        }

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

        for ($hour = $data['start_time']; $hour <= $data['end_time']; $hour++) {
            // Logica per gestire le ore disponibili, se necessario
        }
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
       
        $course = FPersistentManager::retriveCourseOnId($course_id);
        $modifyPermission = false;
        if(CUser::isLoggedBool()) {
            $role = CUser::getUserRole();

            if(!CUser::isClient()) {
                $modifyPermission = true;    
            } 

            

        }
        
        $view = new VCourse();
        $view->showDetails( $course , $modifyPermission);
    }

    //********************************************************* */

    public static function myCourses(){
        if (!CUser::isLoggedBool()) {
            (new VError())->show("Devi essere loggato per accedere a questa pagina.");
            return;
        }
        
        $user = CUser::getCurrentUser();
        $userRole='Client';

        if(Cuser::isInstructor()){
            $mycourses= FPersistentManager::getInstance()->retriveCoursesOnInstructorId($user->getId());
            
            $userRole='Instructor';
            
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
        $view->showCourses($mycourses, $userRole);
    }

   

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
    
    
    






    public static function getDatesForWeekdays(array $weekdaysItalian, DateTime $startDate, DateTime $endDate): array {
        $mapDays = [
            'Lunedì'    => 'Monday',
            'Martedì'   => 'Tuesday',
            'Mercoledì' => 'Wednesday',
            'Giovedì'   => 'Thursday',
            'Venerdì'   => 'Friday',
            'Sabato'    => 'Saturday',
            'Domenica'  => 'Sunday',
        ];

        $allDates = [];

        foreach ($weekdaysItalian as $weekdayItalian) {
            if (!isset($mapDays[$weekdayItalian])) {
                // Giorno non valido, salta o gestisci errore
                continue;
            }

            $weekdayEnglish = $mapDays[$weekdayItalian];

            // Trova la prima data di questo giorno
            $current = clone $startDate;
            $current->modify('next ' . $weekdayEnglish);

            // Se startDate è già quel giorno, includilo
            if ($startDate->format('l') === (new DateTime($weekdayEnglish))->format('l')) {
                $current = clone $startDate;
            }

            // Aggiungi tutte le date per questo giorno
            while ($current <= $endDate) {
                $allDates[] = $current->format('Y-m-d');
                $current->modify('+1 week');
            }
        }

        sort($allDates);

        return $allDates;
    }


}















