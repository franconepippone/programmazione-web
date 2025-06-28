<?php
require_once __DIR__ . "/../entity/EReservation.php";

class FReservation {

    /**
     * Checks if there exists at least one Reservation entity in the db
     * with the specified field equal to the given value.
     *
     * @param string $field The entity field/property name to check.
     * @param mixed $value The value to match against the specified field.
     *
     * @return bool True if at least one entity exists with the given field value, false otherwise.
     */
    public static function attributeExists(string $field, $value): bool {
        return FEntityManager::getInstance()->verifyAttributeExists(EReservation::class, $field, $value);
    }


    /**
     * Retrieve Reservation by ID
     *
     * @param int $id
     * @return EReservation|null
     */
    public static function getReservationById(int $id): ?EReservation {
        return FEntityManager::getInstance()->retriveObj(EReservation::class, $id);
    }

    /**
     * Retrieve Reservations by field and date
     *
     * @param int $field_id
     * @param string $date
     * @return array EReservation
     */
    public static function getReservationByFieldId(int $field_id) {
        $result = FEntityManager::getInstance()->objectList(EReservation::class, 'field', $field_id);
        return $result;
    }
  

    /**
     * Retrieve Reservations by date
     *
     * @param string $date
     * @return array EReservation
     */
    public static function getReservationsByDate(string $date) {
        $date = new DateTime($date);
        return FEntityManager::getInstance()->objectList(EReservation::class, 'date', $date);
   }    


    /**
     * Save or update a Reservation entity
     *
     * @param EReservation $reservation
     * @return void
     */
    public static function saveReservation(EReservation $reservation): void {
        FEntityManager::getInstance()->saveObject($reservation);
    }

    /**
     * Delete a Reservation entity
     *
     * @param EReservation $reservation
     * @return void
     */
    public static function deleteReservation(EReservation $reservation): void {
        FEntityManager::getInstance()->deleteObj($reservation);
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

        // Filtro per data
        if ($date !== null && trim($date) !== '') {
            $resDate = $res->getDate()->format('Y-m-d');
            if ($resDate !== $date) {
                $ok = false;
            }
        }

        // Filtro per sport del campo
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
    
    public static function getAllReservations() {
        return FEntityManager::getInstance()->selectAll(EReservation::class);
    }


 

    public static function getReservationsByUserId(int $userId) {
        $result = FEntityManager::getInstance()->objectList(EReservation::class, 'user', $userId);
        return $result;
    }
}
