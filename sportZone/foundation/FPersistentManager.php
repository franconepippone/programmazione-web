<?php

use App\Enum\EnumSport;

require_once __DIR__ . "/../../vendor/autoload.php";
require_once "FField.php";

class FPersistentManager{

    /**
     * Singleton Class (NON HA SENSO???? che senso ha avere un singleton con metodi statici?? forse è solo simmetria con eentitymanager?) -americo 
     */

     private static $instance;


     private function __construct(){}

     public static function getInstance(){
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * upload any Object in the database
     */
    public static function uploadObj($obj){
        $result = FEntityManager::getInstance()->saveObject($obj);
        return $result;
    }

    //-------------------------------------USER---------------------------------------
    
    public static function retrieveAllUsers(){
        $result = FUser::getAllUsers();
        return $result;
    }
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
     * return a User finding it not on the id but on it's email
     */
    public static function retriveUserById($userId){
        return FUser::getUserById($userId);
    }

    /**
     * return a User findig it not on the id but on it's username
     */
    public static function retriveUserOnUsername($username)
    {
        $result = FUser::getUserByUsername($username);
        return $result;
    }

    /**
     * return a User finding it on the id
     */
    public static function retriveUserOnId(int $id) {
        $result = FUser::getUserById($id);
        return $result;
    }

     //-------------------------------------FIELD---------------------------------------

    /**
     * Retrieve a Field by ID
     */
    public static function retriveFieldById($id){
        return FField::getFieldById($id);
    }

    /**
     * Retrieve a Field by attribute
     */
    public static function retrieveAllMatchingFields(array $filters = []) {
        $result = FEntityManager::getInstance()->selectAll(EField::class);
        return $result;
    }
    

     public function existsFieldBySport($sport) {
     $fields = FField::getAllFields();
     foreach ($fields as $field) {
         if (strtolower($field->getSport()) == strtolower($sport)) {
             return true;
         }
     }
     return false;
     }
     
    /**
    * Retrieve all fields
    */
     public function retriveAllFields() {
        return FField::getAllFields();
     }

     public static function retriveFieldByAttribute($field, $value){
        return FField::getFieldByAttribute($field,$value);
     }
    public static function removeField(EField $field){
        return FField::deleteField($field);
    }    

    public static function retrieveFieldsBySport(?string $sport) {
        return FField::getFieldsBySport($sport);
    }

     //-------------------------------------CLIENT--------------------------------------

    /**
     * Retrieve a Client by ID
     */
    public static function retriveClientById($id){
        return FClient::getClientById($id);
    }

    public function existsClientByPartialName($name) {
    $clients = FClient::getAllClients();
    foreach ($clients as $client) {
        $fullName = strtolower($client->getName() . " " . $client->getSurname());
        if (strpos($fullName, strtolower($name)) !== false) {
            return true;
        }
    }
    return false;
    }

    //-----------------------------------PAYMENT METHOD-------------------------------

    /**
     * Retrieve a Payment Method by ID
     */
    /*public static function retrivePaymentMethodById($id){
        return FPaymentMethod::getPaymentMethodById($id);
    }*/

    //-------------------------------------RESERVATION--------------------------------

    /**
     * Retrieve reservations by field and date
     */
    public static function retriveReservationByFieldId($fieldId){
        return FReservation::getReservationByFieldId($fieldId);
    }

    /**
     * Save a Reservation object
     */
    public static function saveReservation($reservation){
        return FReservation::saveReservation($reservation);
    }

    /**
     * Delete a Reservation object
     */
    public static function removeReservation(EReservation $reservation){
        return FReservation::deleteReservation($reservation);
    }    

    /**
     * filter by name, date and sport
     *
     * Returns the list of reservations.
     */
    public function retriveFilteredReservations($name = null, $date = null, $sport = null) {
        return FReservation::filterReservations($name, $date, $sport);
    }

    public function retriveAllReservations() {
        return FReservation::getAllReservations();
    }
   
    public function retriveReservationById($id) {
        return FReservation::getReservationById($id);
    }

    public static function retriveReservationsByUserId(int $userId) {
    $result = FReservation::getReservationsByUserId($userId);
    return $result;
  }

/**
 * Retrieve available hours for a specific field and date
 */
    
  
    //-----------------------------------INSTRUCTOR-------------------------------

    public function retriveAllInstructors() {
        return FInstructor::getAllInstructors();
    }

    public static function retriveInstructorById($id){
        return FInstructor::getInstructorById($id);
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

   //-----------------------------------COURSE-------------------------------


    public static function saveCourse($course){
        return FCourse::saveCourse($course);
    }

    public static function removeCourse($course){
        return FCourse::deleteCourse($course);
    }

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

    public function retriveCommonAvaiableHours(int $fieldId, array $dates): array {
        if (empty($dates)) {
            return [];
        }

        // Inizializza con gli orari disponibili del primo giorno
        $firstDate = $dates[0];
        $commonHours = UUtility::retriveAvaiableHoursForFieldAndDate($fieldId, $firstDate);

        // Per ogni data successiva, fai l'intersezione con gli orari precedenti
        for ($i = 1; $i < count($dates); $i++) {
            $dateString = $dates[$i];
            $dayHours = UUtility::retriveAvaiableHoursForFieldAndDate($fieldId, $dateString);
            $commonHours = array_intersect($commonHours, $dayHours);
        }

        // Ordina gli orari risultanti e restituiscili
        sort($commonHours);
        return array_values($commonHours);
    }
 
     //------------------------------------ENROLLMENT-------------------------------
    public static function saveEnrollment($enrollment){
        return FEnrollment::saveEnrollment($enrollment);
    }
    public static function retriveEnrollmentOnId(int $id) {
        $result = FEnrollment::getEnrollmentById($id);
        return $result;
    }
    public static function retriveEnrollmentsOnUserId(int $user_id) {
        $result = FEnrollment::getEnrollmentsByUserId($user_id);
        return $result;
    }
    public static function retriveEnrollmentsOnCourseId(int $course_id) {
        $result = FEnrollment::getEnrollmentsByCourseId($course_id);
        return $result;
    }
    public static function retriveEnrollmentOnAttributes(array $fields) {
        $result = FEnrollment::getEnrollmentByAttributes($fields);
        return $result;
    }
    public static function retriveEnrollmentsOnAttributes(array $fields) {
        $result = FEnrollment::getEnrollmentsByAttributes($fields);
        return $result;
    }

    public static function removeEnrollment(EEnrollment $e) {
        $result = FEnrollment::deleteEnrollment($e);
        return $result;
    }

}
