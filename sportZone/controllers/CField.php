<?php

use App\Enum\UserSex;

require_once __DIR__ . "/../../vendor/autoload.php";

class CField{

    public static function searchForm() {
        CUser::isLogged();

        $view = new VField();
        $view->showSearchForm();
    }

    public static function showResults() {
        CUser::isLogged();

        $pm = FPersistentManager::getInstance();
        $fields = $pm->retrieveAllMatchingFields();
        
        
        $searchParams = ['date' => '', 'sport' => ''];
        if (UHTTPMethods::getIsSet('date')) $searchParams['date'] = UHTTPMethods::get('date');
        if (UHTTPMethods::getIsSet('sport')) $searchParams['sport'] = UHTTPMethods::get('sport');

        // TODO filtraggio dei campi (usa metodo di alice) 

        $view = new VField();
        $view->showSearchResults($fields, $searchParams);
    }

    public static function details($field_id) {
        CUser::isLogged();
        
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
        CUser::isLogged();

        $view = new VField();
        $view->showCreateFieldForm();
    }

    public static function finalizeFieldCreation() {
        CUser::isLogged();

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
        $imagesInfo = UHTTPMethods::files('images');
        $normImagesInfo = UHTTPMethods::normalizeFilesArray($imagesInfo);

        // TODO stavi provando a rendere possibile il caricamento di più immagini anziche una sola

        // if entry 'fieldImage' is present in $_FILES
        if ($normImagesInfo != null) {
            foreach($normImagesInfo as $imgInfo) {
                $img = UImage::createImageFromInputFile($imgInfo);
                if ($img != null) {
                    $field->addImage($img);
                }
            }
        }

        FPersistentManager::getInstance()->uploadObj($field);
        echo "uploaded";
    }
}