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

}