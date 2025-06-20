<?php
/**
 * Foundation class to manage reservations (EReservation entity).
 * All DB operations on EReservation go through this class.
 */
class FReservation
{
    private static $entity = "EReservation";

    /**
     * Store a new reservation or update an existing one.
     * @param EReservation $reservation
     * @return void
     */
    public static function store(EReservation $reservation): void
    {
        $pm = PersistentManager::getInstance();
        $pm->store($reservation);
    }

    /**
     * Delete a reservation.
     * @param EReservation $reservation
     * @return void
     */
    public static function delete(EReservation $reservation): void
    {
        $pm = PersistentManager::getInstance();
        $pm->delete($reservation);
    }

    /**
     * Find a reservation by its ID.
     * @param int $id
     * @return EReservation|null
     */
    public static function findById(int $id): ?EReservation
    {
        $pm = PersistentManager::getInstance();
        return $pm->findOne(self::$entity, ["id" => $id]);
    }

    /**
     * Find all reservations.
     * @return EReservation[]
     */
    public static function findAll(): array
    {
        $pm = PersistentManager::getInstance();
        return $pm->findAll(self::$entity);
    }

    /**
     * Find reservations by a given field.
     * @param EField $field
     * @return EReservation[]
     */
    public static function findByField(EField $field): array
    {
        $pm = PersistentManager::getInstance();
        return $pm->findBy(self::$entity, ["field" => $field]);
    }
}
