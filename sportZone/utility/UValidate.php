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

    public static function validateTitle(string $title): string {
        // Check if the title is empty
        if (empty($title)) {
            throw new ValidationException("Title is empty");
        }
        // Check if the title is too long
        if (strlen($title) > 100) {
            throw new ValidationException("Title exceeds character limit.");
        }
        // Check if the title contains only valid characters (letters, numbers, spaces, and some special characters)
        if (!preg_match('/^[a-zA-Z0-9\s\-\_\.]+$/', $title)) {
            throw new ValidationException("Title contains invalid characters");
        }
        return $title;
    }
    


    /// TETSTTSTST
    public static function validateInputArray(array $array, array $attributes, bool $require): array {
        $filteredParams = $array;

        $paramskeys = array_keys($filteredParams);
        foreach ($paramskeys as $key) {
            // Rimuovo i parametri che non sono tra quelli definiti
            if (!in_array($key, $attributes) || empty($filteredParams[$key]) ) {
                unset($filteredParams[$key]);
            } else {
                // Se il parametro è valido, lo filtro 
                $filteredParams[$key] = htmlspecialchars(trim($filteredParams[$key]));
            }
        }
        //qui ho una array di parametri che possono richiamare i metodi di validazione
        //per validare i parametri di ricerca
        foreach ($filteredParams as $key => $val) {
            $methodName = 'validate' . ucfirst($key); // Es: 'title' -> 'validateTitle'
            
            if (method_exists(self::class, $methodName)) {
                // Richiama il metodo statico passando il valore dell'attributo
                $filteredParams[$key] = UValidate::$methodName($filteredParams[$key]);
            }
        }

        return $filteredParams;
    }
}