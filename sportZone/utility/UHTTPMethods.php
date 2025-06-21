<?php

/**
 * Class to access to SUPERGLOBAL arrays for the HTTP request like $_POST, $_FILES, You must use this class to access theese arrays (in this class are implemented only $_POST and $_FILES) 
 */
class UHTTPMethods{

    /**
     * can access to $_GET superglobal
     */
    public static function get($param){
        return $_GET[$param];
    }
    
    /**
     * can access to $_POST superglobal
     */
    public static function post($param){
        //if (!isset($_POST[$param])) return null;
        return $_POST[$param];
    }

    /**
     * Safely retrieves nested file upload data from the $_FILES superglobal.
     *
     * This function allows flexible access to any level of the $_FILES array,
     * including deeply nested structures (e.g., when using multiple or array-named file inputs).
     *
     * Example Usages:
     * - files("avatar")                      → $_FILES["avatar"]
     * - files("avatar", "name")             → $_FILES["avatar"]["name"]
     * - files("avatar", "name", 0)          → $_FILES["avatar"]["name"][0]
     * - files("photos", "tmp_name", 2)      → $_FILES["photos"]["tmp_name"][2]
     *
     * @param mixed ...$keys A variable number of string or integer keys to access nested $_FILES data
     *
     * @return mixed|null The value found at the specified location in $_FILES, or null if any key is missing
     */
    public static function files(...$keys) {
        $data = $_FILES;
        foreach ($keys as $key) {
            if (!isset($data[$key])) {
                return null;
            }
            $data = $data[$key];
        }
        return $data;
    }
}