<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

class CReservation{
  
  private static $rulesReservation = [
    'field_id' => 'validateFieldId',
    'date'     => 'validateReservationDate',
    'time'     => 'validateReservationTime',
    'user_id'  => 'validateClientId', 
];
  
  public static function reservationForm(){
    
    CUser::isLogged();
    
    $view = new VReservation();
    
    $fieldId = $_GET['fieldId'] ?? null;
    if (!$fieldId){ 
        $error = new VError();
        $error->show("ID non specificato.");
        return;
    }

     $date = $_GET['date'] ?? null;
    if (!$date) {
        $error = new VError();
        $error->show("Data non specificata.");
        return;
    }
     // Get available hours for this field and date through FReservation
    $avaiableHours = FPersistentManager::getInstance()->retriveAvaiableHoursForFieldAndDate($fieldId, $date);

    $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    if (!$field) {
    $error = new VError();
        $error->show("Campo non trovato.");
        return;
    }


    $view->showReservationForm($field,$date,$avaiableHours); //da passare field, date e availableHours
  
    
 }

  


 public static function reservationSummary() {
    CUser::isLogged();
    $userId = $_SESSION['user'] ;

    $data = $_POST;
    $data['user_id'] = $userId;
    $paymentMethod = $data['paymentMethod'] ?? null;
    unset($data['paymentMethod']);


    try {
        $validated = UValidate::validateInputArray($data, self::$rulesReservation, true);
        UValidate::validateNoActiveReservation($validated['user_id']);

        $field = FPersistentManager::getInstance()->retriveFieldById($validated['field_id']);
        $client = FPersistentManager::getInstance()->retriveClientById($validated['user_id']);
        $fullName = $client->getName() . ' ' . $client->getSurname();

        // Salva in sessione i dati della reservation se pagamento online
        if ($paymentMethod === 'online') {
            $_SESSION['pending_reservation'] = [
                'field_id' => $validated['field_id'],
                'date' => $validated['date'],
                'time' => $validated['time'],
                'user_id' => $userId,
                'cost' => $field->getCost()
            ];
        }

        $view = new VReservation();
        $view->showReservationSummary($fullName, $validated['date'], $validated['time'], $field, $paymentMethod, $userId);

    } catch (ValidationException $e) {
        (new VError())->show($e->getMessage());
        return;
    }
}
public static function finalizeOnsiteReservation() {
    CUser::isLogged();
    $userId = $_SESSION['user'] ?? null;

    // I dati sono già validati dal riepilogo
    $fieldId = $_POST['field_id'] ?? null;
    $date = $_POST['date'] ?? null;
    $time = $_POST['time'] ?? null;

    $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    $client = FPersistentManager::getInstance()->retriveClientById($userId);

    if (!$field || !$client || !$date || !$time) {
        (new VError())->show("Dati prenotazione non validi.");
        return;
    }

    $dateObj = new DateTime($date);
    $timeObj = new DateTime($time);

    $payment = new EOnSitePayment();
    $reservation = new EReservation($dateObj, $timeObj, $field, $client, $payment);
    FPersistentManager::getInstance()->saveReservation($reservation);

    $view = new VReservation();
    $view->showConfirmation($reservation);
}



public static function finalizeOnlineReservation() {
    CUser::isLogged();
    $userId = $_SESSION['user'] ?? null;

    // Controlla che ci siano dati in sessione
    if (!isset($_SESSION['pending_reservation'])) {
        (new VError())->show("Nessuna prenotazione in sospeso.");
        return;
    }

    $pending = $_SESSION['pending_reservation'];

    // (Opzionale: puoi validare di nuovo i dati qui)
    $field = FPersistentManager::getInstance()->retriveFieldById($pending['field_id']);
    $client = FPersistentManager::getInstance()->retriveClientById($userId);

    if (!$field || !$client) {
        (new VError())->show("Dati prenotazione non validi.");
        return;
    }

    $dateObj = new DateTime($pending['date']);
    $timeObj = new DateTime($pending['time']);

    $payment = new EOnlinePayment();
    $reservation = new EReservation($dateObj, $timeObj, $field, $client, $payment);
    FPersistentManager::getInstance()->saveReservation($reservation);

    unset($_SESSION['pending_reservation']);

    $view = new VReservation();
    $view->showConfirmation($reservation);
}




  public static function cancelReservation() {
    CUser::isLogged();

     $reservationId = $_POST['id'] ?? null;
    if (!$reservation) {
        (new VError())->show("Prenotazione non trovata.");
        return;
    }

    // Rimuovi l'associazione con l'utente
    $reservation->setClient(null);

    // Cancella la reservation
    FPersistentManager::getInstance()->deleteObj($reservation);

    (new VReservation())->showCancelConfirmation();
}


public static function myReservation() {
    CUser::isLogged();
   

    $clientId = $_SESSION['user'] ;
    
    
    // Recupera tutte le reservation dell'utente
    $reservations = FPersistentManager::getInstance()->retriveReservationsByClientId($clientId);
  
    $view = new VReservation();
    $view->showMyReservations($reservations);
}


public static function allReservations() {
    //CUser::isEmployee();

    // Recupera tutte le prenotazioni
    $reservations = FPersistentManager::getInstance()->retriveAllReservations();

    $view = new VReservation();
    $view->showAllReservations($reservations);
}

public static function reservationDetails() {
    //CUser::isEmployee();

    $reservationId = $_GET['id'] ?? null;
    if (!$reservationId) {
        (new VError())->show("ID prenotazione non specificato.");
        return;
    }

    $reservation = FPersistentManager::getInstance()->retriveReservationById($reservationId);
    if (!$reservation) {
        (new VError())->show("Prenotazione non trovata.");
        return;
    }

    $view = new VReservation();
    $view->showReservationDetails($reservation);
}
}