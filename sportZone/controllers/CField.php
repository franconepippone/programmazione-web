<?php

require_once __DIR__ . "/../../vendor/autoload.php";

class CField {

    private static $rulesSearch = [
        "sport" => 'validateSport',
        "date" => 'validateDate'
    ];

    public static function searchForm() {
        CUser::isLogged();

        $view = new VField();
        $view->showSearchForm();
    }

    public static function showResults() {
        CUser::isLogged();

        try {
            $getInputs = UValidate::validateInputArray($_GET, self::$rulesSearch, false);
        } catch (ValidationException $e) {
            echo "INPUT VALIDATION FAILED: " . $e->getMessage();
            exit;
        }

        $searchParams = ['date' => '', 'sport' => ''];
        if (isset($getInputs['date'])) {
            $dataText = $getInputs['date']->format('Y-m-d');
            $searchParams['date'] = $dataText; // Convert DateTime to string in 'Y-m-d' format
        }

        if (isset($getInputs['sport'])) {
            $searchParams['sport'] = $getInputs['sport'];
        }
        
        $pm = FPersistentManager::getInstance();
        $fields = $pm->retrieveAllMatchingFields();
        // TODO filtraggio dei campi (usa metodo di alice) 

        $view = new VField();
        $view->showSearchResults($fields, $searchParams);
    }

    public static function details($field_id) {
        CUser::isLogged();
        
        $pm = FPersistentManager::getInstance();
        $fld = $pm->retriveFieldById($field_id);

        if ($fld == null) {
            echo "Invalid field id";
            exit;
        }

        try {
            $inputs = UValidate::validateInputArray($_GET, ["date"], false);
        } catch (ValidationException $e) {
            echo $e->getMessage();
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