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


     //Shows the form to create a new course
    public static function createCourseForm($data = []) {
    
        CUser::isEmployee();

        $view = new VCourse();
  
        $pm = FPersistentManager::getInstance();

        $instructors = $pm->retriveAllInstructors();
        $fields = $pm->retriveAllFields();

        $view->showCreateCourseForm($instructors, $fields, $data); 
    }

    // Function to handle the course creation summary
    // It validates the input data, retrieves necessary objects, and shows the course summary
    public static function courseSummary() {
       
        CUser::isEmployee();

        $view = new VCourse();
        $pm = FPersistentManager::getInstance();
        $post=$_POST;

        try {
            $validated = UValidate::validateInputArray($post, self::$rulesCourse, true);
            UValidate::dateSlot(new DateTime($validated['start_date']), new DateTime($validated['end_date']));

            $instructor = $pm->retriveInstructorById($validated['instructor']);
            $field = $pm->retriveFieldById($validated['field']);
       
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
            if (count($e->details) > 0) {
                $msg .= "<br>Dettagli di validazione: " . implode(", ", $e->details);
            }
            (new VError())->show($msg);
        }
         
    }


    // Function to finalize the course creation
    // It retrieves the data from the POST request, creates a new course object, saves it
    public static function finalizeCourse() {
        
        CUser::isEmployee();

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


    // Function to show the list of courses
    // It retrieves the courses from the persistent manager and displays them using the view
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



    // Function to show the details of a specific course
    // It retrieves the course by its ID and displays its details using the view
    public static function courseDetails($course_id) {
    
        try {       
            $course = FPersistentManager::retriveCourseOnId($course_id);              
        } catch (Exception $e) {
            (new VError())->show("Errore durante il recupero dei corsi: " . $e->getMessage());
        } 
 
        $view = new VCourse();
        $view->showCourseDetails( $course );
    }




    // Function to delete a course
    // It checks if the course exists, removes it from the persistent manager, and deletes its
    public static function deleteCourse($course_id) {
        CUser::isEmployee();
        try {
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
            (new VError())->showSuccess("Corso eliminato con successo.");
        
        } catch (Exception $e) {
            (new VError())->show('Impossibile eliminare correttamente il corso.');
            return;
        }
       
        
    }

    



}















