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
    //form per cercare i corsi, anche con filtri
    public static function searchForm() {
        $view = new VCourse();
        $view->showSearchForm();
    }

    public static function showCourses() {     
        $view = new VCourse();
        if(!empty($_GET)) {
            // Se ci sono parametri di ricerca, li prendo
            $filteredParams = $_GET;
            $paramskeys = array_keys($filteredParams);
            // Controllo che i parametri siano validi
            foreach ($paramskeys as $key) {
                if (!in_array($key, self::$attributi)) {
                    // Se un parametro non è valido, lo rimuovo
                    unset($filteredParams[$key]);
                }
            }
            
            
            /*
            *
            *valido i dati
            *
            */
            
            $courses = FPersistentManager::getInstance()->retriveCoursesOnAttributes($filteredParams);
        }
        // Se non ci sono parametri di ricerca, prendo tutti i corsi
        else {
            $courses = FPersistentManager::getInstance()->retriveCourses();
        }
        $view->showSearchResults($courses);
        
    }

    public static function courseDetail($course_id) {
        $view = new VCourse();
        $view->showDetails($course_id);
    }

    public static function enrollForm($course_id) {
        $view = new VCourse();
        $view->showEnrollForm($course_id);
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