<?php

use App\Enum\UserSex;
use const Dom\VALIDATION_ERR;

require_once __DIR__ . "/../../vendor/autoload.php";

class CField {

    private static $rulesSearch = [
        "sport" => 'validateSport',
        "date" => 'validateReservationDate'
    ];

    public static function searchForm() {
        $view = new VField();
        $view->showSearchForm();
    }

    public static function showResults() {
        try {
            $getInputs = UValidate::validateInputArray($_GET, self::$rulesSearch, false);
        } catch (ValidationException $e) {
            echo "INPUT VALIDATION FAILED: " . $e->getMessage();
            exit;
        }

        $searchParams = ['date' => null, 'sport' => null];
        if (isset($getInputs['date'])) {
            $dataText = $getInputs['date'];
            $searchParams['date'] = $dataText; 
        }

        if (isset($getInputs['sport'])) {
            $searchParams['sport'] = $getInputs['sport'];
        }

        // filtraggio campi
        $pm = FPersistentManager::getInstance();
        $fields = $pm->retrieveFieldsBySport($searchParams['sport']);

        $queryParams = [];
        if (isset($searchParams['date'])) $queryParams['date'] = $searchParams['date'];
        $query = http_build_query($queryParams);

        $view = new VField();
        $view->showSearchResults($fields, $query, $searchParams);
    }

    public static function details($fieldId) {
        $pm = FPersistentManager::getInstance();
        $field = $pm->retriveFieldById($fieldId);

        if ($field == null) {
            echo "Invalid field id";
            exit;
        }

        try {
            $inputs = UValidate::validateInputArray($_GET, self::$rulesSearch, false);
        } catch (ValidationException $e) {
            $verr = new VError();
            $verr->show($e->getMessage());
            exit;
        }
        
        $date = isset($inputs['date']) ? $inputs["date"] : null;

        $view = new VField();
        $view->showDetailsPage($field, $date);
    }


    // ------------------- EMPLOYEE -----------------------------

    public static function createFieldForm() {
        CUser::isLogged();
        CUser::assertRole(EEmployee::class, EAdmin::class);

        $view = new VField();
        $view->showCreateFieldForm();
    }

    public static function modifyField($field_id) {
        CUser::isLogged();
        CUser::assertRole(EEmployee::class, EAdmin::class);

        $pm = FPersistentManager::getInstance();
        $fld = $pm->retriveFieldById($field_id);

        if ($fld == null) {
            $view = new VError();
            $view->show("Invalid field id");
            exit;
        }

        $images = UImage::getImageFullPaths($fld->getImages());

        $view = new VField();
        $view->showModifyFieldForm($fld, $images);
    }


    private static function internalModifyField(array $array, EField $field) {

        $rulesModifyField = [
            "name" => "validateFieldName",
            "terrainType" => "skipValidation",
            "hourlyCost" => "skipValidation",
            "isIndoor" => "skipValidation",
            "sport" => "validateSport",
            "description" => "skipValidation",
            "latitude" => "skipValidation",
            "longitude" => "skipValidation"
        ];

        try {
            $inputs = UValidate::validateInputArray($_POST, $rulesModifyField, true);
        } catch (ValidationException $e) {
            $view = new VError();
            $view->show($e->getMessage());
            exit;
        }

        $field->setName($inputs['name'])
        ->setTerrainType($inputs['terrainType'])
        ->setCost($inputs['hourlyCost'])
        ->setIsIndoor($inputs['isIndoor'])
        ->setSport($inputs['sport'])
        ->setDescription($inputs['description'])
        ->setLatitude($inputs['latitude'])
        ->setLongitude($inputs['longitude']);

        // If an image was given, saves it for that field
        $imagesInfo = UHTTPMethods::files('images');
        $normImagesInfo = UHTTPMethods::normalizeFilesArray($imagesInfo);

        // if entry 'fieldImage' is present in $_FILES
        if ($normImagesInfo != null) {
            foreach($normImagesInfo as $imgInfo) {
                $imgFilename = UImage::storeImageGetFilename($imgInfo);
                if ($imgFilename != null) {
                    $field->addImage($imgFilename);
                }
            }
        }
    }

    public static function finalizeFieldModify($fieldId) {
        CUser::isLogged();
        CUser::assertRole(EEmployee::class, EAdmin::class);

        $pm = FPersistentManager::getInstance();
        $field = $pm->retriveFieldById($fieldId);
        self::internalModifyField($_POST, $field);
        FPersistentManager::getInstance()->uploadObj($field);
        
        $view = new VError();
        $view->showSuccess("Field was succesfully modified.", buttAction: "window.location.href='/dashboard/manageFields'");
    }

    public static function finalizeFieldCreation() {
        CUser::isLogged();
        CUser::assertRole(EEmployee::class, EAdmin::class);

        // TODO FIELD VALIDATION
        $field = new EField();
        self::internalModifyField($_POST, $field);
        FPersistentManager::getInstance()->uploadObj($field);
        
        $view = new VError();
        $view->showSuccess("Field was succesfully created", buttAction: "window.location.href='/dashboard/manageFields'");
    }

    public static function delete($fieldId) {
        CUser::isLogged();
        CUser::assertRole(EEmployee::class, EAdmin::class);
        
        $pm = FPersistentManager::getInstance();
        $fld = $pm->retriveFieldById($fieldId);

        if ($fld == null) {
            $view = new VError();
            $view->show("Invalid field id");
            exit;
        }

        $pm->removeField($fld);
        
        $view = new VError();
        $view->showSuccess("Campo rimosso con successo", buttAction: "window.location.href='/dashboard/manageFields'");
    }
}