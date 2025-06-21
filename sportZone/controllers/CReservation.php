<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

class CReservation{

  public static function reservationForm(){

     if (!CUser::isLogged()) {
            return;
        }
    
    $view = new VReservation();
    
    //$fieldId = UHTTPMethods::get('fieldId');
    //if (!$fieldId) {
       // VError::show("ID del campo non specificato.");
        //return;
    
    //$field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
    //if (!$field) {
       // VError::show("Campo non trovato.");
        //return;
   
    // Get available hours for this field and date through FReservation
    //$availableHours = FReservation::getAvailableHours($fieldId, $date);
    //$date = UHTTPMethods::get('date') ?? (new DateTime())->format('Y-m-d');
    
    $view->showReservationForm();
  
  }

ublic static function finalizeReservation() {
    // Step 1: Get GET parameters safely, evitando warning PHP su chiavi mancanti
    $fieldId = isset($_GET['field_id']) ? UHTTPMethods::get('field_id') : null;
    $date = isset($_GET['date']) ? UHTTPMethods::get('date') : null;
    $time = isset($_GET['time']) ? UHTTPMethods::get('time') : null;

    // Step 2: Check request method POST per metodo pagamento
    $paymentMethod = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $paymentMethod = isset($_POST['payment_method']) ? UHTTPMethods::post('payment_method') : null;
    }

    // Step 3: Recupera il campo dal DB o passa null
    $field = null;
    if ($fieldId !== null) {
        $pm = FPersistentManager::getInstance();
        $field = $pm->load('EField', $fieldId);
    }

    // Step 4: Se POST e metodo di pagamento è onsite -> crea prenotazione e redirect a conferma
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $paymentMethod === 'onsite') {
        // Supponiamo che id cliente venga da sessione, esempio:
        $clientId = 1; // devi cambiare con il metodo corretto per recuperare cliente loggato
        $pm = FPersistentManager::getInstance();

        $reservation = new EReservation();
        $reservation->setField($field);
        $reservation->setDate($date);
        $reservation->setTime($time);
        $reservation->setClientId($clientId);

        // Salva prenotazione nel DB
        $pm->save($reservation);

        // Redirect alla pagina di conferma
        header('Location: /reservation/confirmation');
        exit();
    }

    // Step 5: Se POST e metodo pagamento online -> redirect pagina pagamento online con GET params
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $paymentMethod === 'online') {
        // Costruisci url con parametri
        $url = '/onlinepayment/payForm?field_id=' . urlencode($fieldId) 
               . '&date=' . urlencode($date) 
               . '&time=' . urlencode($time);

        header('Location: ' . $url);
        exit();
    }

    // Step 6: Altrimenti mostra pagina di riepilogo con dati o placeholder

    $vReservation = new VReservation();
    $vReservation->showFinalizeReservation($field, $date, $time);
}
}
