<?php

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

     //-------------------------------------FIELD---------------------------------------

    /**
     * Retrieve a Field by ID
     */
    public static function retriveFieldById($id){
        return FField::getFieldById($id);
    }

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

     public function retriveAllFields() {
        return FField::getAllFields();
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
    public static function retrivePaymentMethodById($id){
        return FPaymentMethod::getPaymentMethodById($id);
    }

    //-------------------------------------RESERVATION--------------------------------

    /**
     * Retrieve reservations by field and date
     */
    public static function getReservationsByFieldAndDate($field, $date){
        return FReservation::getReservationsByFieldAndDate($field, $date);
    }

    /**
     * Save a Reservation object
     */
    public static function saveReservation($reservation){
        return FReservation::saveReservation($reservation);
    }

    /**
     * Get available hours for a field on a specific date.
     * Returns the list of free hours by checking existing reservations.
     */
    public function getAvailableHours(int $fieldId, string $date): array {
        return FReservation::getAvailableHours($fieldId, $date);
    }

    /**
     * fillter by name, date and sport
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
  
    //-----------------------------------INSTRUCTOR-------------------------------

    public function retriveAllInstructors() {
        return FInstructor::getAllInstructors();
    }

    public static function retriveInstructorById($id){
        return FInstructor::getInstructorById($id);
    }


   //-----------------------------------COURSE-------------------------------


    public static function saveCourse($course){
        return FCourse::saveCourse($course);
    }

}
