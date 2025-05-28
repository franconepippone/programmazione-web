<?php

require_once __DIR__ . "/../entity/EUser.php";

class FUser{

    /**
     * Checks if there exists at least one User entity in the db with the specified field equal to the given value.
     *
     * @param string $field The entity field/property name to check.
     * @param mixed  $value The value to match against the specified field.
     *
     * @return bool True if at least one entity exists with the given field value, false otherwise.
     */
    public static function attributeExists($field, $value){
        $result = FEntityManager::getInstance()->verifyAttributeExists(EUser::class, $field, $value);

        return $result;
    }

    public static function getUserByUsername($username){
        $result = FEntityManager::getInstance()->retriveObjFromField(EUser::class, 'username', $username);
        return $result;
    }

    public static function getUserById(int $id){
        $result = FEntityManager::getInstance()->retriveObj(EUser::class, $id);
        return $result;
    }
}