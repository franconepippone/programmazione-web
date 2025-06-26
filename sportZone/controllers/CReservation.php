<?php 
require_once __DIR__ . "/../../vendor/autoload.php";

class CReservation{
  


    
    private static $rulesReservation = [
        'field_id' => 'validateFieldId',
        'date'     => 'validateReservationDate',
        'time'     => 'validateReservationTime',
        'user_id'  => 'validateId', 
    ];





    public static function test() {
        
        $entityManager = getEntityManager();
        $cl = $entityManager->find(EReservation::class, 1);
        echo $cl->getDate()->format('Y-m-d H:i:s') . "<br><br><br>";

        $em = FEntityManager::getInstance();
        echo ($em == null) ? "EntityManager is null" : "EntityManager loaded successfully.<br>";

        $item = $em->retriveObj(EReservation::class, 1);
        if ($item == null) {
            echo "Item not found.<br>";
        } else {
            echo "Item found: " . $item->getTime()->format('Y-m-d H:i:s') . "<br>";
        }

        // Test method for debugging
        $item = FEntityManager::getInstance()->retriveObj(EReservation::class, 1);
        print_r($item != null);
        echo "CReservation test method called.";
    }
  





    public static function reservationForm(){
    
        CUser::isLogged();
        $userId = $_SESSION['user'] ;

        try {
        
            UValidate::validateNoActiveReservation($userId);
    
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
            $view->showReservationForm($field,$date,$avaiableHours);
        
        } catch (ValidationException $e) {
            (new VError())->show($e->getMessage());
            return;
        }
    }

  





    public static function reservationSummary() {
        
        CUser::isLogged();
        $userId = $_SESSION['user'] ;
    
        $data = $_POST;
    
        $field = FPersistentManager::getInstance()->retriveFieldById($data['field_id']);
        $client = FPersistentManager::getInstance()->retriveClientById($userId);
        
        $fullName = $client->getName() . ' ' . $client->getSurname();

        $_SESSION['pending_reservation'] = [
            'field_id' => $data['field_id'],
            'date' => $data['date'],
            'time' => $data['time'],
            'user_id' => $userId,
            'cost' => $field->getCost()
            ];
        

        $view = new VReservation();
        $view->showReservationSummary($fullName, $data['date'], $data['time'], $field);
    }







    public static function finalizeReservation() { 
        CUser::isLogged();
        $userId = $_SESSION['user'] ?? null;

    
        if (!isset($_SESSION['pending_reservation'])) {
            (new VError())->show("Nessuna prenotazione in sospeso.");
            return;
        }

        $pending = $_SESSION['pending_reservation'];
        $paymentMethod = $_POST['paymentMethod'] ?? 'onsite';


        $field = FPersistentManager::getInstance()->retriveFieldById($pending['field_id']);
        $client = FPersistentManager::getInstance()->retriveClientById($userId);


        $dateObj = new DateTime($pending['date']);
        $timeObj = new DateTime($pending['time']);

        if ($paymentMethod === 'online') {
            $payment = new EOnlinePayment();
        } else {
            $payment = new EOnSitePayment();
        }

        $reservation = new EReservation($dateObj, $timeObj, $field, $client, $payment);
        FPersistentManager::getInstance()->saveReservation($reservation);

        unset($_SESSION['pending_reservation']);

        $view = new VReservation();
        $view->showConfirmation();
    }







    public static function myReservation() {
        
        CUser::isLogged();
        $clientId = $_SESSION['user'];
        $active = FPersistentManager::getInstance()->retriveActiveReservationByClientId($clientId);
        $view = new VReservation();
        if ($active !== null) {
            $view->showMyReservationDetail($active);
        } else {
            $view->showNoActiveReservation();
        }
    }







      public static function cancelInfo() {
        $view = new VReservation();
        $view->showCancelInfo();
    }








    public static function allReservations() {
        
        //CUser::isEmployee();
        
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




    

    public static function cancelReservation() {

       // CUser::isEmployee();

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
;
        FPersistentManager::getInstance()->removeReservation($reservation);

        $view = new VReservation();
        $view->showCancelConfirmation();
    }

}
