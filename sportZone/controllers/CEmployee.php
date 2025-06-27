<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

class CEmployee{

    private static function assertRole(): string {
        $role = CUser::getUserRole();
        if ($role != EEmployee::class) {
            $verr = new VError();
            $verr->show("You have no access to this page.");
            exit;
        }
        return $role;
    }

    public static function profile(){
        CUser::isLogged();
        $role = self::assertRole();

        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showDashboardProfile($user, $role);
    
    }

    public static function manageCourses(){
        CUser::isLogged();
        $role = self::assertRole();
        
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showManageCourses($user, $role);
    }

    public static function manageFields(){
        CUser::isLogged();
        $role = self::assertRole();
        
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showManageFields($user, $role);
    }

    public static function manageReservations(){
        CUser::isLogged();
        $role = self::assertRole();
        
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showManageReservations($user, $role);
    }

    public static function manageUsers(){
        CUser::isLogged();
        $role = self::assertRole();
        
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showManageUsers($user, $role);
    }

    public static function settings(){
        CUser::isLogged();
        $role = self::assertRole();
        $view = new VDashboard();

        $user = CUser::getLoggedUser();
        $view->showDashboardSettings($user, $role);
    
    }

  
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




}
  

