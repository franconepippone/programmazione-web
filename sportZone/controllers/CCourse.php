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
        CUser::isEmployee();
        
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
    //form per cercare i corsi, anche con filtri
    public static function searchForm() {
        
        
        //fine creazione corsi fittizi

        $view = new VCourse();
        $view->showSearchForm();
    }

    public static function showCourses() {     
        $view = new VCourse();
        
        /*try {
            $filteredParams = UValidate::validateInputArray($_POST, self::$attributi, false);
        } catch (ValidationException $e) {
            $viewErr = new VError();
            $viewErr->show($e->getMessage());
            exit;
        }
        
        print_r($_POST);
        print_r($filteredParams);

        //creo corsi fittizi per prova
        */
        $courses = FPersistentManager::getInstance()->retriveCourses();
        //per ogni corso estraggo i dati e li metto in un array
        $coursesData = [];
        foreach ($courses as $course) {
            $coursesData []= CCourse::courseToArray($course);
        }
        $view->showSearchResults($coursesData, 'ciao');
        
    }
    //********************************************************* */
    // metodo per visualizzare i dettagli di un corso
    public static function courseDetail($course_id) {
        $course = FPersistentManager::retriveCourseOnId($course_id);
        
        $coursesData [] = CCourse::courseToArray($course);

        $view = new VCourse();
        $view->showDetails( $coursesData);
    }

    //********************************************************* */
    // metodo per visualizzare il form di iscrizione ad un corso
    public static function enrollmentDetails($course_id) {
        CUser::isLogged();
        //prendo l id dell utente dalla sessione
        $userID = USession::getSessionElement('user');
        $user= FPersistentManager::retriveUserOnId($userID);
        $corso=FPersistentManager::getInstance()->retriveCourseOnId($course_id);
        
        $userData = CUser::userToArray($user);
        $courseData = CCourse::courseToArray($corso);
        $view = new VCourse();
        $view->showEnrollmentDetails($courseData,$userData);
    }

    //*********************************************************************************** */
    
    public static function enrollForm($course_id) {
        // Qui puoi aggiungere la logica per gestire l'iscrizione al corso
        // Ad esempio, recuperare i dati del corso e dell'utente, validare l'iscrizione, ecc.
        
        $course = FPersistentManager::getInstance()->retriveCourseOnId($course_id);
        //$userID = USession::getSessionElement('user');
        //$user = FPersistentManager::getInstance()->retriveUserOnId($userID);
        
        $courseData = CCourse::courseToArray($course);
        //$userData = CUser::userToArray($user);
        
        $view = new VCourse();
        $view->showEnrollForm($courseData);

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
    
    




    //*********************************************************** */
    // la validazione andrà in una classe separata di utilità, ma per ora la metto qui
    public static function validateCourse(array $courseData){
        // Qui puoi aggiungere la logica per validare i dati del corso
        $errors = [];
        //validazione titolo
        if (empty($CourseData['title'])) {
            $errors[] = "Il titolo del corso è obbligatorio.";
        }   
        if( strlen($courseData['title'])>255){
            $errors[] = "Il titolo del corso non può superare i 255 caratteri.";
        }

        //validazione descrizione
        if (empty($CourseData['description'])) {
            $errors[] = "La descrizione del corso è obbligatoria."; 
        }

        //validazione orario
        if (empty($courseData['timeSlot'])) {
            $errors[] = "L'orario del corso è obbligatorio.";
        } elseif (!preg_match('/^\d{2}:\d{2}-\d{2}:\d{2}$/', $courseData['timeSlot'])) {
            $errors[] = "L'orario deve essere nel formato HH:MM-HH:MM.";
        }
        //validazione date
        if (empty($courseData['startDate']) || empty($courseData['endDate'])) {
            $errors[] = "Le date di inizio e fine sono obbligatorie.";
        }
        if ($courseData['startDate'] >= $courseData['endDate']) {
            $errors[] = "La data di inizio non può essere successiva o uguale alla data di fine.";
        }
        //validazione costo
       if (empty($courseData['cost']) || !is_numeric($courseData['cost']) || $courseData['cost'] < 0) {
            $errors[] = "Il costo del corso deve essere un numero positivo.";
        }
        //validazione numero massimo di partecipanti   
        if (empty($courseData['MaxParticipantsCount']) || !is_numeric($courseData['MaxParticipantsCount']) || $courseData['MaxParticipantsCount'] <= 0) {
            $errors[] = "Il numero massimo di partecipanti deve essere un numero positivo.";
        }

        return $errors;

    }




    

   
}


/*if(!empty($_GET)) {
            // Se ci sono parametri di ricerca, li prendo
            $filteredParams = $_GET;
            echo 'filtri applicati' . $filteredParams;
            $paramskeys = array_keys($filteredParams);
            foreach ($paramskeys as $key) {
                // Rimuovo i parametri che non sono tra quelli definiti
                if (!in_array($key, self::$attributi)) {
                    unset($filteredParams[$key]);
                } else {
                    // Se il parametro è valido, lo filtro 
                    $filteredParams[$key] = htmlspecialchars(trim($filteredParams[$key]));
                }
            }
            //qui ho una array di parametri che possono richiamare i metodi di validazione
            //per validare i parametri di ricerca
            foreach ($paramskeys as $key) {
                $methodName = 'validate' . ucfirst($key); // Es: 'title' -> 'validateTitle'
            
                if (method_exists(self::class, $methodName)) {
                // Richiama il metodo statico passando il valore dell'attributo
                $error = UValidate::$methodName($filteredParams[$key]);
                    if ($error) {
                        $errors[] = $error; //gestione degli errori
                    }
                }
            }
           
            //non è necessario validare i dati ottenuti dal db, si presuppone che cìgià lo siano
            $courses = FPersistentManager::getInstance()->retriveCoursesOnAttributes($filteredParams);
        }
        // Se non ci sono parametri di ricerca, prendo tutti i corsi
        else {
            $courses = FPersistentManager::getInstance()->retriveCourses();
        }*/