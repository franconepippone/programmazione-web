<?php

require_once __DIR__ . "/../../vendor/autoload.php";

class FInstructor {
    //********************************
    //verify methods
    public static function attributeExists($field, $value) {
        $result = FEntityManager::getInstance()->verifyAttributeExists(EInstructor::class, $field, $value);
        return $result;
    }

    //********************************
    //retrieve methods
    public static function getInstructors() {
        $instructors = FEntityManager::getInstance()->selectAll(EInstructor::class);
        return $instructors;
    }

    public static function getInstructorById(int $id) {
        $result = FEntityManager::getInstance()->retriveObj(EInstructor::class, $id);
        return $result;
    }

    public static function getInstructorsByCourseId(int $course_id) {
        $result = FEntityManager::getInstance()->objectList(EInstructor::class, 'course', $course_id);
        return $result;
    }
    public static function getInstructorByAttribute($field, $value) {
        $result = FEntityManager::getInstance()->retriveObjFromField(EInstructor::class, $field, $value);
        return $result;
    }
    public static function getInstructorByAttributes(array $fields) {
        $result = FEntityManager::getInstance()->retriveObjFromFields(EInstructor::class, $fields);
        return $result;
    }
    public static function getInstructorsByAttributes(array $fields) {
        $result = FEntityManager::getInstance()->retriveObjListFromFields(EInstructor::class, $fields);
        return $result;
    }
    //********************************
    //save and delete methods
    public static function saveInstructor(EInstructor $instructor) {
        $result = FEntityManager::getInstance()->saveObject($instructor);
        return $result;
    }

    public static function deleteInstructor(EInstructor $instructor) {
        $result = FEntityManager::getInstance()->deleteObj($instructor);
        return $result;
    }
}