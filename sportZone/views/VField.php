<?php
require __DIR__ . '/../../vendor/autoload.php';

class VField{

    private $smarty;

    public function __construct(){
        $this->smarty = USmarty::getInstance();
    }

    public function showSearchForm() {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->display("field/search_form.tpl");
    }

    public function showSearchResults($fields, $searchParams) {
        $fieldsInfo = [];
        foreach ($fields as $fld) {
            
            $imagesNames = $fld->getImages();
            if (sizeof($imagesNames) > 0) {
                $imageSrc = UImage::getImageFullPath($imagesNames[0]);
            } else {
                $imageSrc = "https://th.bing.com/th/id/OIP.xQLogGqy75CRaZGYTlgdXAHaLG?r=0&rs=1&pid=ImgDetMain&cb=idpwebp2&o=7&rm=3";
            }
           
            $info = [
                'id'        => $fld->getId(),
                'title'     => $fld->getName(),
                'sport'     => $fld->getSport(),
                'orario'    => '09:00 - 22:00',
                'superficie'=> $fld->getTerrainType(),
                'price'     => $fld->getCost(),
                'image'     => $imageSrc,
                'alt'       => $fld->getName()
            ];

            $fieldsInfo[] = $info;
        }

        // vengono passati in get alla pagina details, in modo che details possa reinidirizzare alla prenotazione corretta
        $queryParams = [];
        if (isset($searchParams['date'])) $queryParams['date'] = $searchParams['date'];

        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('queryString', http_build_query($queryParams));
        $this->smarty->assign('search', $searchParams);
        $this->smarty->assign('fields', $fieldsInfo);
        $this->smarty->display("field/search_results_list.tpl");
    }

    public function showDetailsPage($field, $query) {

        $images = [];
        foreach ($field->getImages() as $imgName) {
            $imagePath = UImage::getImageFullPath($imgName);
            $images[] = $imagePath;
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
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->assign('campo', $campo);
        $this->smarty->assign('queryString', $query);
        $this->smarty->display("field/details.tpl");
    }

    // ------------------- ADMIN -----------------------------

    public function showCreateFieldForm() {
        USmarty::configureBaseLayout($this->smarty);
        $this->smarty->display("field/create_field_form.tpl");
    }

}