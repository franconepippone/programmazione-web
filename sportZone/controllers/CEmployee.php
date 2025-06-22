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

        // Prendi i filtri da POST (o GET se preferisci, ma qui POST come vuoi)
        $name = $_POST['client'] ?? null;
        $date = $_POST['date'] ?? null;
        $sport = $_POST['sport'] ?? null;

        // Pulizia: trim e fallback a null se stringa vuota
        $name = ($name !== null && trim($name) !== '') ? trim($name) : null;
        $date = ($date !== null && trim($date) !== '') ? trim($date) : null;
        $sport = ($sport !== null && trim($sport) !== '') ? trim($sport) : null;

        $persistent = FPersistentManager::getInstance();

        // Verifica validità filtri, mostra primo errore e ritorna subito
        if ($name !== null && !$persistent->existsClientByPartialName($name)) {
            $errorView = new VError();
            $errorView->show("Nessun cliente trovato con quel nome.");
            return;
        }

        if ($sport !== null && !$persistent->existsFieldBySport($sport)) {
            $errorView = new VError();
            $errorView->show("Nessun campo trovato per quello sport.");
            return;
        }

        // Recupera prenotazioni in base ai filtri o tutte se nessun filtro
        if ($name === null && $date === null && $sport === null) {
            $reservations = $persistent->retriveAllReservations();
        } else {
            $reservations = $persistent->retriveFilteredReservations($name, $date, $sport);
        }

        if (empty($reservations)) {
            $errorView = new VError();
            $errorView->show("Nessuna prenotazione trovata per i criteri inseriti.");
            return;
        }

        $filters = ['client' => $name, 'date' => $date, 'sport' => $sport];

        $view = new VEmployee();
        $view->showReservations();// aggiungere reservations e filters
    }
 }
} 
