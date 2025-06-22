<?php
require_once __DIR__ . "/../entity/EField.php";

class FField {

    /**
     * Retrieve a Field by ID
     *
     * @param int $id
     * @return EField|null
     */
    public static function getFieldById(int $id): ?EField {
        return FEntityManager::getInstance()->retriveObj(EField::class, $id);
    }

    public static function getAllFields() {
        return FEntityManager::getInstance()->selectAll(EField::class);
    }
}
