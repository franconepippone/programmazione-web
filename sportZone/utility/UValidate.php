<?php
require __DIR__ ."/../../vendor/autoload.php";

class UValidate {

    /**
     * Validate if a string is a valid email address
     * @param string $email
     * @return bool
     */
    public static function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validateTitle($title) {
        // Check if the title is empty
        if (empty($title)) {
            return false;
        }
        // Check if the title is too long
        if (strlen($title) > 100) {
            return false;
        }
        // Check if the title contains only valid characters (letters, numbers, spaces, and some special characters)
        if (!preg_match('/^[a-zA-Z0-9\s\-\_\.]+$/', $title)) {
            return false;
        }
        return true;
    }
    
}