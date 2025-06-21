<?php

use App\Enum\UserSex;

require_once __DIR__ . "/../../vendor/autoload.php";

class CField{

    public static function searchForm() {
        $view = new VField();
        $view->showSearchForm();
    }

    public static function showResults() {
        $pm = FPersistentManager::getInstance();
        $fields = $pm->retrieveAllMatchingFields();
        
        // TODO Filtering

        $view = new VField();
        $view->showSearchResults($fields);
    }

    public static function details($field_id) {
        $pm = FPersistentManager::getInstance();
        $fld = $pm->retrieveFieldOnId($field_id);

        if ($fld == null) {
            echo "Invalid field id";
            exit;
        }

        $view = new VField();
        $view->showDetailsPage($fld);
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
        ->setSport(UHTTPMethods::post(param: 'sport'))
        ->setDescription(UHTTPMethods::post('description'))
        ->setLatitude(UHTTPMethods::post('latitude'))
        ->setLongitude(UHTTPMethods::post('longitude'));

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