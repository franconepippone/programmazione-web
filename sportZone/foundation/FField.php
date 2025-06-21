<?php

require_once __DIR__ . "/../entity/EFIeld.php";

class FFIeld{

    /**
     * Checks if there exists at least one User entity in the db with the specified field equal to the given value.
     *
     * @param string $field The entity field/property name to check.
     * @param mixed  $value The value to match against the specified field.
     *
     * @return bool True if at least one entity exists with the given field value, false otherwise.
     */
    public static function attributeExists($field, $value){
        $result = FEntityManager::getInstance()->verifyAttributeExists(EField::class, $field, $value);

        return $result;
    }

   
}