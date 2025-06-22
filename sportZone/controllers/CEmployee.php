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
        if (!CUser::isLogged() || !CUser::isEmployee()) {
            $errorView = new VError();
            $errorView->show("Accesso negato. Solo il personale può visualizzare le prenotazioni.");
            return;
        }

        $name = trim(UHTTPMethods::get('client')) ?: null;
        $date = trim(UHTTPMethods::get('date')) ?: null;
        $sport = trim(UHTTPMethods::get('sport')) ?: null;

        $persistent = FPersistentManager::getInstance();

        if ($name && !$persistent->existsClientByPartialName($name)) {
            $errorView = new VError();
            $errorView->show("Nessun cliente trovato con quel nome.");
            return;
        }

        if ($sport && !$persistent->existsFieldBySport($sport)) {
            $errorView = new VError();
            $errorView->show("Nessun campo trovato per quello sport.");
            return;
        }

        $reservations = $persistent->retriveFilteredReservations($name, $date, $sport);

        if (empty($reservations)) {
            $errorView = new VError();
            $errorView->show("Nessuna prenotazione trovata per i criteri inseriti.");
            return;
        }

        $filters = ['client' => $name, 'date' => $date, 'sport' => $sport];

        $view = new VEmployee();
        $view->showReservations($reservations, $filters);
    }
} 
