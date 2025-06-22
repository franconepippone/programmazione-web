<?php
require_once __DIR__ . "/../../vendor/autoload.php";

class FCourse{
    //********************************
    //verify methods
    public static function attributeExists($field, $value) {
        $result = FEntityManager::getInstance()->verifyAttributeExists(ECourse::class, $field, $value);
        return $result;
    }
    //********************************
    //retrieve methods

    public static function getCourses() {
        $courses = FEntityManager::getInstance()-> selectAll(ECourse::class);
    }

    public static function getCourseById(int $id){
        $result = FEntityManager::retriveObj(ECourse::class , $id);
        return $result;
    }

    public static function getCourseByAttribute($field, $value) {
        $result = FEntityManager::getInstance()->retriveObjFromField(ECourse::class, $field, $value);
        return $result;
    }
    
    public static function getCourseByAttributes(array $fields) {
        $result = FEntityManager::getInstance()->retriveObjFromFields(ECourse::class, $fields);
        return $result;
    }
    public static function getCoursesByInstructorId(int $instructor_id) {
        $result = FEntityManager::getInstance()->objectList(ECourse::class, 'instructor', $instructor_id);
        return $result;
    }
    public static function getCoursesByAttributes(array $fields) {
        $result = FEntityManager::getInstance()->retriveObjListFromFields(ECourse::class, $fields);
        return $result;
    }
    //********************************
    //save and delete methods   //da implementare o no?
    public static function saveCourse(ECourse $course) {
        $result = FEntityManager::getInstance()->saveObject($course);
        return $result;
    }
    public static function deleteCourse(ECourse $course) {
        $result = FEntityManager::getInstance()->deleteObj($course);
        return $result;

    }

}