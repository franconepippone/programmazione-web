<?php
require_once __DIR__ . "/../../vendor/autoload.php";

class FEnrollment {
    //********************************
    //verify methods
    public static function attributeExists($field, $value) {
        $result = FEntityManager::getInstance()->verifyAttributeExists(EEnrollment::class, $field, $value);
        return $result;
    }
    
    //********************************
    //retrieve methods
    public static function getEnrollmentById(int $id) {
        $result = FEntityManager::getInstance()->retriveObj(EEnrollment::class, $id);
        return $result;
    }

    public static function getEnrollmentsByUserId(int $user_id) {
        $result = FEntityManager::getInstance()->objectList(EEnrollment::class, 'user', $user_id);
        return $result;
    }

    public static function getEnrollmentsByCourseId(int $course_id) {
        $result = FEntityManager::getInstance()->objectList(EEnrollment::class, 'course', $course_id);
        return $result;
    }

    public static function getEnrollmentByAttributes(array $fields) {
        $result = FEntityManager::getInstance()->retriveObjFromFields(EEnrollment::class, $fields);
        return $result;
    }
    public static function getEnrollmentsByAttributes(array $fields) {
        $result = FEntityManager::getInstance()->retriveObjListFromFields(EEnrollment::class, $fields);
        return $result;
    }
    //********************************
    //save and delete methods
    public static function saveEnrollment(EEnrollment $enrollment) {
        $result = FEntityManager::getInstance()->saveObject($enrollment);
        return $result;
    }

    public static function deleteEnrollment(EEnrollment $enrollment) {
        $result = FEntityManager::getInstance()->deleteObj($enrollment);
        return $result;
    }
}