<?php
require_once __DIR__ . "/../entity/EReservation.php";

class FReservation {


    public static function attributeExists(string $field, $value): bool {
        return FEntityManager::getInstance()->verifyAttributeExists(EReservation::class, $field, $value);
    }


    public static function getReservationById(int $id): ?EReservation {
        return FEntityManager::getInstance()->retriveObj(EReservation::class, $id);
    }

    
    public static function getReservationByFieldId(int $field_id) {
        $result = FEntityManager::getInstance()->objectList(EReservation::class, 'field', $field_id);
        return $result;
    }
  

    public static function getReservationsByDate(string $date) {
        $date = new DateTime($date);
        return FEntityManager::getInstance()->objectList(EReservation::class, 'date', $date);
   }    


    public static function saveReservation(EReservation $reservation): void {
        FEntityManager::getInstance()->saveObject($reservation);
    }

  
    public static function deleteReservation(EReservation $reservation): void {
        FEntityManager::getInstance()->deleteObj($reservation);
    }



    public static function getAllReservations() {
        return FEntityManager::getInstance()->selectAll(EReservation::class);
    }


 

    public static function getReservationsByUserId(int $userId) {
        $result = FEntityManager::getInstance()->objectList(EReservation::class, 'user', $userId);
        return $result;
    }

    /**
     * Filter a reservation by name,date and sport
     *
     * @param 
     * @return array EReservation
     */

public static function filterReservations($name = null, $date = null, $sport = null) {
    $entityManager = FEntityManager::getInstance();
    $reservations = $entityManager->selectAll(EReservation::class);
    $filtered = [];

    foreach ($reservations as $res) {
        $ok = true;

        // Filtro per nome utente
        if ($name !== null && trim($name) !== '') {
            $user = $res->getUser(); // è un EUser o EClient
            if ($user !== null) {
                $fullName = strtolower($user->getName() . ' ' . $user->getSurname());
                if (strpos($fullName, strtolower($name)) === false) {
                    $ok = false;
                }
            } else {
                $ok = false;
            }
        }

        if ($date !== null && trim($date) !== '') {
            $resDate = $res->getDate()->format('Y-m-d');
            if ($resDate !== $date) {
                $ok = false;
            }
        }

        if ($sport !== null && trim($sport) !== '') {
            $field = $res->getField();
            if ($field === null || strtolower($field->getSport()) !== strtolower($sport)) {
                $ok = false;
            }
        }

        if ($ok) {
            $filtered[] = $res;
        }
    }

    return $filtered;

}
    
 
}
