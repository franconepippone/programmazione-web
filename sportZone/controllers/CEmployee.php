<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

class CEmployee{
/**
  public static function cancelReservation() {
     //  Check if user is logged in and is employee
      CUser::isLogged();
      CUser::isEmployee();
      

      //Get POST parameter (reservation id)
      //$reservationId = $_POST['id'] ?? null;

    //  Retrieve reservation from DB
      $reservation = null;
      if ($reservationId !== null && is_numeric($reservationId)) {
          $reservation = FPersistentManager::getInstance()->retriveObj(EReservation::class, intval($reservationId));
      }

    //  Check reservation exists
      if (!$reservation) {
          $errorView = new VError();
          $errorView->show("Prenotazione non trovata.");
          return;
      }

    //  If confirmed, delete and show confirmation
      if (isset($_POST['confirm'])) {
          FPersistentManager::getInstance()->deleteObj($reservation);
          $view = new VEmployee();
          $view->showCancelConfirmation();
          return;
      }

    // 6. Otherwise, show cancellation form
      $view = new VEmployee();
      $view->showCancelReservation($reservation); 
   }


       public static function showReservations() {
         
        CUser::isEmployee();

        
        $hasFilter = !empty($_POST);

        $name = $_POST['client'] ?? null;
        $date = $_POST['date'] ?? null;
        $sport = $_POST['sport'] ?? null;

        $name = ($name !== null && trim($name) !== '') ? trim($name) : null;
        $date = ($date !== null && trim($date) !== '') ? trim($date) : null;
        $sport = ($sport !== null && trim($sport) !== '') ? trim($sport) : null;

        $persistent = FPersistentManager::getInstance();

        $filters = ['client' => $name ?? '', 'date' => $date ?? '', 'sport' => $sport ?? ''];
        $message = null;
        $reservations = [];
        if ($hasFilter) {
            // Validazioni filtri e raccolta messaggi di errore

            if ($name && !$persistent->existsClientByPartialName($name)) {
                $errorMessages[] = "Nessun cliente trovato con quel nome.";
            }

            if ($sport && !$persistent->existsFieldBySport($sport)) {
                $errorMessages[] = "Nessun campo trovato per quello sport.";
            }

            if ($date) {
                // Verifico se esistono prenotazioni almeno per quella data
                $reservationsForDate = $persistent->retriveFilteredReservations(null, $date, null);
                if (empty($reservationsForDate)) {
                    $errorMessages[] = "Nessuna prenotazione trovata per la data selezionata.";
                }
            }

            // Gestione messaggi di errore in base al numero di errori
            if (count($errorMessages) > 1) {
                $errorView = new VError();
                $errorView->show("Nessuna prenotazione rispetta i criteri inseriti.");
                return;
            } elseif (count($errorMessages) === 1) {
                $errorView = new VError();
                $errorView->show($errorMessages[0]);
                return;
            }

            // Se nessun errore, carico le prenotazioni filtrate con tutti i criteri
            $reservations = $persistent->retriveFilteredReservations($name, $date, $sport);

            // Se nessuna prenotazione trovata con i filtri, messaggio generico
            if (empty($reservations)) {
                $errorView = new VError();
                $errorView->show("Nessuna prenotazione trovata per i criteri inseriti.");
                return;
            }

        } else {
            // Nessun filtro: prendo tutte le prenotazioni
            $reservations = $persistent->retriveFilteredReservations(null, null, null);
        }

        // Mostro la view con risultati e filtri (messaggi errori gestiti sopra)
        $view = new VEmployee();
        $view->showReservations($reservations, $filters, null);
    }

  public static function viewReservation() {
    
     CUser::isEmployee();

    $id = $_POST['id'] ?? null;

    if ($id === null) {
        $errorView = new VError();
        $errorView->show("ID prenotazione mancante.");
        return;
    }

    $reservation = FPersistentManager::getInstance()->retriveReservationById($id);

    if ($reservation === null) {
        $errorView = new VError();
        $errorView->show("Prenotazione non trovata.");
        return;
    }

    $view = new VEmployee();
    $view->viewReservation($reservation);
 }
**/
public static function createCourseForm($data = []) {
    CUser::isLogged();
    //CUser::isEmployee();

    $view = new VEmployee();
    $pm = FPersistentManager::getInstance();

    $instructors = $pm->retriveAllInstructors();
    $fields = $pm->retriveAllFields();

    $view->showCreateCourseForm($instructors, $fields, $data);
}

public static function courseSummary() {
   // CUser::isEmployee();

    $view = new VEmployee();
    $pm = FPersistentManager::getInstance();

    try {
        $validated = UValidate::validateInputArray($_POST, array_keys(self::$rulesCourse), true);

        // Validazione custom per orari (start < end)
        if (strtotime($validated['start_time']) >= strtotime($validated['end_time'])) {
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

        $validated['start_date'] = $validated['start_date'];
      
        $view->showCourseSummary($validated);

    } catch (ValidationException $e) {
        (new VError())->show($e->getMessage());
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

    $view->confirmReservation($course);
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
}


