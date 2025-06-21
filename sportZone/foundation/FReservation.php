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
    * Returns all the reservations of a sports field for a specific date.
    *
    * @param int $fieldId The ID of the sports field.
    * @param string $date The date in YYYY-MM-DD format.
    * @return array<EReservation> An array of reservations for the given field and date, or empty if none exist.
    *
    * Used to check existing reservations during the creation process
    * (e.g., to display occupied time slots and prevent double bookings).
    */
    public static function getByFieldAndDate($fieldId, $date) {
        $field = FField::getById($fieldId);
        return FEntityManager::getRepository(EReservation::class)->findBy([
            'field' => $field,
            'date' => $date
        ]);
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
     * Retrieve Reservation by a specific field and value
     *
     * @param string $field
     * @param mixed $value
     * @return EReservation|null
     */
    public static function getReservationByField(string $field, $value): ?EReservation {
        return FEntityManager::getInstance()->retriveObjFromField(EReservation::class, $field, $value);
    }

    /**
     * Get available reservation hours for a given field and date
     *
     * This method calculates the list of free hourly slots between
     * the opening and closing hours (8 to 21) by excluding the hours
     * already booked in existing reservations for the specified field and date.
     *
     * @param int $fieldId The ID of the sports field
     * @param string $date The date for which to check availability (format: 'YYYY-MM-DD')
     * @return int[] Array of available hours in 24-hour format (e.g., [8, 9, 10, ...])
     */

     public static function getAvailableHours(int $fieldId, string $date): array {
        $openingHour = 8;
        $closingHour = 21;
        $allHours = range($openingHour, $closingHour - 1);

        // Use EntityManager to get reservations for that field and date
        $entityManager = FEntityManager::getInstance();

        $reservations = $entityManager->getRepository(EReservation::class)->findBy([
            'field' => $fieldId,
            'date' => new \DateTime($date)
        ]);

        foreach ($reservations as $reservation) {
            $reservedHour = (int)$reservation->getTime(); // assuming getTime() returns hour as int or string
            if (($key = array_search($reservedHour, $allHours)) !== false) {
                unset($allHours[$key]);
            }
        }

    /**
     * Save or update a Reservation entity
     *
     * @param EReservation $reservation
     * @return void
     */
    public static function saveReservation(EReservation $reservation): void {
        FEntityManager::getInstance()->save($reservation);
    }

    /**
     * Delete a Reservation entity
     *
     * @param EReservation $reservation
     * @return void
     */
    public static function deleteReservation(EReservation $reservation): void {
        FEntityManager::getInstance()->delete($reservation);
    }
}
