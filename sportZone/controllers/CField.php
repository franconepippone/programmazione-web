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
}