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
                'alt'       => 'Campo Calcio 11'
            ];

            $fieldsInfo[] = $info;
        }



        $fieldsInfo2 = [
            [
                'id'    => 1,
                'title' => 'Campo Calcio 11',
                'sport' => 'Calcio',
                'orario' => '09:00 - 22:00',
                'superficie' => 'Erba sintetica',
                'price' => '€60 / ora',
                'url' => '/field/details/campo_calcio_11',
                'image' => 'https://th.bing.com/th/id/R.5e6c852d2443894ea716c5d7cce49c42?rik=rWtVM5FnJ%2fxwmw&pid=ImgRaw&r=0&sres=1&sresct=1',
                'alt' => 'Campo Calcio 11'
            ],
            [
                'id'  => 2,  
                'title' => 'Campo Tennis Coperto',
                'sport' => 'Tennis',
                'orario' => '08:00 - 21:00',
                'superficie' => 'Resina',
                'price' => '€25 / ora',
                'url' => '/field/details/campo_tennis_coperto',
                'image' => 'https://th.bing.com/th/id/OIP.h4vWfrw2qYv7vH4iW_oZmgHaEK?r=0&rs=1&pid=ImgDetMain&cb=idpwebp2&o=7&rm=3',
                'alt' => 'Campo Tennis Coperto'
            ],
            [
                'id'  => 3,  
                'title' => 'Campo Padel Deluxe',
                'sport' => 'Padel',
                'orario' => '10:00 - 23:00',
                'illuminazione' => 'LED',
                'price' => '€40 / ora',
                'url' => 'campo3.html',
                'image' => 'https://www.italgreen.it/computedimage/campi-da-padel.i8730-k6noro-w1000-h1000-l1-n1.jpg',
                'alt' => 'Campo Padel Deluxe'
            ],
            [
                'id'  => 4,  
                'title' => 'Campo Basket All\'aperto',
                'sport' => 'Basket',
                'orario' => '07:00 - 20:00',
                'superficie' => 'Cemento',
                'price' => '€20 / ora',
                'url' => 'campo4.html',
                'image' => 'https://it.habcdn.com/photos/business/gallery/campo-basket_74270.jpg',
                'alt' => 'Campo Basket All\'aperto'
            ],
            [
                'id'  => 5,  
                'title' => 'Campo Volley Beach',
                'sport' => 'Beach Volley',
                'orario' => '10:00 - 19:00',
                'superficie' => 'Sabbia',
                'price' => '€30 / ora',
                'url' => 'campo5.html',
                'image' => 'https://www.happy-family.it/wp-content/uploads/2020/10/happy-familyjpg9.jpg',
                'alt' => 'Campo Volley Beach'
            ]
        ];

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