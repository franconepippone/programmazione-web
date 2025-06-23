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
    Array of entries matching this structure
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
    public function showSearchResults($fields, $searchParams) {
        $fieldsInfo = [];
        foreach ($fields as $fld) {
            
            $images = $fld->getImages();
            if (sizeof($images) > 0) {
                $imageDataUri = UImage::getImageDataUri($images[0]);
            } else {
                $imageDataUri = "https://th.bing.com/th/id/OIP.xQLogGqy75CRaZGYTlgdXAHaLG?r=0&rs=1&pid=ImgDetMain&cb=idpwebp2&o=7&rm=3";
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

        // vengono passati in get alla pagina details, in modo che details possa reinidirizzare alla prenotazione corretta
        $queryParams = [];
        if (isset($searchParams['date'])) $queryParams['date'] = $searchParams['date'];

        $this->smarty->assign('queryString', http_build_query($queryParams));
        $this->smarty->assign('search', $searchParams);
        $this->smarty->assign('fields', $fieldsInfo);
        $this->smarty->display("field/search_results_list.tpl");
    }

    public function showDetailsPage($field) {

        $images = [];
        foreach ($field->getImages() as $img) {
            $imageDataUri = UImage::getImageDataUri($img);
            $images[] = $imageDataUri;
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
            'immagini' => $images,
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