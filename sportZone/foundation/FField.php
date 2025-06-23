<?php

require_once __DIR__ . "/../../vendor/autoload.php";

class FField{

    /**
     * Checks if there exists at least one User entity in the db with the specified field equal to the given value.
     *
     * @param string $attribute The entity field/property name to check.
     * @param mixed  $value The value to match against the specified field.
     *
     * @return bool True if at least one entity exists with the given field value, false otherwise.
     */
    public static function attributeExists($attribute, $value){
        $result = FEntityManager::getInstance()->verifyAttributeExists(EField::class, $attribute, $value);

        return $result;
    }

    public static function getFieldById($id){
        $result = FEntityManager::getInstance()->retriveObj(EField::class, $id);
        return $result;
    }

    public static function getAllFields() {
        return FEntityManager::getInstance()->selectAll(EField::class);
    }

    // Returns true if the given field has an available slot of size $hours on given date
    public static function isAvailableOnDate(int $id, \DateTimeInterface $date, float $hours) {
        
    }
   
}
