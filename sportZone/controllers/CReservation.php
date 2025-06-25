<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

class CReservation{
  

  public static function reservationForm(){
    
    CUser::isLogged();
    
    $view = new VReservation();
    
    $fieldId = $_GET['fieldId'] ?? null;
    if (!$fieldId){ 
        $error = new VError();
        $error->show("ID non specificato.");
        return;
    }

     $date = $_GET['data'] ?? null;
    if (!$date) {
        $error = new VError();
        $error->show("Data non specificata.");
        return;
    }
     // Get available hours for this field and date through FReservation
    $avaiableHours = FReservation::getAvailableHours($fieldId, $date);

    $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    if (!$field) {
    $error = new VError();
        $error->show("Campo non trovato.");
        return;
    }
     
   
    $view->showReservationForm($field,$date,$avaiableHours); //da passare field, date e avaiablehours
  
    
 }

 public static function finalizeReservation() {
    CUser::isLogged();
    $userId = $_SESSION['user'] ?? null;

    // 1. Gestione callback da pagamento online
    if (isset($_GET['payment_status']) && $_GET['payment_status'] === 'success') {
        if (!isset($_SESSION['pending_reservation'])) {
            $error = new VError();
            $error->show("Nessuna prenotazione in sospeso.");
            return;
        }
        $pending = $_SESSION['pending_reservation'];

        $field = FPersistentManager::getInstance()->retriveFieldById($pending['field_id']);
        $client = FPersistentManager::getInstance()->retriveClientById($userId);

        if (!$field || !$client) {
            $error = new VError();
            $error->show("Dati prenotazione non validi.");
            return;
        }

        $payment = new EOnlinePayment();
        // se il gateway ti passa un id pagamento, lo puoi settare qui:
        // $payment->setPaymentGatewayId($_GET['payment_id'] ?? null);

        $dateObj = new DateTime($pending['date']);
        $timeObj = new DateTime($pending['time']);

        $reservation = new EReservation($dateObj, $timeObj, $field, $client, $payment);
        FPersistentManager::getInstance()->saveReservation($reservation);

        // Pulisci sessione
        unset($_SESSION['pending_reservation']);

        $view = new VReservation();
        $view->showConfirmation($reservation);
        return;
    }

    // 2. Gestione normale della funzione (riepilogo e creazione onsite/redirect online)

    // Get POST parameters
    $fieldId = $_POST['field_id'] ?? null;
    $date = $_POST['date'] ?? null;
    $time = $_POST['time'] ?? null;

    // Validate parameters
    if (!$fieldId) {
        $error = new VError();
        $error->show("ID non specificato.");
        return;
    }
    if (!$date) {
        $error = new VError();
        $error->show("Data non specificata.");
        return;
    }
    if (!$time) {
        $error = new VError();
        $error->show("Orario non specificato.");
        return;
    }

    $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    if (!$field) {
        $error = new VError();
        $error->show("Campo non trovato.");
        return;
    }

    $client = FPersistentManager::getInstance()->retriveClientById($userId);
    $fullName = $client->getName() . ' ' . $client->getSurname();

    // Se pagamento onsite: crea e salva subito
    if (isset($_POST['confirm']) && isset($_POST['paymentMethod'])) {
        if ($_POST['paymentMethod'] === 'onsite') {
            $dateObj = new DateTime($date);
            $timeObj = new DateTime($time);
            $payment = new EOnSitePayment();
            $reservation = new EReservation($dateObj, $timeObj, $field, $client, $payment);
            FPersistentManager::getInstance()->saveReservation($reservation);

            $view = new VReservation();
            $view->showConfirmation($reservation);
            return;
        } elseif ($_POST['paymentMethod'] === 'online') {
            // Salva dati in sessione e fai redirect a pagina pagamento online
            $_SESSION['pending_reservation'] = [
                'field_id' => $fieldId,
                'date' => $date,
                'time' => $time,
                'user_id' => $userId
            ];

            header("Location: /onlinepayment/payForm");
            exit;
        }
    }

    // Mostra pagina di riepilogo con scelta pagamento
    $view = new VReservation();
    $view->showFinalizeReservation($fullName, $date, $time, $field);
}


  
  public static function cancelReservation() {
    
    CUser::isLogged();
    $userId = $_SESSION['userId'] ?? null;

    // 3. Get POST parameter
    $reservationId = $_POST['id'] ?? null;

    // 4. Retrieve reservation from DB
    $reservation = null;
    if ($reservationId !== null && is_numeric($reservationId)) {
        $reservation = FPersistentManager::getInstance()->retriveObj(EReservation::class, intval($reservationId));
    }

   //  5. Check reservation exists
    if (!$reservation) {
        $errorView = new VError();
        $errorView->show("Prenotazione non trovata.");
        return;
    }

   //  6. Check user owns the reservation
    $client = $reservation->getClient();
    if (!$client || $client->getId() !== $userId) {
        $errorView = new VError();
        $errorView->show("Non sei autorizzato a cancellare questa prenotazione.");
        return;
    }

    // 7. If confirmed, delete and show confirmation
    if (isset($_POST['confirm'])) {
        FPersistentManager::getInstance()->deleteObj($reservation);
        $view = new VReservation();
        $view->showCancelConfirmation();
        return;
    }

    // 8. Otherwise, show cancellation form
    $view = new VReservation();
    $view->showCancelReservation($reservation);
 }
}
