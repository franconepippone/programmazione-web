<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

class CEmployee{

  public static function cancelReservation() {
     // 1. Check if user is logged in and is employee
     // if (!CUser::isLogged() || !CUser::isEmployee()) {
       //   $errorView = new VError();
        //  $errorView->show("Devi essere un dipendente per effettuare questa operazione.");
          //return;
      //}

    // 2. Get POST parameter (reservation id)
      $reservationId = $_POST['id'] ?? null;

    // 3. Retrieve reservation from DB
      $reservation = null;
      //if ($reservationId !== null && is_numeric($reservationId)) {
        //  $reservation = FPersistentManager::getInstance()->retriveObj(EReservation::class, intval($reservationId));
     // }

    // 4. Check reservation exists
     // if (!$reservation) {
       //   $errorView = new VError();
         // $errorView->show("Prenotazione non trovata.");
          //return;
      //}

    // 5. If confirmed, delete and show confirmation
      if (isset($_POST['confirm'])) {
        //  FPersistentManager::getInstance()->deleteObj($reservation);
          $view = new VEmployee();
          $view->showCancelConfirmation();
          return;
      }

    // 6. Otherwise, show cancellation form
      $view = new VEmployee();
      $view->showCancelReservation(); //aggiungere reservation
   }


       public static function showReservations() {
         
       // CUser::isEmployee();

        
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
    
    // CUser::isEmployee();

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
    $view->viewReservation();//dare reservation
 }

  public static function createCourseForm() {
    if (!CUser::isLogged()) {
        header("Location: /login");
        exit;
    }

    $view = new VEmployee();
    $pm = FPersistentManager::getInstance();

    $instructors = $pm->retriveAllInstructors();
    $fields = $pm->retriveAllFields();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = $_POST;

        $name = trim($data['name'] ?? '');
        if (empty($name)) {
            (new VError())->show("Il nome del corso è obbligatorio.");
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
        if (strtotime($startTime) >= strtotime($endTime)) {
            (new VError())->show("L'orario di inizio deve precedere l'orario di fine.");
            return;
        }

        $days = $data['days'] ?? [];
        if (!is_array($days) || count($days) === 0) {
            (new VError())->show("Seleziona almeno un giorno della settimana.");
            return;
        }

        $cost = $data['cost'] ?? '';
        if (!is_numeric($cost) || floatval($cost) < 0) {
            (new VError())->show("Inserisci un costo valido (numero positivo).");
            return;
        }

        $maxParticipants = $data['max_participants'] ?? '';
        if (!ctype_digit($maxParticipants) || intval($maxParticipants) < 1) {
            (new VError())->show("Inserisci un numero valido di partecipanti (intero positivo).");
            return;
        }

        $instructorId = $data['instructor'] ?? '';
        $instructor = $pm->retriveInstructorById($instructorId);
        if (!$instructor) {
            (new VError())->show("Istruttore selezionato non valido.");
            return;
        }

        $fieldId = $data['field'] ?? '';
        $field = $pm->retriveFieldById($fieldId);
        if (!$field) {
            (new VError())->show("Campo selezionato non valido.");
            return;
        }

        // Normalizza e salva i dati in sessione con nomi coerenti
        $courseData = [
            'name' => $name,
            'start_date' => $startDateStr,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'days' => $days,
            'cost' => floatval($cost),
            'max_participants' => intval($maxParticipants),
            'instructor' => $instructorId,
            'field' => $fieldId
        ];

        USession::setSessionElement('course_data', $courseData);
        header("Location: /employee/finalizeCreateCourse");
        exit;
    }

    $view->showCreateCourseForm(null, $instructors, $fields);
 }

public static function finalizeCreateCourse() {
    if (!CUser::isLogged()) {
        header("Location: /login");
        exit;
    }

    $view = new VEmployee();
    $pm = FPersistentManager::getInstance();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = USession::getSessionElement('course_data');

        if (!$data) {
            (new VError())->show("Dati del corso mancanti. Ricomincia la procedura.");
            return;
        }

        $course = new ECourse();
        $course->setTitle($data['name']);
        $course->setStartDate(new DateTime($data['start_date']));
        $course->setEndDate((new DateTime($data['start_date']))->modify('+2 months'));
        $course->setTimeSlot($data['start_time'] . '-' . $data['end_time']);
        $course->setDaysOfWeek($data['days']);
        $course->setEnrollmentCost($data['cost']);
        $course->setMaxParticipantsCount($data['max_participants']);

        $instructor = $pm->retriveInstructorById($data['instructor']);
        $field = $pm->retriveFieldById($data['field']);
        if (!$instructor || !$field) {
            (new VError())->show("Errore durante il recupero di istruttore o campo.");
            return;
        }

        $course->setInstructor($instructor);
        $course->setField($field);

        $pm->saveCourse($course);

        USession::unsetSessionElement('course_data');

        $view->showCourseConfirmation($course);
        return;
    }

    $data = USession::getSessionElement('course_data');
    if (!$data) {
        (new VError())->show("Nessun dato da finalizzare.");
        return;
    }

    $instructor = $pm->retriveInstructorById($data['instructor']);
    $field = $pm->retriveFieldById($data['field']);

    $view->showFinalizeCreateCourse($data, $instructor, $field);
 }
}

