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
               $msg .= ''. $e->details[''] .'';
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





    
    public static function showCourses() {  
        $role = CUser::getUserRole();
           
        try {       
                $courses = FPersistentManager::getInstance()->retriveCourses();               
        } catch (Exception $e) {
            (new VError())->show("Errore durante il recupero dei corsi: " . $e->getMessage());
        }        

        $view = new VCourse();
        $view->showCourses($courses, $role);
        
    }

    public static function courseDetails($course_id) {
    
        try {       
            $course = FPersistentManager::retriveCourseOnId($course_id);              
        } catch (Exception $e) {
            (new VError())->show("Errore durante il recupero dei corsi: " . $e->getMessage());
        } 
       
        $view = new VCourse();
        $view->showCourseDetails( $course );
    }



    public static function deleteCourse($course_id) {
        CUser::isEmployee();
        try {
            // Controlla se il corso esiste
            $course = FPersistentManager::retriveCourseOnId($course_id);
            if ($course === null) {
                throw new Exception("Corso non trovato.");
            }
            $course = FPersistentManager::retriveCourseOnId($course_id);
            if ($course === null) {
                throw new Exception("Corso non trovato.");
            }
            FPersistentManager::getInstance()->removeCourse($course);
       
            $reservations=UUtility::getReservationsOfCourse($course);
            foreach ($reservations as $reservation) {
                FPersistentManager::getInstance()->removeReservation($reservation);
            }
            (new VError())->showSuccess("Corso eliminato con successo.",'Torna alla homepage',"window.location.href='/user/home'");
        
        } catch (Exception $e) {
            (new VError())->show('Impossibile eliminare correttamente il corso.');
            return;
        }
       
        
    }

    

   

   







    



}















