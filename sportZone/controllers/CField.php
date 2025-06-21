<?php

use App\Enum\UserSex;

require_once __DIR__ . "/../../vendor/autoload.php";

class CField{

    public static function searchForm() {
        $view = new VField();
        $view->showSearchForm();
    }

    public static function showResults() {
        echo "giorno: ". UHTTPMethods::post('giorno') . "<br>";
        echo "sport: " . UHTTPMethods::post('sport') . "<br>";


        // MAGIA MAGIA MIAGAI



        $view = new VField();
        $view->showSearchResults();
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
        ->setTerrainType(UHTTPMethods::post('terrainType'))
        ->setCost(UHTTPMethods::post('hourlyCost'))
        ->setIsIndoor(UHTTPMethods::post('isIndoor'))
        ->setSport(UHTTPMethods::post('sport'));

        // If an image was givemn, assigns it
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