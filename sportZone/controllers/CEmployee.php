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
        $errorMessages = [];

        if ($name && !$persistent->existsClientByPartialName($name)) {
            $errorMessages[] = "Nessun cliente trovato con quel nome.";
        }

        if ($sport && !$persistent->existsFieldBySport($sport)) {
            $errorMessages[] = "Nessun campo trovato per quello sport.";
        }

        if (count($errorMessages) > 1) {
            // Più errori specifici: messaggio generico
            $errorView = new VError();
            $errorView->show("Nessuna prenotazione trovata per i criteri inseriti.");
            return;
        } elseif (count($errorMessages) === 1) {
            // Un solo errore specifico: mostra quello
            $errorView = new VError();
            $errorView->show($errorMessages[0]);
            return;
        }

        $reservations = $persistent->retriveFilteredReservations($name, $date, $sport);

        if ($date && !$name && !$sport && empty($reservations)) {
            $errorView = new VError();
            $errorView->show("Nessuna prenotazione trovata per la data selezionata.");
            return;
        }

        if (($name || $sport || $date) && empty($reservations)) {
            $errorView = new VError();
            $errorView->show("Nessuna prenotazione trovata per i criteri inseriti.");
            return;
        }

    } else {
        // Nessun filtro: carica tutte le prenotazioni
        $reservations = $persistent->retriveFilteredReservations(null, null, null);
    }

    $view = new VEmployee();
    $view->showReservations($reservations, $filters, null);
 }
}
