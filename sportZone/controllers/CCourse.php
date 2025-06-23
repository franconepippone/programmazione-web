<?php
require_once __DIR__ . "/../../vendor/autoload.php";

class CCourse {

    private static $attributi = ["title", "description", "timeSlot", "startDate", "endDate", "cost", "MaxParticipantsCount"];

     public static function createCourse() {
        // Qui puoi aggiungere la logica per salvare il corso (es. validazione, chiamata a un model, ecc.)
        $course = new ECourse();
        // Recupera i dati del corso dalla richiesta (ad esempio, $_POST)
        //valido i dati del corso
        // se non sono validi, mostro gli errori
        //$view = new VError();
        //$view->showError($errors);
        //altrimenti
        
        // Salva il corso nel database (qui dovresti chiamare un model per gestire la persistenza)
        
        $view = new VCourse();
        $view->showCreateResult();
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

/*        if(1==0){

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
                 $courses = FPersistentManager::getInstance()->retriveCoursesOnAttributes($filteredParams);
            }
        }    
        // Se non ci sono parametri di ricerca, prendo tutti i corsi
        else {
            $courses = FPersistentManager::getInstance()->retriveCourses();
        }*/

        //creo corsi fittizi per prova
        $courses = FPersistentManager::getInstance()->retriveCourses();
        
        $view->showSearchResults($courses,'ciao');
        
    }

    public static function courseDetail($course_id) {
        $course = FPersistentManager::retriveCourseOnId($course_id);

        $view = new VCourse();
        $view->showDetails($course);
    }

    public static function enrollForm($course_id) {
        //prendo l id dell utente dalla sessione
        $userID= USession::getSessionElement('user');
        FPersistentManager::retriveUserOnId($userID);

        $view = new VCourse();
        $view->showEnrollForm($course_id,$userID);
    }

    public static function manageForm($course_id) {
        $view = new VCourse();
        $view->showManageForm($course_id);
    }

    public static function createForm() {
        $view = new VCourse();
        $view->showCreateForm();
    }








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