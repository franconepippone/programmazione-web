<?php

require_once __DIR__ . "/FUser.php";

class FPersistentManager{

    /**
     * Singleton Class
     */

     private static $instance;


     private function __construct(){}

     public static function getInstance(){
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

        //-------------------------------------VERIFY---------------------------------------
    
    /**
     * verify if a user with this email exists in the database
     */
    public static function verifyUserEmail($email){
        $result = FUser::attributeExists('email', $email);

        return $result;
    }

    /**
     * verify if a user with this username exists in the database
     */
    public static function verifyUserUsername($username){
        $result = FUser::attributeExists('username', $username);

        return $result;
    }

    /**
     * upload any Object in the database
     */
    public static function uploadObj($obj){

        $result = FEntityManager::getInstance()->saveObject($obj);

        return $result;
    }

    /**
     * return a User findig it not on the id but on it's username
     */
    public static function retriveUserOnUsername($username)
    {
        $result = FUser::getUserByUsername($username);
        return $result;
    }

    public static function retriveUserOnId(int $id) {
        $result = FUser::getUserById($id);
        return $result;
    }
    //**************************************************** */
    //metodi per classe Course
    public static function retriveCourses() {
        $result = FCourse::getCourses();
        return $result;
    }
    public static function retriveCourseOnId(int $id) {
        $result = FCourse::getCourseById($id);
        return $result;
    }
    public static function retriveCourseOnAttribute($field, $value) {
        $result = FCourse::getCourseByAttribute($field, $value);
        return $result;
    }
    public static function retriveCourseOnAttributes(array $fields) {
        $result = FCourse::getCourseByAttributes($fields);
        return $result;
    }
    public static function retriveCoursesOnAttributes(array $fields) {
        $result = FCourse::getCoursesByAttributes($fields);
        return $result;
    }
    public static function retriveCoursesOnInstructorId(int $instructor_id) {
        $result = FCourse::getCoursesByInstructorId($instructor_id);
        return $result;
    }
    //**************************************************** */
    //metodi per classe Instructor
    public static function retriveInstructors() {
        $result = FInstructor::getInstructors();
        return $result;
    }
    public static function retriveInstructorOnId(int $id) {
        $result = FInstructor::getInstructorById($id);
        return $result;
    }
    public static function retriveInstructorOnAttribute($field, $value) {
        $result = FInstructor::getInstructorByAttribute($field, $value);
        return $result;
    }
    public static function retriveInstructorOnAttributes(array $fields) {
        $result = FInstructor::getInstructorByAttributes($fields);
        return $result;
    }
    public static function retriveInstructorsOnCourseId(int $course_id) {
        $result = FInstructor::getInstructorsByCourseId($course_id);
        return $result;
    }
    public static function retriveInstructorsOnAttributes(array $fields) {
        $result = FInstructor::getInstructorsByAttributes($fields);
        return $result;
    }
}