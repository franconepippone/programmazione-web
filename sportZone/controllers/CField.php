<?php

use App\Enum\UserSex;

require_once __DIR__ . "/../../vendor/autoload.php";

class CField{

    public static function searchForm() {
        $view = new VField();
        $view->showSearchForm();
    }

    public static function showResults() {
        //echo "giorno: ". UHTTPMethods::post('giorno') . "<br>";
        //echo "sport: " . UHTTPMethods::post('sport') . "<br>";


        // MAGIA MAGIA MIAGAI
        $pm = FPersistentManager::getInstance();
        $fields = $pm->retrieveAllMatchingFields();

        $fieldsInfo = [];
        foreach ($fields as $fld) {
            $imageObj = $fld->getImage();
            if ($imageObj !== null) {
                $base64 = $imageObj->getEncodedData();
                $type = $imageObj->getType(); // e.g. "image/png"
                $imageDataUri = "data:" . htmlspecialchars($type) . ";base64," . $base64;
            } else {
                $imageDataUri = ''; // or a placeholder image URI
            }

            $info = [
                'id'        => $fld->getId(),
                'title'     => $fld->getName(),
                'sport'     => $fld->getSport(),
                'orario'    => '09:00 - 22:00',
                'superficie'=> $fld->getTerrainType(),
                'price'     => $fld->getCost(),
                'image'     => $imageDataUri,
                'alt'       => $fld->getName()
            ];

            $fieldsInfo[] = $info;
        }

        $view = new VField();
        $view->showSearchResults($fieldsInfo);
    }

    public static function details($field_id) {
        echo $field_id;
    }


    // ------------------- ADMIN -----------------------------

    public static function createFieldForm() {
        $view = new VField();
        $view->showCreateFieldForm();
    }

    public static function finalizeFieldCreation() {
        // riceve i dati dal field form e crea un entry nel database
        echo '<pre>';
        print_r($_FILES);
        echo '<\pre>';
        echo '<pre>';
        print_r($_POST);
        echo '<\pre>';

        $field = (new EField())
        ->setName(UHTTPMethods::post('name'))
        ->setTerrainType(UHTTPMethods::post('terrainType'))
        ->setCost(UHTTPMethods::post('hourlyCost'))
        ->setIsIndoor(UHTTPMethods::post('isIndoor'))
        ->setSport(UHTTPMethods::post('sport'));

        // If an image was given, saves it for that field
        $imageInfo = UHTTPMethods::files('fieldImage');

        // if entry 'fieldImage' is present in $_FILES
        if ($imageInfo != null) {
            $img = UImage::createImageFromInputFile($imageInfo);
            if ($img != null) {
                $field->setImage($img);
            }
        }

        $pm = FPersistentManager::getInstance()->uploadObj($field);
        echo "uploaded";
    }
}