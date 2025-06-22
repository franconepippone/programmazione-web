<?php


require_once __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to create / validate images from the $_FILES superglobal
 */
class UImage
{

    public static function getImageDataUri(EImage $imageObj): string {
        if ($imageObj !== null) {
            $base64 = $imageObj->getEncodedData();
            $type = $imageObj->getType(); // e.g. "image/png"
            $imageDataUri = "data:" . htmlspecialchars($type) . ";base64," . $base64;
        } else {
            $imageDataUri = ''; // or a placeholder image URI
        }
        return $imageDataUri;
    }


    /**
    * Create image object
    * @param $file entry on the $_FILES array referring to the file
    * @return mixed eihter the EImage object, or false in case of an error
    */
    public static function createImageFromInputFile(Array $file){
        $check = self::validateImage($file);
        if($check[0]){
        
            //create new Image Obj ad perist it
            $image = new EImage($file['name'], $file['size'], $file['type'], file_get_contents($file['tmp_name']));
            return $image;
        }else{
            // failed to create image
            return false;
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