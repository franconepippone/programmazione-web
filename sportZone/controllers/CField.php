<?php

require_once __DIR__ . "/../../vendor/autoload.php";

class CField {

    private static $validationRules = [
        "sport" => 'validateTitle',
        "date" => 'validateDate'
    ];

    public static function searchForm() {
        CUser::isLogged();

        $view = new VField();
        $view->showSearchForm();
    }

    public static function showResults() {
        CUser::isLogged();

        $pm = FPersistentManager::getInstance();
        $fields = $pm->retrieveAllMatchingFields();
        
        print_r($_GET);

        try {
            $searchParams = UValidate::validateInputArray($_GET, self::$validationRules, true);
        } catch (ValidationException $e) {
            echo $e->getMessage();
            exit;
        }

        print_r($searchParams);

        //$searchParams = ['date' => '', 'sport' => ''];
        //if (UHTTPMethods::getIsSet('date')) $searchParams['date'] = UHTTPMethods::get('date');
        //if (UHTTPMethods::getIsSet('sport')) $searchParams['sport'] = UHTTPMethods::get('sport');

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

        print_r($_GET);

        try {
            $inputs = UValidate::validateInputArray($_GET, ["date"], false);
        } catch (ValidationException $e) {
            echo $e->getMessage();
            exit;
        }


        $query = http_build_query([
            "fieldId" => $field_id,
            "data" => $inputs["date"]
        ]);

        echo $query;

        $view = new VField();
        $view->showDetailsPage($fld, $query);
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