<?php 

use Smarty\Compile\Tag\Capture;
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
            $avaiableHours = UUtility::retriveAvaiableHoursForFieldAndDate($fieldId, $date);

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
        $client = FPersistentManager::getInstance()->retriveUserById($userId);
        
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


    public static function startPaymentReservation() {
        CUser::isLogged();

        // TODO CHECK IF THERE IS PENDING RESERVATION
        $cost = $_SESSION['pending_reservation']['cost'];
        CPayment::startPayment((string)$cost, '/reservation/finalizeReservation');
    }


    public static function finalizeReservation() { 
        CUser::isLogged();
        $userId = $_SESSION['user'] ?? null;

        $outcome = CPayment::getPaymentOutcome();
        if (!isset($outcome)) {
            (new VError())->show("Errore con il pagamento.");
            return;
        }



        if (!isset($_SESSION['pending_reservation'])) {
            (new VError())->show("Nessuna prenotazione in sospeso.");
            return;
        }

        $pending = $_SESSION['pending_reservation'];

        $field = FPersistentManager::getInstance()->retriveFieldById($pending['field_id']);
        $client = FPersistentManager::getInstance()->retriveUserById($userId);


        $dateObj = new DateTime($pending['date']);
        $timeObj = new DateTime($pending['time']);

        switch ($outcome['type']) {
            case CPayment::METHOD_ONLINE:
                $payment = new EOnlinePayment();
                break;
            case CPayment::METHOD_ONSITE:
                $payment = new EOnSitePayment();
                break;
            default:
                (new VError())->show("Metodo di pagamento invalido");
                exit;
        }
        if ($outcome['type'] === CPayment::METHOD_ONLINE) {
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







   




      public static function cancelInfo() {
        $view = new VReservation();
        $view->showCancelInfo();
    }






    public static function reservationDetails() {
        
        CUser::isEmployee();

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

        CUser::isEmployee();

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

        $field = $reservation->getField();
        
        $view = new VReservation();
        $view->showCancelReservation($reservation,$field);
    }
    

    public static function finalizeCancelReservation() {
        CUser::isEmployee();

        $reservationId = $_POST['id'] ?? null;
        if (!$reservationId) {
            (new VError())->show("ID prenotazione non specificato.");
            return;
        }

        $reservation = FPersistentManager::getInstance()->retriveReservationById($reservationId);

        FPersistentManager::getInstance()->removeReservation($reservation);

        $view = new VReservation();
        $view->showCancelConfirmation();
    }




    
    public static function modifyReservation() {
        $reservationId = $_GET['id'] ?? null;
        if (!$reservationId) {
            (new VError())->show("ID prenotazione non specificato.");
            return;
        }

        $reservation = FPersistentManager::getInstance()->retriveReservationById($reservationId);

        $view = new VReservation();
        $view->showModifyForm($reservation);
    }







    public static function modifyReservationDate() {
        $reservationId = $_POST['id'] ?? null;
        if (!$reservationId) {
            (new VError())->show(
    "ID prenotazione non specificato.",
    "Torna indietro",
    "location.href='/reservation/mngReservations'"
);
            return;
        }

        $reservation = FPersistentManager::getInstance()->retriveReservationById($reservationId);

        $view = new VReservation();
        $view->showModifyDateForm($reservation);
    }






    public static function modifyReservationTime() {
        $reservationId = $_POST['id'] ?? ($_POST['id'] ?? null);
        $newDate = $_POST['date'] ?? null;

        $reservation = FPersistentManager::getInstance()->retriveReservationById($reservationId);

        $user = $reservation->getUser();
        if ($user->getType()=='client'){
            try {
                $newDate = UValidate::validateReservationDate($newDate);
            } catch (ValidationException $e) {
                (new VError())->show($e->getMessage(),
                                      "Torna indietro",
                                     "location.href='/reservation/modifyReservation?id={$reservationId}'"
                                    );
                return;
            }
        } else {
            try {
                $newDate = UValidate::validateNotInPast($newDate);
            } catch (ValidationException $e) {
                (new VError())->show($e->getMessage(),
                                      "Torna indietro",
                                     "location.href='/reservation/modifyReservation?id={$reservationId}'"
                                    );
                return;
            }
    }

        $fieldId = $reservation->getField()->getId();
        $avaiableHours = UUtility::retriveAvaiableHoursForFieldAndDate($fieldId, $newDate);

        $view = new VReservation();
        $view->showModifyTimeForm($reservation, $newDate, $avaiableHours);
    }





    
     public static function confirmModifyReservation() {
        $reservationId = $_POST['id'] ?? null;
        $date = $_POST['date'] ??  null;
        $time = $_POST['time'] ?? null;

        if (!$reservationId || !$date || !$time) {
            (new VError())->show("Dati mancanti per la modifica.",
                                 "Torna indietro",
                                 "location.href='/dasbhboard/manageReservations'");
            return;
        }

        $reservation = FPersistentManager::getInstance()->retriveReservationById($reservationId);

        $reservation->setDate(new DateTime($date));
        $reservation->setTime(new DateTime($time));

        FPersistentManager::getInstance()->saveReservation($reservation);


        $view = new VReservation();
        $view->showModifyConfirmation();
    }


}