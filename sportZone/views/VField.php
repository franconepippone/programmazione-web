<?php
require __DIR__ . '/../../vendor/autoload.php';

class VField{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showSearchForm() {
        $this->smarty->display("field/search_form.tpl");
    }

    /*
    Array of entries if this kind
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
    */
    public function showSearchResults($fields) {
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

        $this->smarty->assign('fields', $fieldsInfo);
        $this->smarty->display("field/search_results_list.tpl");
    }

    public function showDetailsPage($field) {

        $imageObj = $fld->getImage();
            if ($imageObj !== null) {
                $base64 = $imageObj->getEncodedData();
                $type = $imageObj->getType(); // e.g. "image/png"
                $imageDataUri = "data:" . htmlspecialchars($type) . ";base64," . $base64;
            } else {
                $imageDataUri = ''; // or a placeholder image URI
            }


        $campo = [
            'id' => $field->getId(),
            'titolo' => $field->getName(),
            'sport' => $field->getSport(),
            'orario' => '09:00 - 22:00',
            'superficie' => $field->getTerrainType(),
            'illuminazione' => 'Sì',
            'prezzo' => ((string)$field->getCost()).'€/ora',
            'descrizione' => $field->getDescription(),
            'immagini' => [
                "https://d26itsb5vlqdeq.cloudfront.net/image/98CE1963-0E26-F9B2-D4713C65A9683442",
                "https://d26itsb5vlqdeq.cloudfront.net/image/98CE1963-0E26-F9B2-D4713C65A9683442",
                "https://d26itsb5vlqdeq.cloudfront.net/image/98CE1963-0E26-F9B2-D4713C65A9683442",
            ],
            'latitude' => $field->getLatitude(),
            'longitude' => $field->getLongitude()
        ];
          // Passa i dati a Smarty
        $this->smarty->assign('campo', $campo);
        $this->smarty->display("field/details.tpl");
    }

    // ------------------- ADMIN -----------------------------

    public function showCreateFieldForm() {
        $this->smarty->display("field/create_field.tpl");
    }

}