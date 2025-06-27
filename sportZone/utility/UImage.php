<?php

require_once __DIR__ . "/../../vendor/autoload.php";
require_once __DIR__ . "/../../config/config.php";

/**
 * Helper class to create / validate images from the $_FILES superglobal
 */
class UImage
{   
    public static function getImageFullPath(?string $filename): string {
        if ($filename == null) return '';
        // Get the base path of the project (e.g. /programmazioneweb or /)
        $basePath = dirname($_SERVER['SCRIPT_NAME']);
        // Ensure no trailing slash, then append /images/ and the filename
        return rtrim($basePath, '/') . '/images/' . ltrim($filename, '/');
    }

    public static function storeImageGetFilename(array $file): ?string {
        // Validate the image first
        $check = self::validateImage($file);
        if (!$check[0]) {
            return null;
        }

        // Ensure destination directory exists
        $fullDir = rtrim(IMAGE_FOLDER_PATH, '/') . '/';
        if (!is_dir($fullDir)) {
            mkdir($fullDir, 0777, true);
        }

        // Generate a random filename with extension
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $randomName = bin2hex(random_bytes(16)) . ($ext ? '.' . $ext : '');

        $targetPath = $fullDir . $randomName;

        // Move the uploaded file
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return $randomName;
        } else {
            return null;
        }
    }

    /**
    * check if the image is ok and in case return the error
    */
    private static function validateImage($file){
        if($file['error'] !== UPLOAD_ERR_OK){
            $error = 'UPLOAD_ERROR_OK';

            return [false, $error];
        }

        if(!in_array($file['type'], ALLOWED_IMAGE_TYPE)){
            $error = 'TYPE_ERROR';

            return [false, $error];
        }

        if($file['size'] > MAX_IMAGE_SIZE){
            $error = 'SIZE_ERROR';

            return [false, $error];
        }

        return [true, null];
    }
}