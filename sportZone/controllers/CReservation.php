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

 public static function finalizeReservation() {
    if (!CUser::isLogged()) return;

    $fieldId = $_POST['field_id'] ?? null;
    $date = $_POST['date'] ?? null;
    $time = $_POST['time'] ?? null;

    // Primo step: visualizza pagina riepilogo e scelta pagamento
    if (!isset($_POST['payment_method'])) {
        $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);
        $view = new VReservation();
        $view->showFinalizeReservation($field, $date, $time); // mostra la view per scegliere il pagamento
        return;
    }

    $paymentMethod = $_POST['payment_method'];
    $client = CUser::getUserLogged();
    $field = FPersistentManager::getInstance()->retriveFieldById($fieldId);

    if ($paymentMethod === 'onsite') {
        // Crea la reservation e reindirizza a conferma
        $reservation = new EReservation($date, $time, $client, $field);
        $payment = new EOnsitePayment($reservation);
        $reservation->setPayment($payment);

        FPersistentManager::getInstance()->storeReservation($reservation);
        header("Location: /reservation/confirm");
        exit;
    } elseif ($paymentMethod === 'online') {
        // Reindirizza alla pagina di pagamento online, passando i dati
        $query = http_build_query([
            'field_id' => $fieldId,
            'date' => $date,
            'time' => $time
        ]);
        header("Location: /payment/onlinePayment?$query");
        exit;
    }
}
}
