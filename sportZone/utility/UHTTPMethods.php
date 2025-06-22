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

    /**
     * Normalize the structure of the $_FILES array for easier handling of multiple uploaded files.
     *
     * PHP's default structure for $_FILES when using multiple file uploads groups data by field
     * (e.g., 'name', 'type', 'tmp_name', etc.), which can be cumbersome to work with. This function
     * transforms the array so that each uploaded file is represented as its own associative array
     * with all its related metadata.
     *
     * Example input (`$_FILES['images']`):
     * [
     *     'name' => ['file1.jpg', 'file2.jpg'],
     *     'type' => ['image/jpeg', 'image/jpeg'],
     *     'tmp_name' => ['/tmp/phpYzdqkD', '/tmp/phpuL4kfd'],
     *     'error' => [0, 0],
     *     'size' => [12345, 67890],
     *     'full_path' => ['file1.jpg', 'file2.jpg'] // Optional, available in PHP 8.1+
     * ]
     *
     * Example output:
     * [
     *     [
     *         'name' => 'file1.jpg',
     *         'full_path' => 'file1.jpg',
     *         'type' => 'image/jpeg',
     *         'tmp_name' => '/tmp/phpYzdqkD',
     *         'error' => 0,
     *         'size' => 12345
     *     ],
     *     [
     *         'name' => 'file2.jpg',
     *         'full_path' => 'file2.jpg',
     *         'type' => 'image/jpeg',
     *         'tmp_name' => '/tmp/phpuL4kfd',
     *         'error' => 0,
     *         'size' => 67890
     *     ]
     * ]
     *
     * @param array $files The multi-file $_FILES[fieldName] array structure.
     * @return array An array of normalized file data, each represented as an associative array.
     */
    static function normalizeFilesArray(array $files): array {
        $normalized = [];

        foreach ($files['name'] as $index => $name) {
            $normalized[] = [
                'name'      => $files['name'][$index],
                'full_path' => $files['full_path'][$index] ?? '',
                'type'      => $files['type'][$index],
                'tmp_name'  => $files['tmp_name'][$index],
                'error'     => $files['error'][$index],
                'size'      => $files['size'][$index],
            ];
        }

        return $normalized;
    }
}